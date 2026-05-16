<?php

namespace App\Http\Controllers;

use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['items.seller', 'payment'])
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $this->authorizeOrder($order);

        $order->load(['items.seller', 'items.product', 'payment']);

        return view('orders.show', compact('order'));
    }

    public function requestRefund(Order $order)
    {
        $this->authorizeOrder($order);

        if (! in_array($order->status, ['paid', 'shipped', 'success'])) {
            return back()->withErrors([
                'order' => 'Refund can only be requested after payment.',
            ]);
        }

        $order->update([
            'status' => 'refund_requested',
        ]);

        return back()->with('status', 'Refund request submitted.');
    }

    public function markSuccess(Order $order)
    {
        $this->authorizeOrder($order);

        if (! in_array($order->status, ['paid', 'shipped'])) {
            return back()->withErrors([
                'order' => 'Only paid or shipped orders can be marked as success.',
            ]);
        }

        $order->update([
            'status' => 'success',
        ]);

        return back()->with('status', 'Order marked as success.');
    }

    private function authorizeOrder(Order $order): void
    {
        abort_if($order->user_id !== auth()->id(), 403);
    }
}