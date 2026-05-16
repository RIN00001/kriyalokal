@extends('layouts.market')

@section('title', 'Beranda - KriyaLokal')

@section('content')
    @php
        $featuredProducts = \App\Models\Product::with(['seller', 'category', 'mainImage'])
            ->where('is_active', true)
            ->latest()
            ->take(6)
            ->get();
    @endphp

    <section class="relative overflow-hidden border-b border-[#eadcc8]">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_left,#f1b26d33,transparent_35%),linear-gradient(135deg,#fff8ec,#f7ead8)]"></div>
        <div class="relative mx-auto grid min-h-[620px] max-w-7xl items-center gap-10 px-4 py-16 sm:px-6 lg:grid-cols-[1.05fr_0.95fr] lg:px-8">
            <div>
                <p class="text-sm font-bold uppercase tracking-normal text-[#b85f2f]">Semi e-commerce budaya Indonesia</p>
                <h1 class="mt-4 text-4xl font-extrabold leading-tight text-[#2f221b] sm:text-5xl">Produk budaya lokal, dibuat lebih mudah ditemukan.</h1>
                <p class="mt-5 max-w-2xl text-lg leading-8 text-[#6f4c39]">KriyaLokal menghubungkan pelanggan dengan batik, kerajinan, aksesoris, dekorasi, dan karya modern bernuansa tradisi dari seller Indonesia.</p>
                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="{{ route('products.index') }}" class="rounded-md bg-[#b85f2f] px-5 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-[#9c4f26]">Jelajah Produk</a>
                    <a href="{{ route('partners') }}" class="rounded-md border border-[#cda77f] bg-white/60 px-5 py-3 text-sm font-bold text-[#4c392d] transition hover:bg-white">Lihat Partner</a>
                </div>
            </div>

            <div class="grid gap-4 sm:grid-cols-2">
                <div class="rounded-lg bg-white p-4 shadow-sm">
                    <div class="aspect-[4/5] rounded-md bg-[#b85f2f] p-5 text-white">
                        <p class="text-sm font-bold">Batik Nusantara</p>
                        <p class="mt-20 text-3xl font-extrabold leading-tight">Motif tradisi untuk hari ini.</p>
                    </div>
                </div>
                <div class="space-y-4 pt-10">
                    <div class="rounded-lg bg-[#315f57] p-5 text-white shadow-sm">
                        <p class="text-sm font-semibold text-[#d7eee9]">Seller lokal</p>
                        <p class="mt-3 text-2xl font-extrabold">Etalase digital untuk karya budaya.</p>
                    </div>
                    <div class="rounded-lg bg-white p-5 shadow-sm">
                        <p class="text-sm font-semibold text-[#8a6a55]">Alur prototype</p>
                        <p class="mt-3 text-2xl font-extrabold text-[#2f221b]">Cari, beli, transaksi, laporan.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8">
        <div class="flex flex-wrap items-end justify-between gap-4">
            <div>
                <p class="text-sm font-bold uppercase tracking-normal text-[#b85f2f]">Pilihan terbaru</p>
                <h2 class="mt-2 text-3xl font-extrabold text-[#2f221b]">Produk budaya yang sedang tampil</h2>
            </div>
            <a href="{{ route('products.index') }}" class="text-sm font-bold text-[#9c4f26] hover:underline">Lihat semua produk</a>
        </div>

        @if ($featuredProducts->isNotEmpty())
            <div class="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($featuredProducts as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>
        @else
            <x-empty-state class="mt-8" title="Produk belum tersedia" message="Produk dari seller akan muncul di halaman ini setelah database diisi." action="Ke halaman produk" :href="route('products.index')" />
        @endif
    </section>

    <section class="bg-white/70 py-14">
        <div class="mx-auto grid max-w-7xl gap-6 px-4 sm:px-6 lg:grid-cols-3 lg:px-8">
            <div class="rounded-lg border border-[#eadcc8] bg-[#fff8ec] p-6 shadow-sm">
                <p class="text-lg font-extrabold text-[#2f221b]">Untuk Customer</p>
                <p class="mt-3 text-sm leading-6 text-[#755846]">Cari produk, masukkan ke keranjang, checkout prototype, lalu pantau riwayat pesanan.</p>
            </div>
            <div class="rounded-lg border border-[#eadcc8] bg-[#fff8ec] p-6 shadow-sm">
                <p class="text-lg font-extrabold text-[#2f221b]">Untuk Seller</p>
                <p class="mt-3 text-sm leading-6 text-[#755846]">Kelola produk, toggle status jual, pantau pesanan, dan buat laporan penjualan.</p>
            </div>
            <div class="rounded-lg border border-[#eadcc8] bg-[#fff8ec] p-6 shadow-sm">
                <p class="text-lg font-extrabold text-[#2f221b]">Untuk Platform</p>
                <p class="mt-3 text-sm leading-6 text-[#755846]">Employee dan admin memiliki panel monitoring sederhana untuk kebutuhan prototype.</p>
            </div>
        </div>
    </section>
@endsection
