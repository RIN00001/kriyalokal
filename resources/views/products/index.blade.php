@extends('layouts.market')

@section('title', 'Produk Budaya — KriyaLokal')

@section('content')

{{-- ============================================================
     PAGE HEADER
     ============================================================ --}}
<section class="relative overflow-hidden border-b" style="border-color: var(--warm-200);">
    <div class="absolute inset-0 hero-bg"></div>
    <div class="absolute inset-0 batik-texture batik-texture--soft pointer-events-none" aria-hidden="true"></div>
    <div class="section-edge-fade section-edge-fade--to-light" aria-hidden="true"></div>
    <div class="relative mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
        <span class="tag-cultural">Katalog Budaya</span>
        <h1 class="mt-2 text-3xl font-bold" style="font-family:'Playfair Display',serif; color:var(--kriya-800);">
            Temukan Produk KriyaLokal
        </h1>
        <p class="mt-2 text-sm" style="color:var(--kriya-600);">
            Batik, kerajinan, aksesoris, dan karya modern bernuansa tradisi dari seller lokal Indonesia.
        </p>
    </div>
</section>

{{-- ============================================================
     FILTER BAR
     ============================================================ --}}
<section class="mx-auto max-w-7xl px-4 pt-8 sm:px-6 lg:px-8">
    <form method="GET" action="{{ route('products.index') }}"
          class="grid gap-4 rounded-2xl border p-5 shadow-sm md:grid-cols-[1fr_200px_200px_auto]"
          style="background:#fff; border-color:var(--warm-200);">

        <div>
            <label for="search" class="block text-xs font-bold mb-1.5 tracking-wide" style="color:var(--kriya-700);">Pencarian</label>
            <div class="relative">
                <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="color:var(--warm-400);">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input id="search" name="search" type="search" value="{{ request('search') }}"
                       placeholder="Cari batik, kerajinan, aksesoris..."
                       class="w-full rounded-xl border pl-10 pr-4 py-2.5 text-sm transition focus:outline-none"
                       style="border-color:var(--warm-300); background:#fffdf8; color:var(--kriya-800);"
                       onfocus="this.style.borderColor='var(--kriya-400)'; this.style.boxShadow='0 0 0 3px rgba(184,96,48,0.12)'"
                       onblur="this.style.borderColor='var(--warm-300)'; this.style.boxShadow='none'">
            </div>
        </div>

        <div>
            <label for="category" class="block text-xs font-bold mb-1.5 tracking-wide" style="color:var(--kriya-700);">Kategori</label>
            <select id="category" name="category"
                    class="w-full rounded-xl border py-2.5 px-3 text-sm transition focus:outline-none"
                    style="border-color:var(--warm-300); background:#fffdf8; color:var(--kriya-800);">
                <option value="">Semua kategori</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->slug }}" @selected(request('category') === $category->slug)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="selling_type" class="block text-xs font-bold mb-1.5 tracking-wide" style="color:var(--kriya-700);">Tipe Penjualan</label>
            <select id="selling_type" name="selling_type"
                    class="w-full rounded-xl border py-2.5 px-3 text-sm transition focus:outline-none"
                    style="border-color:var(--warm-300); background:#fffdf8; color:var(--kriya-800);">
                <option value="">Semua tipe</option>
                <option value="internal" @selected(request('selling_type') === 'internal')>Internal</option>
                <option value="external" @selected(request('selling_type') === 'external')>Eksternal</option>
                <option value="both" @selected(request('selling_type') === 'both')>Keduanya</option>
            </select>
        </div>

        <div class="flex items-end gap-2">
            <button type="submit" class="btn-kriya flex-1 md:flex-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                </svg>
                Filter
            </button>
            <a href="{{ route('products.index') }}" class="btn-kriya-outline flex-1 md:flex-none text-center">Reset</a>
        </div>
    </form>
</section>

{{-- ============================================================
     PRODUCT GRID
     ============================================================ --}}
<section class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">

    @if ($products->isNotEmpty())

        {{-- Result count --}}
        <p class="mb-6 text-sm font-semibold" style="color:var(--kriya-600);">
            Menampilkan <strong>{{ $products->total() }}</strong> produk
            @if(request('search'))
                untuk "<em>{{ request('search') }}</em>"
            @endif
        </p>

        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @foreach ($products as $product)
                <x-product-card :product="$product" />
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-10 flex justify-center">
            {{ $products->links() }}
        </div>

    @else
        <x-empty-state
            class="mt-2"
            title="Produk tidak ditemukan"
            message="Coba ubah kata kunci, kategori, atau tipe penjualan untuk melihat produk lain." />
    @endif

</section>
@endsection
