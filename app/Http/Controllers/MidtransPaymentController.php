<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\MidtransService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class MidtransPaymentController extends Controller
{
    public function refresh(Order $order, MidtransService $midtrans): RedirectResponse
    {
        $this->authorizeOrder($order);

        if ($order->payment_status === 'paid') {
            return back()->with('status', 'Pesanan sudah dibayar.');
        }

        try {
            $midtrans->createSnapTransaction($order);
        } catch (Throwable $exception) {
            report($exception);

            return back()->withErrors([
                'payment' => 'Gagal membuat token Midtrans: ' . $exception->getMessage(),
            ]);
        }

        return back()->with('status', 'Token pembayaran Midtrans berhasil disiapkan.');
    }

    public function clientCallback(Request $request, Order $order, MidtransService $midtrans): JsonResponse
    {
        $this->authorizeOrder($order);

        if ($request->input('order_id') !== $order->midtrans_order_id) {
            return response()->json(['message' => 'Order Midtrans tidak cocok.'], 422);
        }

        $midtrans->applyPaymentResponse($order, $request->all());

        return response()->json(['message' => 'Status pembayaran diperbarui.']);
    }

    public function notification(Request $request, MidtransService $midtrans): JsonResponse
    {
        if (! $midtrans->isValidSignature($request)) {
            Log::warning('Invalid Midtrans notification signature.', [
                'order_id' => $request->input('order_id'),
            ]);

            return response()->json(['message' => 'Invalid signature.'], 403);
        }

        $order = Order::where('midtrans_order_id', $request->input('order_id'))->first();

        if (! $order) {
            return response()->json(['message' => 'Order not found.'], 404);
        }

        $midtrans->applyPaymentResponse($order, $request->all());

        return response()->json(['message' => 'Notification handled.']);
    }

    private function authorizeOrder(Order $order): void
    {
        abort_if($order->user_id !== auth()->id(), 403);
    }
}
