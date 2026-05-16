<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;

class OrderController extends Controller
{
    public function index()
    {
        $seller = auth()->user()->seller;

        $orderItems = OrderItem::with(['order.user', 'product'])
            ->where('seller_id', $seller->id)
            ->latest()
            ->paginate(10);

        return view('seller.orders.index', compact('orderItems'));
    }

    public function accept(OrderItem $orderItem)
    {
        $this->authorizeOrderItem($orderItem);

        $orderItem->update([
            'seller_status' => 'accepted',
        ]);

        return back()->with('status', 'Order item accepted.');
    }

    public function reject(OrderItem $orderItem)
    {
        $this->authorizeOrderItem($orderItem);

        $orderItem->update([
            'seller_status' => 'rejected',
        ]);

        return back()->with('status', 'Order item rejected.');
    }

    private function authorizeOrderItem(OrderItem $orderItem): void
    {
        abort_if($orderItem->seller_id !== auth()->user()->seller->id, 403);
    }
}