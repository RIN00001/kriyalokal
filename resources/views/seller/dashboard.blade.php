@extends('layouts.market')

@section('title', 'Seller Dashboard - KriyaLokal')

@section('content')
    @include('partials.seller-subnav')

    @php
        $seller = auth()->user()->seller;
        $productsCount = $seller?->products()->count() ?? 0;
        $orderItems = $seller?->orderItems()->get() ?? collect();
        $totalSales = $orderItems->sum('subtotal');
    @endphp

    <section class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="rounded-lg border border-[#eadcc8] bg-white p-6 shadow-sm">
            <p class="text-sm font-bold uppercase tracking-normal text-[#b85f2f]">Ruang seller</p>
            <h1 class="mt-2 text-3xl font-extrabold text-[#2f221b]">{{ $seller?->shop_name ?? 'Toko KriyaLokal' }}</h1>
            <p class="mt-2 text-[#755846]">{{ $seller?->description ?? 'Kelola produk budaya, pesanan, dan laporan penjualan dari satu tempat.' }}</p>
        </div>

        <div class="mt-8 grid gap-4 md:grid-cols-3">
            <div class="rounded-lg border border-[#eadcc8] bg-white p-5 shadow-sm">
                <p class="text-sm font-bold text-[#8a6a55]">Total Produk</p>
                <p class="mt-2 text-3xl font-extrabold text-[#2f221b]">{{ $productsCount }}</p>
            </div>
            <div class="rounded-lg border border-[#eadcc8] bg-white p-5 shadow-sm">
                <p class="text-sm font-bold text-[#8a6a55]">Order Item</p>
                <p class="mt-2 text-3xl font-extrabold text-[#2f221b]">{{ $orderItems->count() }}</p>
            </div>
            <div class="rounded-lg border border-[#eadcc8] bg-white p-5 shadow-sm">
                <p class="text-sm font-bold text-[#8a6a55]">Ringkasan Sales</p>
                <p class="mt-2 text-3xl font-extrabold text-[#2f221b]">Rp{{ number_format($totalSales, 0, ',', '.') }}</p>
            </div>
        </div>

        <div class="mt-8 grid gap-3 sm:grid-cols-3">
            <a href="{{ route('seller.products.create') }}" class="rounded-md bg-[#b85f2f] px-4 py-3 text-center text-sm font-bold text-white transition hover:bg-[#9c4f26]">Tambah Produk</a>
            <a href="{{ route('seller.orders.index') }}" class="rounded-md border border-[#d8c4aa] px-4 py-3 text-center text-sm font-bold text-[#4c392d] transition hover:bg-[#f7ead8]">Lihat Pesanan</a>
            <a href="{{ route('seller.reports.index') }}" class="rounded-md border border-[#d8c4aa] px-4 py-3 text-center text-sm font-bold text-[#4c392d] transition hover:bg-[#f7ead8]">Laporan</a>
        </div>
    </section>
@endsection
