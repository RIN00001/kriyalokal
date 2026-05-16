<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Midtrans\Config;
use Midtrans\Snap;

class MidtransService
{
    public function configure(): void
    {
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$clientKey = config('services.midtrans.client_key');
        Config::$isProduction = (bool) config('services.midtrans.is_production', false);
        Config::$isSanitized = (bool) config('services.midtrans.is_sanitized', true);
        Config::$is3ds = (bool) config('services.midtrans.is_3ds', true);
        Config::$curlOptions = $this->curlOptions();
    }

    private function curlOptions(): array
    {
        $options = [
            CURLOPT_HTTPHEADER => ['Expect:'],
        ];
        $caInfo = config('services.midtrans.ca_info');

        if ($caInfo) {
            $options[CURLOPT_CAINFO] = $caInfo;

            return $options;
        }

        if (defined('CURLOPT_SSL_OPTIONS') && defined('CURLSSLOPT_NATIVE_CA')) {
            $options[CURLOPT_SSL_OPTIONS] = CURLSSLOPT_NATIVE_CA;
        }

        return $options;
    }

    public function snapScriptUrl(): string
    {
        return config('services.midtrans.is_production')
            ? 'https://app.midtrans.com/snap/snap.js'
            : 'https://app.sandbox.midtrans.com/snap/snap.js';
    }

    public function createSnapTransaction(Order $order): object
    {
        $this->configure();

        $order->loadMissing(['user', 'items']);
        $subtotal = $order->subtotalAmount();
        $taxAmount = $order->taxAmount();
        $totalAmount = $order->totalAmountWithTax();

        if ($order->payment_status !== 'paid' && (int) round($order->total_amount) !== $totalAmount) {
            $order->update(['total_amount' => $totalAmount]);
            $order->total_amount = $totalAmount;
        }

        $params = [
            'transaction_details' => [
                'order_id' => $order->midtrans_order_id,
                'gross_amount' => $totalAmount,
            ],
            'customer_details' => [
                'first_name' => $order->user?->name ?? 'Customer',
                'email' => $order->user?->email,
            ],
            'item_details' => $order->items->map(function ($item) {
                return [
                    'id' => (string) ($item->product_id ?? $item->id),
                    'price' => (int) round($item->price),
                    'quantity' => (int) $item->quantity,
                    'name' => substr($item->product_name, 0, 50),
                ];
            })->when($taxAmount > 0, function ($items) use ($taxAmount) {
                return $items->push([
                    'id' => 'TAX-5',
                    'price' => $taxAmount,
                    'quantity' => 1,
                    'name' => 'Pajak 5%',
                ]);
            })->values()->all(),
            'callbacks' => [
                'finish' => route('orders.show', $order),
                'unfinish' => route('orders.show', $order),
                'error' => route('orders.show', $order),
            ],
        ];

        $transaction = Snap::createTransaction($params);

        $order->payment()->updateOrCreate(
            ['order_id' => $order->id],
            [
                'payment_gateway' => 'midtrans',
                'snap_token' => $transaction->token ?? null,
                'redirect_url' => $transaction->redirect_url ?? null,
                'gross_amount' => $totalAmount,
                'status' => 'pending',
                'raw_response' => [
                    'snap' => json_decode(json_encode($transaction), true),
                    'subtotal' => $subtotal,
                    'tax_amount' => $taxAmount,
                ],
            ]
        );

        return $transaction;
    }

    public function isValidSignature(Request $request): bool
    {
        $signature = $request->input('signature_key');

        if (! $signature) {
            return false;
        }

        $payload = $request->input('order_id') .
            $request->input('status_code') .
            $request->input('gross_amount') .
            config('services.midtrans.server_key');

        return hash_equals(hash('sha512', $payload), $signature);
    }

    public function applyPaymentResponse(Order $order, array $payload): void
    {
        $transactionStatus = $payload['transaction_status'] ?? $payload['status_message'] ?? 'pending';
        $fraudStatus = $payload['fraud_status'] ?? null;

        [$orderStatus, $paymentStatus, $paidAt] = $this->mapStatuses($transactionStatus, $fraudStatus);

        $payment = $order->payment()->firstOrNew(['order_id' => $order->id]);
        $rawResponse = $payment->raw_response ?? [];
        $rawResponse['midtrans_updates'][] = $payload;

        $payment->fill([
            'payment_gateway' => 'midtrans',
            'payment_type' => $payload['payment_type'] ?? $payment->payment_type,
            'transaction_id' => $payload['transaction_id'] ?? $payment->transaction_id,
            'gross_amount' => $payload['gross_amount'] ?? $payment->gross_amount ?? $order->total_amount,
            'status' => $paymentStatus,
            'paid_at' => $paidAt ? now() : $payment->paid_at,
            'raw_response' => $rawResponse,
        ])->save();

        $order->update([
            'status' => $orderStatus,
            'payment_status' => $paymentStatus,
        ]);

        Log::info('Midtrans payment response applied.', [
            'order_id' => $order->id,
            'midtrans_order_id' => $order->midtrans_order_id,
            'transaction_status' => $transactionStatus,
            'payment_status' => $paymentStatus,
        ]);
    }

    private function mapStatuses(string $transactionStatus, ?string $fraudStatus): array
    {
        return match ($transactionStatus) {
            'capture' => $fraudStatus === 'challenge'
                ? ['pending', 'pending', false]
                : ['paid', 'paid', true],
            'settlement' => ['paid', 'paid', true],
            'pending' => ['pending', 'pending', false],
            'deny' => ['cancelled', 'rejected', false],
            'cancel' => ['cancelled', 'cancelled', false],
            'expire' => ['expired', 'expired', false],
            'refund', 'partial_refund' => ['refund_requested', 'refund_requested', false],
            default => ['pending', 'pending', false],
        };
    }
}
