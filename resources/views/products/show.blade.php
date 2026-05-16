@extends('layouts.market')

@section('title', $product->name . ' - KriyaLokal')

@section('content')
    @php
        $images = $product->images->sortBy('sort_order');
        $mainImage = $images->first();
        $imagePath = $mainImage?->image_path;
        $imageUrl = $imagePath
            ? (\Illuminate\Support\Str::startsWith($imagePath, ['http://', 'https://']) ? $imagePath : asset('storage/' . $imagePath))
            : null;
        $isOwnProduct = auth()->check() && auth()->user()->seller?->id === $product->seller_id;
        $canBuyInternal = ! $isOwnProduct && in_array($product->selling_type, ['internal', 'both']) && $product->stock > 0;
        $canOpenExternal = in_array($product->selling_type, ['external', 'both']) && filled($product->external_url);
    @endphp

    <section class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        <a href="{{ route('products.index') }}" class="text-sm font-bold text-[#9c4f26] hover:underline">Kembali ke produk</a>

        <div class="mt-6 grid gap-8 lg:grid-cols-[0.95fr_1.05fr]">
            <div>
                @if ($imageUrl)
                    <img src="{{ $imageUrl }}" alt="{{ $product->name }}" class="aspect-square w-full rounded-lg border border-[#eadcc8] object-cover shadow-sm">
                @else
                    <div class="grid aspect-square w-full place-items-center rounded-lg border border-[#eadcc8] bg-[#f7ead8] text-lg font-extrabold text-[#b85f2f] shadow-sm">
                        Gambar Produk
                    </div>
                @endif

                @if ($images->count() > 1)
                    <div class="mt-4 grid grid-cols-4 gap-3">
                        @foreach ($images->take(4) as $image)
                            @php
                                $thumbPath = $image->image_path;
                                $thumbUrl = \Illuminate\Support\Str::startsWith($thumbPath, ['http://', 'https://']) ? $thumbPath : asset('storage/' . $thumbPath);
                            @endphp
                            <img src="{{ $thumbUrl }}" alt="{{ $product->name }}" class="aspect-square rounded-md border border-[#eadcc8] object-cover">
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="rounded-lg border border-[#eadcc8] bg-white p-6 shadow-sm">
                <p class="text-sm font-bold uppercase tracking-normal text-[#b85f2f]">{{ $product->category?->name ?? 'Tanpa kategori' }}</p>
                <h1 class="mt-2 text-3xl font-extrabold text-[#2f221b]">{{ $product->name }}</h1>
                <p class="mt-3 text-sm font-semibold text-[#755846]">Seller: {{ $product->seller?->shop_name ?? 'Seller KriyaLokal' }}</p>
                <p class="mt-5 text-3xl font-extrabold text-[#2f221b]">Rp{{ number_format($product->price, 0, ',', '.') }}</p>

                <div class="mt-5 flex flex-wrap gap-3">
                    <span class="rounded-full bg-[#fff3df] px-3 py-1 text-sm font-bold text-[#8a542f]">{{ $product->stock }} stok</span>
                    <span class="rounded-full bg-[#edf7f4] px-3 py-1 text-sm font-bold text-[#315f57]">{{ ucfirst($product->selling_type) }}</span>
                </div>

                <div class="mt-6 max-w-none text-sm leading-7 text-[#5d4436]">
                    <p>{{ $product->description ?: 'Deskripsi produk belum tersedia.' }}</p>
                </div>

                <div class="mt-8 space-y-3">
                    @if ($canBuyInternal)
                        <form method="POST" action="{{ route('cart.store', $product) }}" class="flex flex-col gap-3 sm:flex-row">
                            @csrf
                            <input type="number" name="quantity" min="1" max="{{ $product->stock }}" value="1" class="w-full rounded-md border-[#d8c4aa] bg-[#fffdf8] focus:border-[#b85f2f] focus:ring-[#b85f2f] sm:w-28">
                            <button type="submit" class="flex-1 rounded-md bg-[#b85f2f] px-5 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-[#9c4f26]">
                                Tambah ke Keranjang
                            </button>
                        </form>
                    @elseif ($isOwnProduct)
                        <button type="button" disabled class="w-full rounded-md bg-[#d8c4aa] px-5 py-3 text-sm font-bold text-white">Produk milik Anda</button>
                    @elseif (in_array($product->selling_type, ['internal', 'both']))
                        <button type="button" disabled class="w-full rounded-md bg-[#d8c4aa] px-5 py-3 text-sm font-bold text-white">Stok Habis</button>
                    @endif

                    @if ($canOpenExternal)
                        <a href="{{ $product->external_url }}" target="_blank" rel="noopener" class="flex w-full items-center justify-center rounded-md bg-[#315f57] px-5 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-[#244a44]">
                            Buka Marketplace Seller
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
