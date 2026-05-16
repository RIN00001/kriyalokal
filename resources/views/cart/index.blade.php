@extends('layouts.market')

@section('title', 'Keranjang - KriyaLokal')

@section('content')
    @php
        $items = $cart->items;
        $subtotal = $items->sum(fn ($item) => ($item->product?->price ?? 0) * $item->quantity);
        $tax = \App\Models\Order::taxAmountForSubtotal($subtotal);
        $total = \App\Models\Order::totalWithTax($subtotal);
    @endphp

    <section class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-extrabold text-[#2f221b]">Keranjang</h1>

        @if ($items->isEmpty())
            <x-empty-state class="mt-8" title="Keranjang masih kosong" message="Tambahkan produk internal dari katalog KriyaLokal untuk mulai checkout." action="Jelajah Produk" :href="route('products.index')" />
        @else
            <div class="mt-8 grid gap-8 lg:grid-cols-[1fr_360px]">
                <div class="space-y-4">
                    @foreach ($items as $item)
                        @php
                            $product = $item->product;
                            $imagePath = $product?->mainImage?->image_path;
                            $imageUrl = $imagePath
                                ? (\Illuminate\Support\Str::startsWith($imagePath, ['http://', 'https://']) ? $imagePath : asset('storage/' . $imagePath))
                                : null;
                        @endphp
                        <div class="rounded-lg border border-[#eadcc8] bg-white p-4 shadow-sm">
                            <div class="grid gap-4 sm:grid-cols-[96px_1fr]">
                                @if ($imageUrl)
                                    <img src="{{ $imageUrl }}" alt="{{ $product->name }}" class="h-24 w-24 rounded-md object-cover">
                                @else
                                    <div class="grid h-24 w-24 place-items-center rounded-md bg-[#f7ead8] text-xs font-bold text-[#b85f2f]">Produk</div>
                                @endif

                                <div>
                                    <div class="flex flex-wrap items-start justify-between gap-3">
                                        <div>
                                            <h2 class="font-extrabold text-[#2f221b]">{{ $product?->name ?? 'Produk tidak tersedia' }}</h2>
                                            <p class="mt-1 text-sm text-[#755846]">{{ $product?->seller?->shop_name ?? 'Seller KriyaLokal' }}</p>
                                            <p class="mt-2 font-bold text-[#2f221b]">Rp{{ number_format($product?->price ?? 0, 0, ',', '.') }}</p>
                                        </div>
                                        <p class="font-extrabold text-[#2f221b]">Rp{{ number_format(($product?->price ?? 0) * $item->quantity, 0, ',', '.') }}</p>
                                    </div>

                                    <div class="mt-4 flex flex-wrap gap-3">
                                        <form method="POST" action="{{ route('cart.items.update', $item) }}" class="flex gap-2">
                                            @csrf
                                            @method('PATCH')
                                            <input type="number" name="quantity" min="1" max="{{ $product?->stock ?? 1 }}" value="{{ $item->quantity }}" class="w-24 rounded-md border-[#d8c4aa] bg-[#fffdf8] text-sm focus:border-[#b85f2f] focus:ring-[#b85f2f]">
                                            <button type="submit" class="rounded-md border border-[#d8c4aa] px-3 py-2 text-sm font-bold text-[#4c392d] transition hover:bg-[#f7ead8]">Update</button>
                                        </form>

                                        <form method="POST" action="{{ route('cart.items.destroy', $item) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="rounded-md border border-red-200 px-3 py-2 text-sm font-bold text-red-700 transition hover:bg-red-50">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <aside class="h-fit rounded-lg border border-[#eadcc8] bg-white p-6 shadow-sm">
                    <h2 class="text-xl font-extrabold text-[#2f221b]">Ringkasan</h2>
                    <div class="mt-5 space-y-3 text-sm">
                        <div class="flex justify-between gap-4">
                            <span class="text-[#755846]">Jumlah item</span>
                            <span class="font-bold">{{ $items->sum('quantity') }}</span>
                        </div>
                        <div class="flex justify-between gap-4">
                            <span class="text-[#755846]">Subtotal produk</span>
                            <span class="font-bold">Rp{{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between gap-4">
                            <span class="text-[#755846]">Pajak 5%</span>
                            <span class="font-bold">Rp{{ number_format($tax, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between gap-4 border-t border-[#eadcc8] pt-3 text-lg">
                            <span class="font-extrabold">Total Bayar</span>
                            <span class="font-extrabold">Rp{{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('checkout.store') }}" class="mt-6">
                        @csrf
                        <button type="submit" class="w-full rounded-md bg-[#b85f2f] px-4 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-[#9c4f26]">
                            Checkout
                        </button>
                    </form>
                </aside>
            </div>
        @endif
    </section>
@endsection
