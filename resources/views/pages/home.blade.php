@extends('layouts.market')

@section('title', 'Beranda — KriyaLokal, Pasar Budaya Indonesia')

@section('content')
@php
    $featuredProducts = \App\Models\Product::with(['seller', 'category', 'mainImage'])
        ->where('is_active', true)
        ->latest()
        ->take(6)
        ->get();
@endphp

{{-- ============================================================
     HERO SECTION
     ============================================================ --}}
<section class="relative overflow-hidden">

    <div class="absolute inset-0 hero-bg batik-texture"></div>

    {{-- Decorative large ring (right) --}}
    <div class="pointer-events-none absolute -right-24 -top-24 h-[500px] w-[500px] rounded-full opacity-10"
         style="background: radial-gradient(circle, var(--gold-400) 0%, transparent 70%);"></div>
    {{-- Decorative small ring (left-bottom) --}}
    <div class="pointer-events-none absolute -bottom-16 -left-16 h-[300px] w-[300px] rounded-full opacity-8"
         style="background: radial-gradient(circle, var(--kriya-300) 0%, transparent 70%);"></div>

    <div class="relative mx-auto grid min-h-[640px] max-w-7xl items-center gap-12 px-4 py-20 sm:px-6 lg:grid-cols-[1.1fr_0.9fr] lg:px-8">

        {{-- Left: Copy --}}
        <div class="animate-fade-up">
            <span class="tag-cultural flex items-center gap-2 mb-5">
                {{-- Decorative diamond --}}
                <span class="inline-block w-4 h-px" style="background: var(--kriya-400);"></span>
                Platform Budaya Lokal Indonesia
                <span class="inline-block w-4 h-px" style="background: var(--kriya-400);"></span>
            </span>

            <h1 class="text-[2.6rem] font-bold leading-[1.15] sm:text-[3.4rem]"
                style="font-family:'Playfair Display',serif; color: var(--kriya-800);">
                Produk Budaya Lokal,<br>
                <em class="not-italic" style="color: var(--kriya-400);">Dikemas</em> untuk Dunia.
            </h1>


            <p class="max-w-xl text-[1.05rem] leading-relaxed" style="color: var(--kriya-600);">
                KriyaLokal menghubungkan pelanggan dengan <strong>batik, kerajinan, aksesoris,</strong>
                dan karya modern bernuansa tradisi dari seller lokal Indonesia — lewat storytelling visual
                dan digital engagement.
            </p>

            <div class="mt-9 flex flex-wrap gap-3">
                <a href="{{ route('products.index') }}" class="btn-kriya">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h16M4 18h7"/>
                    </svg>
                    Jelajah Produk
                </a>
                <a href="{{ route('partners') }}" class="btn-kriya-outline">
                    Lihat Seller
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>

            {{-- Trust indicators --}}
            <div class="mt-10 flex flex-wrap gap-6">
                <div class="flex items-center gap-2">
                    <div class="h-8 w-8 rounded-full grid place-items-center" style="background: var(--kriya-100);">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="color:var(--kriya-500);">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <span class="text-sm font-semibold" style="color:var(--kriya-600);">Produk Terverifikasi</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="h-8 w-8 rounded-full grid place-items-center" style="background: var(--kriya-100);">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="color:var(--kriya-500);">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0"/>
                        </svg>
                    </div>
                    <span class="text-sm font-semibold" style="color:var(--kriya-600);">Seller UMKM Lokal</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="h-8 w-8 rounded-full grid place-items-center" style="background: var(--kriya-100);">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="color:var(--kriya-500);">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <span class="text-sm font-semibold" style="color:var(--kriya-600);">Warisan Nusantara</span>
                </div>
            </div>
        </div>

        {{-- Right: Visual cards --}}
        <div class="animate-fade-up delay-200 grid gap-4 sm:grid-cols-2">

            {{-- Main feature card --}}
            <div class="sm:col-span-2 rounded-2xl overflow-hidden shadow-lg relative"
                 style="background: linear-gradient(145deg, var(--kriya-500), var(--kriya-700)); min-height: 180px;">
                {{-- Batik-inspired decorative circles --}}
                <div class="absolute top-4 right-4 w-24 h-24 rounded-full opacity-10" style="background: var(--gold-400);"></div>
                <div class="absolute -bottom-6 -right-6 w-36 h-36 rounded-full opacity-10" style="background: var(--kriya-300);"></div>
                <div class="absolute top-2 left-20 w-10 h-10 rounded-full opacity-10" style="background: var(--gold-300);"></div>
                <div class="relative p-7">
                    <p class="text-xs font-bold tracking-widest uppercase" style="color: var(--gold-300);">Unggulan</p>
                    <h3 class="mt-2 text-2xl font-bold leading-snug text-white" style="font-family:'Playfair Display',serif;">
                        Batik Nusantara —<br>Motif Tradisi untuk Hari Ini.
                    </h3>
                    <a href="{{ route('products.index') }}" class="mt-4 inline-flex items-center gap-1.5 text-sm font-bold rounded-lg px-4 py-2 transition hover:opacity-90"
                       style="background: rgba(255,255,255,0.18); color: white; border: 1px solid rgba(255,255,255,0.3); backdrop-filter:blur(4px);">
                        Lihat Koleksi
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </div>

            {{-- Seller card --}}
            <div class="rounded-2xl p-5 shadow-md relative overflow-hidden"
                 style="background: linear-gradient(135deg, var(--teal-700), var(--teal-600));">
                <div class="absolute -right-4 -bottom-4 w-20 h-20 rounded-full opacity-15" style="background: var(--teal-100);"></div>
                <p class="text-[10px] font-bold tracking-widest uppercase" style="color: var(--teal-100); opacity:0.7;">Seller Lokal</p>
                <p class="mt-2 text-lg font-bold leading-snug text-white" style="font-family:'Playfair Display',serif;">Etalase Digital</p>
                <p class="mt-1 text-xs leading-relaxed" style="color: var(--teal-100); opacity:0.8;">Untuk karya budaya UMKM Indonesia.</p>
            </div>

            {{-- Platform info card --}}
            <div class="rounded-2xl p-5 shadow-md relative overflow-hidden"
                 style="background: linear-gradient(135deg, var(--gold-100), #fffdf5); border: 1px solid var(--gold-300);">
                <div class="absolute -right-4 -bottom-4 w-20 h-20 rounded-full opacity-20" style="background: var(--gold-400);"></div>
                <p class="text-[10px] font-bold tracking-widest uppercase" style="color: var(--gold-600);">Semi E-commerce</p>
                <p class="mt-2 text-lg font-bold leading-snug" style="color: var(--kriya-800); font-family:'Playfair Display',serif;">Cari, Beli, Cerita.</p>
                <p class="mt-1 text-xs leading-relaxed" style="color: var(--kriya-600);">Internal & marketplace eksternal.</p>
            </div>
        </div>
    </div>
</section>

{{-- ============================================================
     FEATURED PRODUCTS SECTION
     ============================================================ --}}
<section class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">

    {{-- Section header --}}
    <div class="flex flex-wrap items-end justify-between gap-4 mb-10">
        <div>
            <span class="tag-cultural">Pilihan Terbaru</span>
            <h2 class="mt-2 text-3xl font-bold" style="font-family:'Playfair Display',serif; color:var(--kriya-800);">
                Produk Budaya yang Sedang Tampil
            </h2>
        </div>
        <a href="{{ route('products.index') }}"
           class="text-sm font-bold hover:underline underline-offset-4 transition flex items-center gap-1"
           style="color: var(--kriya-500);">
            Lihat semua produk
            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
            </svg>
        </a>
    </div>

    @if ($featuredProducts->isNotEmpty())
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($featuredProducts as $product)
                <x-product-card :product="$product" />
            @endforeach
        </div>
    @else
        <x-empty-state
            class="mt-2"
            title="Produk belum tersedia"
            message="Produk dari seller akan muncul di halaman ini setelah database diisi."
            action="Ke halaman produk"
            :href="route('products.index')" />
    @endif
</section>

{{-- ============================================================
     HOW IT WORKS / VALUE CARDS SECTION
     ============================================================ --}}
<section class="py-16" style="background-color: #eedfc5;">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        {{-- Section header --}}
        <div class="text-center mb-12">
            <span class="tag-cultural">Cara Kerja Platform</span>
            <h2 class="mt-3 text-3xl font-bold" style="font-family:'Playfair Display',serif; color:var(--kriya-800);">
                Siapa yang Bisa Menggunakan KriyaLokal?
            </h2>
        </div>

        <div class="grid gap-6 lg:grid-cols-3">
            {{-- Customer --}}
            <div class="card-kriya p-7 flex flex-col">
                <div class="h-12 w-12 rounded-xl grid place-items-center mb-5"
                     style="background: linear-gradient(135deg, var(--kriya-100), var(--warm-100));">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75" style="color:var(--kriya-500);">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-bold" style="font-family:'Playfair Display',serif; color:var(--kriya-800);">Untuk Customer</h3>
                <p class="mt-3 text-sm leading-relaxed flex-1" style="color: var(--kriya-600);">
                    Cari produk budaya, masukkan ke keranjang, checkout langsung di platform, dan pantau riwayat pesanan — semua dalam satu tempat.
                </p>
                <a href="{{ route('products.index') }}" class="mt-5 text-sm font-bold hover:underline underline-offset-4" style="color:var(--kriya-400);">Mulai belanja →</a>
            </div>

            {{-- Seller --}}
            <div class="card-kriya p-7 flex flex-col" style="border-color: var(--kriya-200);">
                <div class="h-12 w-12 rounded-xl grid place-items-center mb-5"
                     style="background: linear-gradient(135deg, var(--kriya-100), var(--gold-100));">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75" style="color:var(--gold-600);">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.4 7h12.8M7 13L5.4 5M10 21a1 1 0 100-2 1 1 0 000 2zm7 0a1 1 0 100-2 1 1 0 000 2z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-bold" style="font-family:'Playfair Display',serif; color:var(--kriya-800);">Untuk Seller UMKM</h3>
                <p class="mt-3 text-sm leading-relaxed flex-1" style="color: var(--kriya-600);">
                    Kelola produk, toggle status aktif, pantau pesanan yang masuk, dan buat laporan penjualan — etalase digital fokus pada budaya.
                </p>
                <a href="{{ route('partners') }}" class="mt-5 text-sm font-bold hover:underline underline-offset-4" style="color:var(--kriya-400);">Jadi seller →</a>
            </div>

            {{-- Platform --}}
            <div class="card-kriya p-7 flex flex-col">
                <div class="h-12 w-12 rounded-xl grid place-items-center mb-5"
                     style="background: linear-gradient(135deg, var(--teal-100), #e0f7f4);">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75" style="color:var(--teal-600);">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-bold" style="font-family:'Playfair Display',serif; color:var(--kriya-800);">Untuk Platform</h3>
                <p class="mt-3 text-sm leading-relaxed flex-1" style="color: var(--kriya-600);">
                    Employee dan admin memiliki panel monitoring sederhana untuk manajemen seller, produk, dan pengguna sesuai kebutuhan prototype.
                </p>
                <span class="mt-5 text-sm font-semibold" style="color:var(--warm-400);">Panel Admin →</span>
            </div>
        </div>
    </div>
</section>

{{-- ============================================================
     CULTURAL CTA BANNER
     ============================================================ --}}
<section class="relative overflow-hidden py-16 px-4">
    <div class="absolute inset-0 batik-bg-dark"></div>
    {{-- Batik decorative circles --}}
    <div class="pointer-events-none absolute -left-12 -top-12 h-64 w-64 rounded-full opacity-10" style="background: var(--gold-400);"></div>
    <div class="pointer-events-none absolute -right-8 bottom-0 h-48 w-48 rounded-full opacity-8" style="background: var(--kriya-300);"></div>
    <div class="pointer-events-none absolute right-1/3 top-0 h-24 w-24 rounded-full opacity-5" style="background: var(--gold-300);"></div>

    <div class="relative mx-auto max-w-3xl text-center">
        <span class="tag-cultural" style="color: var(--gold-300);">Bersama Kita Jaga Budaya</span>
        <h2 class="mt-4 text-3xl font-bold text-white sm:text-4xl" style="font-family:'Playfair Display',serif;">
            Bangga dengan Identitas Budaya Indonesia
        </h2>
        <p class="mt-4 text-base leading-relaxed" style="color: var(--kriya-200);">
            KriyaLokal hadir untuk membantu UMKM berbasis budaya lokal mengemas identitas mereka melalui
            storytelling visual — meningkatkan diferensiasi dan keputusan pembelian konsumen.
        </p>
        <div class="mt-8 flex flex-wrap justify-center gap-4">
            <a href="{{ route('products.index') }}" class="btn-kriya" style="background: linear-gradient(135deg, var(--gold-400), var(--gold-500)); color: var(--kriya-900);">
                Jelajah Produk Budaya
            </a>
            <a href="{{ route('about') }}" class="btn-kriya-outline" style="color: white; border-color: rgba(255,255,255,0.4); background: rgba(255,255,255,0.08);">
                Pelajari Misi Kami
            </a>
        </div>
    </div>
</section>
@endsection
