@extends('layouts.market')

@section('title', 'Produk - KriyaLokal')

@section('content')
    <section class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="flex flex-wrap items-end justify-between gap-4">
            <div>
                <p class="text-sm font-bold uppercase tracking-normal text-[#b85f2f]">Katalog budaya</p>
                <h1 class="mt-2 text-3xl font-extrabold text-[#2f221b]">Cari produk KriyaLokal</h1>
            </div>
        </div>

        <form method="GET" action="{{ route('products.index') }}" class="mt-8 grid gap-4 rounded-lg border border-[#eadcc8] bg-white p-4 shadow-sm md:grid-cols-[1fr_220px_220px_auto]">
            <div>
                <label for="search" class="text-sm font-bold text-[#3a281f]">Pencarian</label>
                <input id="search" name="search" type="search" value="{{ request('search') }}" placeholder="Cari batik, kerajinan, aksesoris..." class="mt-2 w-full rounded-md border-[#d8c4aa] bg-[#fffdf8] focus:border-[#b85f2f] focus:ring-[#b85f2f]">
            </div>
            <div>
                <label for="category" class="text-sm font-bold text-[#3a281f]">Kategori</label>
                <select id="category" name="category" class="mt-2 w-full rounded-md border-[#d8c4aa] bg-[#fffdf8] focus:border-[#b85f2f] focus:ring-[#b85f2f]">
                    <option value="">Semua kategori</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->slug }}" @selected(request('category') === $category->slug)>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="selling_type" class="text-sm font-bold text-[#3a281f]">Tipe jual</label>
                <select id="selling_type" name="selling_type" class="mt-2 w-full rounded-md border-[#d8c4aa] bg-[#fffdf8] focus:border-[#b85f2f] focus:ring-[#b85f2f]">
                    <option value="">Semua tipe</option>
                    <option value="internal" @selected(request('selling_type') === 'internal')>Internal</option>
                    <option value="external" @selected(request('selling_type') === 'external')>Eksternal</option>
                    <option value="both" @selected(request('selling_type') === 'both')>Keduanya</option>
                </select>
            </div>
            <div class="flex items-end gap-2">
                <button type="submit" class="rounded-md bg-[#b85f2f] px-4 py-2.5 text-sm font-bold text-white shadow-sm transition hover:bg-[#9c4f26]">Filter</button>
                <a href="{{ route('products.index') }}" class="rounded-md border border-[#d8c4aa] px-4 py-2.5 text-sm font-bold text-[#4c392d] transition hover:bg-[#f7ead8]">Reset</a>
            </div>
        </form>

        @if ($products->isNotEmpty())
            <div class="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @foreach ($products as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>

            <div class="mt-8">
                {{ $products->links() }}
            </div>
        @else
            <x-empty-state class="mt-8" title="Produk tidak ditemukan" message="Coba ubah kata kunci, kategori, atau tipe jual untuk melihat produk lain." />
        @endif
    </section>
@endsection
