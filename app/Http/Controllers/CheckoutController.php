<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function store()
    {
        $cart = auth()->user()
            ->cart()
            ->with(['items.product.seller'])
            ->first();

        if (! $cart || $cart->items->isEmpty()) {
            return redirect()
                ->route('cart.index')
                ->withErrors(['cart' => 'Your cart is empty.']);
        }

        foreach ($cart->items as $item) {
            if (! $item->product->is_active) {
                return back()->withErrors([
                    'cart' => "{$item->product->name} is no longer available.",
                ]);
            }

            if (! in_array($item->product->selling_type, ['internal', 'both'])) {
                return back()->withErrors([
                    'cart' => "{$item->product->name} cannot be checked out internally.",
                ]);
            }

            if ($item->quantity > $item->product->stock) {
                return back()->withErrors([
                    'cart' => "{$item->product->name} exceeds available stock.",
                ]);
            }
        }

        $order = DB::transaction(function () use ($cart) {
            $total = $cart->items->sum(function ($item) {
                return $item->product->price * $item->quantity;
            });

            $order = Order::create([
                'user_id' => auth()->id(),
                'order_code' => 'KR-' . strtoupper(Str::random(10)),
                'total_amount' => $total,
                'status' => 'pending',
                'payment_status' => 'unpaid',
                'midtrans_order_id' => 'MID-' . strtoupper(Str::random(12)),
            ]);

            foreach ($cart->items as $item) {
                $product = $item->product;

                $order->items()->create([
                    'seller_id' => $product->seller_id,
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $item->quantity,
                    'subtotal' => $product->price * $item->quantity,
                    'seller_status' => 'accepted',
                ]);

                $product->decrement('stock', $item->quantity);
            }

            Payment::create([
                'order_id' => $order->id,
                'payment_gateway' => 'midtrans',
                'gross_amount' => $total,
                'status' => 'pending',
            ]);

            $cart->items()->delete();

            return $order;
        });

        return redirect()
            ->route('orders.show', $order)
            ->with('status', 'Order created successfully.');
    }
}