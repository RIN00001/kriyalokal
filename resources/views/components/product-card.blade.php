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
        'both'     => 'Internal & Eksternal',
    ][$product->selling_type] ?? ucfirst($product->selling_type);
@endphp

<article {{ $attributes->merge(['class' => 'group card-kriya flex h-full flex-col overflow-hidden']) }}>

    {{-- Image --}}
    <a href="{{ route('products.show', $product) }}" class="block overflow-hidden relative">
        @if ($imageUrl)
            <img src="{{ $imageUrl }}"
                 alt="{{ $product->name }}"
                 class="aspect-square w-full object-cover transition duration-500 group-hover:scale-105">
        @else
            <div class="aspect-square w-full grid place-items-center relative overflow-hidden"
                 style="background: linear-gradient(135deg, var(--warm-100), var(--kriya-100));">
                <div class="absolute inset-0 batik-texture opacity-30"></div>
                <div class="relative text-center">
                    <div class="mx-auto h-14 w-14 rounded-full grid place-items-center"
                         style="background:rgba(184,96,48,0.1);">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" style="color:var(--kriya-400);">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <p class="mt-2 text-xs font-bold" style="color:var(--kriya-400);">Gambar Produk</p>
                </div>
            </div>
        @endif

        {{-- Selling type badge overlay --}}
        <div class="absolute top-3 left-3">
            <span class="text-[10px] font-bold px-2 py-1 rounded-full shadow-sm"
                  style="background:rgba(255,255,255,0.92); color:var(--kriya-600); border:1px solid var(--warm-200);">
                {{ $sellingLabel }}
            </span>
        </div>
    </a>

    {{-- Content --}}
    <div class="flex flex-1 flex-col p-4">

        {{-- Category + Stock --}}
        <div class="flex items-start justify-between gap-2">
            <span class="tag-cultural">{{ $product->category?->name ?? 'Tanpa kategori' }}</span>
            <span class="shrink-0 rounded-full px-2 py-0.5 text-[10px] font-bold"
                  style="background:var(--gold-100); color:var(--gold-600);">
                {{ $product->stock }} stok
            </span>
        </div>

        {{-- Product name --}}
        <h3 class="mt-2 text-base font-bold leading-snug min-h-[2.8rem]"
            style="font-family:'Playfair Display',serif; color:var(--kriya-800);">
            <a href="{{ route('products.show', $product) }}"
               class="hover:text-[var(--kriya-400)] transition line-clamp-2">
                {{ $product->name }}
            </a>
        </h3>

        {{-- Seller --}}
        <p class="mt-1.5 text-xs font-semibold flex items-center gap-1.5" style="color:var(--warm-500);">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
            </svg>
            {{ $product->seller?->shop_name ?? 'Seller KriyaLokal' }}
        </p>

        {{-- Price --}}
        <p class="mt-3 text-xl font-extrabold" style="font-family:'Playfair Display',serif; color:var(--kriya-800);">
            Rp{{ number_format($product->price, 0, ',', '.') }}
        </p>

        {{-- Spacer + Actions --}}
        <div class="mt-auto space-y-2 pt-4">
            <a href="{{ route('products.show', $product) }}"
               class="btn-kriya-outline flex w-full items-center justify-center py-2 text-sm">
                Lihat Detail
            </a>

            @if ($canBuyInternal)
                <form method="POST" action="{{ route('cart.store', $product) }}">
                    @csrf
                    <button type="submit" class="btn-kriya w-full py-2 text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.4 7h12.8"/>
                        </svg>
                        Tambah ke Keranjang
                    </button>
                </form>
            @elseif ($isOwnProduct)
                <button type="button" disabled
                        class="w-full rounded-lg py-2 text-sm font-bold cursor-not-allowed"
                        style="background:var(--warm-200); color:var(--warm-500);">
                    Produk milik Anda
                </button>
            @elseif (in_array($product->selling_type, ['internal', 'both']))
                <button type="button" disabled
                        class="w-full rounded-lg py-2 text-sm font-bold cursor-not-allowed"
                        style="background:var(--warm-200); color:var(--warm-500);">
                    Stok Habis
                </button>
            @endif

            @if ($canOpenExternal)
                <a href="{{ $product->external_url }}" target="_blank" rel="noopener"
                   class="flex w-full items-center justify-center gap-2 rounded-lg py-2 text-sm font-bold text-white transition shadow-sm hover:shadow-md hover:-translate-y-0.5"
                   style="background: linear-gradient(135deg, var(--teal-600), var(--teal-700));">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                    Buka Marketplace
                </a>
            @endif
        </div>
    </div>
</article>
