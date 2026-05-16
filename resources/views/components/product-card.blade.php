@props(['product'])

@php
    $imagePath = $product->mainImage?->image_path;
    $imageUrl = $imagePath
        ? (\Illuminate\Support\Str::startsWith($imagePath, ['http://', 'https://']) ? $imagePath : asset('storage/' . $imagePath))
        : null;
    $isOwnProduct = auth()->check() && auth()->user()->seller?->id === $product->seller_id;
    $canBuyInternal = ! $isOwnProduct && in_array($product->selling_type, ['internal', 'both']) && $product->stock > 0;
    $canOpenExternal = in_array($product->selling_type, ['external', 'both']) && filled($product->external_url);
    $sellingLabel = [
        'internal' => 'Beli di KriyaLokal',
        'external' => 'Marketplace Eksternal',
        'both' => 'Internal & Eksternal',
    ][$product->selling_type] ?? ucfirst($product->selling_type);
@endphp

<article {{ $attributes->merge(['class' => 'group flex h-full flex-col overflow-hidden rounded-lg border border-[#eadcc8] bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-md']) }}>
    <a href="{{ route('products.show', $product) }}" class="block">
        @if ($imageUrl)
            <img src="{{ $imageUrl }}" alt="{{ $product->name }}" class="aspect-square w-full object-cover">
        @else
            <div class="grid aspect-square w-full place-items-center bg-[#f7ead8] text-center text-sm font-bold text-[#b85f2f]">
                Gambar Produk
            </div>
        @endif
    </a>

    <div class="flex flex-1 flex-col p-4">
        <div class="flex items-start justify-between gap-3">
            <div>
                <p class="text-xs font-bold uppercase tracking-normal text-[#b85f2f]">{{ $product->category?->name ?? 'Tanpa kategori' }}</p>
                <h3 class="mt-1 min-h-[3rem] text-base font-extrabold text-[#2f221b]">
                    <a href="{{ route('products.show', $product) }}" class="hover:text-[#9c4f26]">{{ $product->name }}</a>
                </h3>
            </div>
            <span class="rounded-full bg-[#fff3df] px-2 py-1 text-xs font-bold text-[#8a542f]">{{ $product->stock }} stok</span>
        </div>

        <p class="mt-2 text-sm text-[#755846]">{{ $product->seller?->shop_name ?? 'Seller KriyaLokal' }}</p>
        <p class="mt-3 text-lg font-extrabold text-[#2f221b]">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
        <p class="mt-1 text-xs font-semibold text-[#8a6a55]">{{ $sellingLabel }}</p>

        <div class="mt-auto space-y-2 pt-4">
            <a href="{{ route('products.show', $product) }}" class="flex w-full items-center justify-center rounded-md border border-[#d8c4aa] px-3 py-2 text-sm font-bold text-[#4c392d] transition hover:bg-[#f7ead8]">
                Lihat Detail
            </a>

            @if ($canBuyInternal)
                <form method="POST" action="{{ route('cart.store', $product) }}">
                    @csrf
                    <button type="submit" class="w-full rounded-md bg-[#b85f2f] px-3 py-2 text-sm font-bold text-white shadow-sm transition hover:bg-[#9c4f26]">
                        Tambah ke Keranjang
                    </button>
                </form>
            @elseif ($isOwnProduct)
                <button type="button" disabled class="w-full rounded-md bg-[#d8c4aa] px-3 py-2 text-sm font-bold text-white">
                    Produk milik Anda
                </button>
            @elseif (in_array($product->selling_type, ['internal', 'both']))
                <button type="button" disabled class="w-full rounded-md bg-[#d8c4aa] px-3 py-2 text-sm font-bold text-white">
                    Stok Habis
                </button>
            @endif

            @if ($canOpenExternal)
                <a href="{{ $product->external_url }}" target="_blank" rel="noopener" class="flex w-full items-center justify-center rounded-md bg-[#315f57] px-3 py-2 text-sm font-bold text-white shadow-sm transition hover:bg-[#244a44]">
                    Buka Marketplace
                </a>
            @endif
        </div>
    </div>
</article>
