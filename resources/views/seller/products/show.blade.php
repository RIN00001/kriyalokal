@extends('layouts.market')

@section('title', 'Detail Produk Seller - KriyaLokal')

@section('content')
    @include('partials.seller-subnav')

    <section class="mx-auto max-w-5xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="rounded-lg border border-[#eadcc8] bg-white p-6 shadow-sm">
            <div class="flex flex-wrap items-start justify-between gap-4">
                <div>
                    <p class="text-sm font-bold uppercase tracking-normal text-[#b85f2f]">{{ $product->category?->name ?? 'Tanpa kategori' }}</p>
                    <h1 class="mt-2 text-3xl font-extrabold text-[#2f221b]">{{ $product->name }}</h1>
                    <p class="mt-3 text-[#755846]">{{ $product->description ?: 'Deskripsi produk belum tersedia.' }}</p>
                </div>
                <x-status-badge :status="$product->is_active ? 'active' : 'inactive'" />
            </div>

            <div class="mt-8 grid gap-4 md:grid-cols-3">
                <div class="rounded-lg bg-[#fff8ec] p-4">
                    <p class="text-sm font-bold text-[#8a6a55]">Harga</p>
                    <p class="mt-1 text-xl font-extrabold">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                </div>
                <div class="rounded-lg bg-[#fff8ec] p-4">
                    <p class="text-sm font-bold text-[#8a6a55]">Stok</p>
                    <p class="mt-1 text-xl font-extrabold">{{ $product->stock }}</p>
                </div>
                <div class="rounded-lg bg-[#fff8ec] p-4">
                    <p class="text-sm font-bold text-[#8a6a55]">Tipe Jual</p>
                    <p class="mt-1 text-xl font-extrabold">{{ ucfirst($product->selling_type) }}</p>
                </div>
            </div>

            <div class="mt-8 flex flex-wrap gap-3">
                <a href="{{ route('seller.products.edit', $product) }}" class="rounded-md bg-[#b85f2f] px-5 py-3 text-sm font-bold text-white transition hover:bg-[#9c4f26]">Edit Produk</a>
                <a href="{{ route('seller.products.index') }}" class="rounded-md border border-[#d8c4aa] px-5 py-3 text-sm font-bold text-[#4c392d] transition hover:bg-[#f7ead8]">Kembali</a>
            </div>
        </div>
    </section>
@endsection
