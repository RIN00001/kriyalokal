<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = $this->getOrCreateCart();

        $cart->load(['items.product.seller', 'items.product.mainImage']);

        return view('cart.index', compact('cart'));
    }

    public function store(Request $request, Product $product)
    {
        abort_if(! $product->is_active, 404);

        if ($product->seller_id === auth()->user()->seller?->id) {
            return back()->withErrors([
                'product' => 'Seller tidak bisa membeli produk sendiri.',
            ]);
        }

        if (! in_array($product->selling_type, ['internal', 'both'])) {
            return back()->withErrors([
                'product' => 'This product can only be purchased through external marketplace.',
            ]);
        }

        $data = $request->validate([
            'quantity' => ['nullable', 'integer', 'min:1'],
        ]);

        $quantity = $data['quantity'] ?? 1;

        if ($quantity > $product->stock) {
            return back()->withErrors([
                'quantity' => 'Quantity exceeds available stock.',
            ]);
        }

        $cart = $this->getOrCreateCart();

        $cartItem = CartItem::firstOrNew([
            'cart_id' => $cart->id,
            'product_id' => $product->id,
        ]);

        $newQuantity = $cartItem->exists
            ? $cartItem->quantity + $quantity
            : $quantity;

        if ($newQuantity > $product->stock) {
            return back()->withErrors([
                'quantity' => 'Cart quantity exceeds available stock.',
            ]);
        }

        $cartItem->quantity = $newQuantity;
        $cartItem->save();

        return redirect()
            ->route('cart.index')
            ->with('status', 'Product added to cart.');
    }

    public function update(Request $request, CartItem $cartItem)
    {
        $this->authorizeCartItem($cartItem);

        if ($cartItem->product->seller_id === auth()->user()->seller?->id) {
            return back()->withErrors([
                'cart' => 'Seller tidak bisa membeli produk sendiri.',
            ]);
        }

        $data = $request->validate([
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        if ($data['quantity'] > $cartItem->product->stock) {
            return back()->withErrors([
                'quantity' => 'Quantity exceeds available stock.',
            ]);
        }

        $cartItem->update([
            'quantity' => $data['quantity'],
        ]);

        return back()->with('status', 'Cart updated.');
    }

    public function destroy(CartItem $cartItem)
    {
        $this->authorizeCartItem($cartItem);

        $cartItem->delete();

        return back()->with('status', 'Item removed from cart.');
    }

    private function getOrCreateCart(): Cart
    {
        return Cart::firstOrCreate([
            'user_id' => auth()->id(),
        ]);
    }

    private function authorizeCartItem(CartItem $cartItem): void
    {
        abort_if($cartItem->cart->user_id !== auth()->id(), 403);
    }
}
