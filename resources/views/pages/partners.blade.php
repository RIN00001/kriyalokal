@extends('layouts.market')

@section('title', 'Partner Kita - KriyaLokal')

@section('content')
    <section class="mx-auto max-w-6xl px-4 py-14 sm:px-6 lg:px-8">
        <div class="grid gap-10 lg:grid-cols-[0.9fr_1.1fr]">
            <div>
                <p class="text-sm font-bold uppercase tracking-normal text-[#b85f2f]">Partner Seller</p>
                <h1 class="mt-3 text-4xl font-extrabold text-[#2f221b]">Seller lokal mendapat etalase yang lebih fokus pada budaya.</h1>
                <p class="mt-5 text-lg leading-8 text-[#755846]">Partner dapat menampilkan produk, memilih penjualan internal, redirect ke marketplace eksternal, atau menggunakan keduanya.</p>
                @auth
                    @if (auth()->user()->role === 'customer')
                        <a href="{{ route('seller-applications.create') }}" class="mt-8 inline-flex rounded-md bg-[#b85f2f] px-5 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-[#9c4f26]">Ajukan Jadi Seller</a>
                    @endif
                @else
                    <a href="{{ route('register') }}" class="mt-8 inline-flex rounded-md bg-[#b85f2f] px-5 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-[#9c4f26]">Daftar untuk Mulai</a>
                @endauth
            </div>
            <div class="grid gap-4 sm:grid-cols-2">
                <div class="rounded-lg border border-[#eadcc8] bg-white p-6 shadow-sm">
                    <p class="text-xl font-extrabold text-[#2f221b]">Etalase Produk</p>
                    <p class="mt-3 text-sm leading-6 text-[#755846]">Seller mengelola katalog dan status aktif produk.</p>
                </div>
                <div class="rounded-lg border border-[#eadcc8] bg-white p-6 shadow-sm">
                    <p class="text-xl font-extrabold text-[#2f221b]">Pesanan Seller</p>
                    <p class="mt-3 text-sm leading-6 text-[#755846]">Seller melihat order item yang masuk dan dapat menerima atau menolak.</p>
                </div>
                <div class="rounded-lg border border-[#eadcc8] bg-white p-6 shadow-sm">
                    <p class="text-xl font-extrabold text-[#2f221b]">Laporan</p>
                    <p class="mt-3 text-sm leading-6 text-[#755846]">Laporan penjualan dasar dapat dibuat dan diekspor CSV.</p>
                </div>
                <div class="rounded-lg border border-[#eadcc8] bg-white p-6 shadow-sm">
                    <p class="text-xl font-extrabold text-[#2f221b]">Semi E-commerce</p>
                    <p class="mt-3 text-sm leading-6 text-[#755846]">Produk bisa dibeli internal atau diarahkan ke toko eksternal.</p>
                </div>
            </div>
        </div>
    </section>
@endsection
