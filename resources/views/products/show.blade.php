@extends('layouts.market')

@section('title', $product->name . ' — KriyaLokal')

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

{{-- ============================================================
     BREADCRUMB
     ============================================================ --}}
<div class="border-b" style="border-color:var(--warm-200); background:#fff;">
    <div class="mx-auto max-w-7xl px-4 py-3.5 sm:px-6 lg:px-8">
        <nav class="flex items-center gap-2 text-xs font-semibold" style="color:var(--warm-400);">
            <a href="{{ route('home') }}" class="hover:text-[var(--kriya-500)] transition" style="color:var(--kriya-600);">Beranda</a>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
            </svg>
            <a href="{{ route('products.index') }}" class="hover:text-[var(--kriya-500)] transition" style="color:var(--kriya-600);">Produk</a>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
            </svg>
            <span style="color:var(--kriya-800);">{{ Str::limit($product->name, 40) }}</span>
        </nav>
    </div>
</div>

{{-- ============================================================
     PRODUCT DETAIL
     ============================================================ --}}
<section class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
    <div class="grid gap-10 lg:grid-cols-[1fr_1.05fr] xl:gap-14">

        {{-- ---- Left: Image Gallery ---- --}}
        <div class="flex flex-col gap-4">
            {{-- Main image --}}
            @if ($imageUrl)
                <div class="overflow-hidden rounded-2xl border shadow-sm" style="border-color:var(--warm-200);">
                    <img src="{{ $imageUrl }}"
                         alt="{{ $product->name }}"
                         class="aspect-square w-full object-cover transition duration-300 hover:scale-105">
                </div>
            @else
                <div class="aspect-square w-full rounded-2xl border grid place-items-center relative overflow-hidden"
                     style="border-color:var(--warm-200); background: linear-gradient(135deg, var(--warm-100), var(--kriya-100));">
                    {{-- Decorative background --}}
                    <div class="absolute inset-0 batik-texture opacity-40"></div>
                    <div class="relative text-center">
                        <div class="mx-auto h-16 w-16 rounded-full grid place-items-center mb-3"
                             style="background:rgba(184,96,48,0.12);">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" style="color:var(--kriya-400);">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <p class="text-sm font-bold" style="color:var(--kriya-500);">Gambar Produk</p>
                    </div>
                </div>
            @endif

            {{-- Thumbnail strip --}}
            @if ($images->count() > 1)
                <div class="grid grid-cols-4 gap-3">
                    @foreach ($images->take(4) as $image)
                        @php
                            $thumbPath = $image->image_path;
                            $thumbUrl = \Illuminate\Support\Str::startsWith($thumbPath, ['http://', 'https://'])
                                ? $thumbPath : asset('storage/' . $thumbPath);
                        @endphp
                        <div class="overflow-hidden rounded-xl border transition hover:border-[var(--kriya-400)] cursor-pointer"
                             style="border-color:var(--warm-200);">
                            <img src="{{ $thumbUrl }}" alt="{{ $product->name }}"
                                 class="aspect-square w-full object-cover">
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- ---- Right: Product Info ---- --}}
        <div>
            {{-- Category tag --}}
            <span class="tag-cultural">{{ $product->category?->name ?? 'Tanpa kategori' }}</span>

            {{-- Product name --}}
            <h1 class="mt-3 text-[2rem] font-bold leading-tight sm:text-[2.2rem]"
                style="font-family:'Playfair Display',serif; color:var(--kriya-800);">
                {{ $product->name }}
            </h1>

            {{-- Seller --}}
            <div class="mt-3 flex items-center gap-2">
                <div class="h-7 w-7 rounded-full grid place-items-center text-xs font-extrabold text-white shrink-0"
                     style="background: var(--kriya-400);">
                    {{ strtoupper(substr($product->seller?->shop_name ?? 'K', 0, 1)) }}
                </div>
                <p class="text-sm font-semibold" style="color:var(--kriya-600);">
                    {{ $product->seller?->shop_name ?? 'Seller KriyaLokal' }}
                </p>
            </div>

            {{-- Divider --}}

            {{-- Price --}}
            <p class="text-4xl font-extrabold" style="font-family:'Playfair Display',serif; color:var(--kriya-800);">
                Rp{{ number_format($product->price, 0, ',', '.') }}
            </p>

            {{-- Badges --}}
            <div class="mt-4 flex flex-wrap gap-2">
                <span class="inline-flex items-center gap-1.5 rounded-full px-3 py-1.5 text-xs font-bold"
                      style="background:var(--gold-100); color:var(--gold-600);">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                    {{ $product->stock }} Stok Tersedia
                </span>
                <span class="inline-flex items-center gap-1.5 rounded-full px-3 py-1.5 text-xs font-bold"
                      style="background:var(--teal-100); color:var(--teal-600);">
                    {{ ucfirst($product->selling_type) }}
                </span>
            </div>

            {{-- Description --}}
            <div class="mt-6 rounded-xl p-5" style="background:var(--warm-50); border:1px solid var(--warm-200);">
                <p class="text-xs font-bold uppercase tracking-widest mb-3" style="color:var(--kriya-400);">Deskripsi Produk</p>
                <p class="text-sm leading-7" style="color:var(--kriya-600);">
                    {{ $product->description ?: 'Deskripsi produk belum tersedia.' }}
                </p>
            </div>

            {{-- CTA Buttons --}}
            <div class="mt-7 flex flex-col gap-3">

                @if ($canBuyInternal)
                    <form method="POST" action="{{ route('cart.store', $product) }}"
                          class="flex flex-col gap-3 sm:flex-row sm:items-center">
                        @csrf
                        <div class="flex items-center gap-2 sm:w-auto">
                            <label for="quantity" class="text-sm font-bold shrink-0" style="color:var(--kriya-700);">Qty:</label>
                            <input type="number" id="quantity" name="quantity"
                                   min="1" max="{{ $product->stock }}" value="1"
                                   class="w-20 rounded-xl border px-3 py-2.5 text-sm text-center font-bold focus:outline-none transition"
                                   style="border-color:var(--warm-300); background:#fffdf8; color:var(--kriya-800);"
                                   onfocus="this.style.borderColor='var(--kriya-400)'"
                                   onblur="this.style.borderColor='var(--warm-300)'">
                        </div>
                        <button type="submit" class="btn-kriya flex-1 py-3 text-base">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.4 7h12.8M7 13L5.4 5M10 21a1 1 0 100-2 1 1 0 000 2zm7 0a1 1 0 100-2 1 1 0 000 2z"/>
                            </svg>
                            Tambah ke Keranjang
                        </button>
                    </form>

                @elseif ($isOwnProduct)
                    <div class="flex items-center gap-3 rounded-xl border p-4" style="border-color:var(--warm-300); background:var(--warm-50);">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="color:var(--kriya-400);">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-sm font-semibold" style="color:var(--kriya-600);">Ini adalah produk milik toko Anda.</p>
                    </div>

                @elseif (in_array($product->selling_type, ['internal', 'both']))
                    <button type="button" disabled
                            class="w-full rounded-xl py-3 text-sm font-bold cursor-not-allowed"
                            style="background:var(--warm-200); color:var(--warm-500);">
                        Stok Habis
                    </button>
                @endif

                @if ($canOpenExternal)
                    <a href="{{ $product->external_url }}" target="_blank" rel="noopener"
                       class="flex w-full items-center justify-center gap-2 rounded-xl py-3 text-sm font-bold text-white transition shadow-md hover:shadow-lg hover:-translate-y-0.5"
                       style="background: linear-gradient(135deg, var(--teal-600), var(--teal-700));">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                        Buka Marketplace Seller
                    </a>
                @endif

                <a href="{{ route('products.index') }}"
                   class="flex items-center justify-center gap-1.5 text-sm font-semibold transition hover:underline underline-offset-4 py-1"
                   style="color:var(--kriya-500);">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Kembali ke semua produk
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
