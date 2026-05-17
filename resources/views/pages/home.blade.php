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
<section class="relative overflow-hidden" style="padding-bottom: 0;">

    {{-- Background layers --}}
    <div class="absolute inset-0 hero-bg"></div>
    <div class="absolute inset-0 batik-texture batik-texture--soft pointer-events-none" aria-hidden="true"></div>

    {{-- Radial decorative gradients --}}
    <div class="pointer-events-none absolute -right-32 -top-32 h-[600px] w-[600px] rounded-full opacity-12"
         style="background: radial-gradient(circle, var(--gold-300) 0%, transparent 65%);"></div>
    <div class="pointer-events-none absolute -bottom-20 -left-20 h-[400px] w-[400px] rounded-full opacity-8"
         style="background: radial-gradient(circle, var(--kriya-200) 0%, transparent 65%);"></div>

    <div class="relative mx-auto grid min-h-[660px] max-w-7xl items-center gap-14 px-4 py-20 sm:px-6 lg:grid-cols-[1.1fr_0.9fr] lg:px-8">

        {{-- Left: Copy --}}
        <div class="animate-fade-up">

            {{-- Label pill --}}
            <div class="label-pill mb-7">
                <span class="inline-block w-3 h-px" style="background: var(--gold-400);"></span>
                Platform Budaya Lokal Indonesia
                <span class="inline-block w-3 h-px" style="background: var(--gold-400);"></span>
            </div>

            <h1 class="text-hero max-w-xl">
                Produk Budaya Lokal,<br>
                <span class="text-accent-gold">Dikemas</span> untuk Dunia.
            </h1>

            {{-- Gold divider --}}
            <div class="gold-divider my-6 max-w-xs">
                <span style="color:var(--gold-400); font-size:0.7rem;">◆</span>
            </div>

            <p class="text-lead mt-2">
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
                <div class="flex items-center gap-2.5">
                    <span class="inline-block w-1.5 h-1.5 rounded-full" style="background:var(--gold-400);"></span>
                    <span class="font-body text-sm font-medium" style="color:var(--kriya-600);">Produk Terverifikasi</span>
                </div>
                <div class="flex items-center gap-2.5">
                    <span class="inline-block w-1.5 h-1.5 rounded-full" style="background:var(--gold-400);"></span>
                    <span class="font-body text-sm font-medium" style="color:var(--kriya-600);">Seller UMKM Lokal</span>
                </div>
                <div class="flex items-center gap-2.5">
                    <span class="inline-block w-1.5 h-1.5 rounded-full" style="background:var(--gold-400);"></span>
                    <span class="font-body text-sm font-medium" style="color:var(--kriya-600);">Warisan Nusantara</span>
                </div>
            </div>
        </div>

        {{-- Right: Cultural visual cards --}}
        <div class="animate-fade-up delay-200 grid gap-4 sm:grid-cols-2">

            {{-- ── MAIN FEATURED CARD — "Unggulan" ── --}}
            {{-- Full-width card with authentic batik-panel layout --}}
            <div class="sm:col-span-2 card-cultural card-cultural-ornament relative overflow-hidden"
                 style="background: linear-gradient(155deg, #3d1e0d 0%, #2a1508 50%, #1a0e08 100%); min-height: 200px;">

                {{-- Batik crosshatch overlay --}}
                <div class="absolute inset-0 batik-texture" style="opacity:0.18;" aria-hidden="true"></div>

                {{-- Decorative radial glow --}}
                <div class="absolute top-0 right-0 w-72 h-72 opacity-12"
                     style="background: radial-gradient(circle at top right, var(--gold-300) 0%, transparent 65%);"></div>

                {{-- Horizontal gold rule across top --}}
                <div class="absolute top-0 left-0 right-0 h-px" style="background: linear-gradient(90deg, transparent 0%, var(--gold-400) 30%, var(--gold-300) 50%, var(--gold-400) 70%, transparent 100%); opacity:0.7;"></div>

                {{-- Bottom-right ornament (companion to ::after) --}}
                <div class="card-cultural-ornament-br"></div>

                <div class="relative z-[3] px-8 py-7">
                    {{-- Section label --}}
                    <div class="flex items-center gap-3 mb-4">
                        <span class="inline-block w-5 h-px" style="background:var(--gold-400); opacity:0.8;"></span>
                        <span style="font-family:'Cinzel',serif; font-size:0.58rem; font-weight:600; letter-spacing:0.25em; text-transform:uppercase; color:var(--gold-300);">Koleksi Unggulan</span>
                        <span class="inline-block w-5 h-px" style="background:var(--gold-400); opacity:0.8;"></span>
                    </div>

                    <h3 class="text-2xl leading-snug text-white"
                        style="font-family:'Cinzel',serif; font-weight:700; letter-spacing:0.05em; max-width: 22rem;">
                        Batik Nusantara
                    </h3>
                    <p class="mt-1 font-body text-sm italic" style="color:var(--gold-200); line-height:1.6;">
                        Motif Tradisi untuk Hari Ini
                    </p>

                    {{-- Gold thin divider --}}
                    <div class="my-4 w-16 h-px" style="background:linear-gradient(90deg, var(--gold-400), transparent); opacity:0.6;"></div>

                    <p class="font-body text-xs leading-relaxed" style="color:rgba(255,235,200,0.7); max-width:28rem;">
                        Ragam motif warisan leluhur — kawung, parang, truntum, dan mega mendung — hadir dalam koleksi terpilih dari pengrajin lokal Indonesia.
                    </p>

                    <a href="{{ route('products.index') }}"
                       class="mt-6 inline-flex items-center gap-2"
                       style="font-family:'Cinzel',serif; font-size:0.7rem; font-weight:600; letter-spacing:0.15em; text-transform:uppercase; color:var(--gold-300); text-decoration:none; transition:color 0.2s;">
                        Lihat Koleksi
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </div>

            {{-- ── SELLER CARD — Etalase Digital ── --}}
            <div class="card-cultural relative overflow-hidden"
                 style="background: linear-gradient(145deg, #1a4a44 0%, #255f58 100%);">

                <div class="absolute inset-0 batik-texture" style="opacity:0.15;" aria-hidden="true"></div>
                <div class="absolute top-0 left-0 right-0 h-px" style="background: linear-gradient(90deg, transparent, rgba(212,168,56,0.5), transparent);"></div>
                <div class="card-cultural-ornament-br" style="border-color:rgba(212,168,56,0.4);"></div>

                <div class="relative z-[3] p-6">
                    <span style="font-family:'Cinzel',serif; font-size:0.56rem; font-weight:600; letter-spacing:0.22em; text-transform:uppercase; color:var(--teal-100); opacity:0.75;">Seller Lokal</span>
                    <h3 class="mt-2 text-base leading-snug text-white"
                        style="font-family:'Cinzel',serif; font-weight:700; letter-spacing:0.05em;">
                        Etalase Digital
                    </h3>
                    <div class="my-3 w-10 h-px" style="background:rgba(212,168,56,0.4);"></div>
                    <p class="font-body text-xs leading-relaxed" style="color:rgba(212,232,228,0.8);">
                        Ruang digital untuk karya budaya UMKM Indonesia.
                    </p>
                </div>
            </div>

            {{-- ── PLATFORM CARD — Cari, Beli, Cerita ── --}}
            <div class="card-cultural relative overflow-hidden"
                 style="background: linear-gradient(145deg, var(--parchment-dark) 0%, var(--parchment-mid) 100%); border: 1px solid rgba(212,168,56,0.35);">

                <div class="absolute inset-0 batik-texture" style="opacity:0.35;" aria-hidden="true"></div>
                <div class="absolute top-0 left-0 right-0 h-px" style="background: linear-gradient(90deg, transparent, var(--gold-400), transparent); opacity:0.5;"></div>
                <div class="card-cultural-ornament-br"></div>

                <div class="relative z-[3] p-6">
                    <span style="font-family:'Cinzel',serif; font-size:0.56rem; font-weight:600; letter-spacing:0.22em; text-transform:uppercase; color:var(--gold-600);">Semi E-commerce</span>
                    <h3 class="mt-2 text-base leading-snug"
                        style="font-family:'Cinzel',serif; font-weight:700; letter-spacing:0.05em; color:var(--kriya-800);">
                        Cari, Beli, Cerita.
                    </h3>
                    <div class="my-3 w-10 h-px" style="background:var(--gold-400); opacity:0.5;"></div>
                    <p class="font-body text-xs leading-relaxed" style="color:var(--kriya-600);">
                        Internal & marketplace eksternal.
                    </p>
                </div>
            </div>

        </div>
    </div>

    {{-- Seamless fade into next section --}}
    <div class="section-edge-fade section-edge-fade--to-light" aria-hidden="true"></div>
</section>

{{-- ============================================================
     FEATURED PRODUCTS SECTION
     ============================================================ --}}
<section class="section-panel--light relative mx-auto max-w-7xl px-4 py-20 sm:px-6 lg:px-8">

    {{-- Section header --}}
    <div class="flex flex-wrap items-end justify-between gap-4 mb-12">
        <div>
            <div class="label-pill mb-4">
                <span style="color:var(--gold-400);">◆</span>
                Pilihan Terbaru
            </div>
            <h2 class="text-section-title heading-accent">
                Produk Budaya yang Sedang Tampil
            </h2>
        </div>
        <a href="{{ route('products.index') }}"
           class="font-body text-sm font-semibold hover:underline underline-offset-4 transition flex items-center gap-1.5 italic"
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
<section class="section-panel--warm relative py-20">
    <div class="section-edge-fade section-edge-fade--from-light" aria-hidden="true"></div>

    <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        {{-- Section header --}}
        <div class="text-center mb-14">
            <div class="label-pill mx-auto mb-5">
                <span style="color:var(--gold-400);">◆</span>
                Cara Kerja Platform
            </div>
            <h2 class="text-section-title">
                Siapa yang Bisa Menggunakan KriyaLokal?
            </h2>
            {{-- Gold divider --}}
            <div class="gold-divider max-w-xs mx-auto mt-5">
                <span style="color:var(--gold-400); font-size:0.65rem;">◆</span>
            </div>
        </div>

        <div class="grid gap-6 lg:grid-cols-3">
            {{-- Customer --}}
            <div class="card-kriya p-8 flex flex-col relative">
                <div class="h-12 w-12 rounded-sm grid place-items-center mb-6"
                     style="background: linear-gradient(135deg, var(--kriya-100), var(--warm-100)); border:1px solid rgba(212,168,56,0.3);">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75" style="color:var(--kriya-500);">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                </div>
                <h3 class="text-base" style="font-family:'Cinzel',serif; font-weight:700; letter-spacing:0.05em; color:var(--kriya-800);">Untuk Customer</h3>
                <div class="my-3 w-10 h-px" style="background:linear-gradient(90deg, var(--gold-400), transparent); opacity:0.6;"></div>
                <p class="font-body text-sm leading-relaxed flex-1" style="color:var(--kriya-600);">
                    Cari produk budaya, masukkan ke keranjang, checkout langsung di platform, dan pantau riwayat pesanan — semua dalam satu tempat.
                </p>
                <a href="{{ route('products.index') }}" class="mt-6 font-body text-sm italic font-semibold hover:underline underline-offset-4" style="color:var(--gold-600);">Mulai belanja →</a>
            </div>

            {{-- Seller --}}
            <div class="card-kriya p-8 flex flex-col" style="border-color: rgba(212,168,56,0.4);">
                <div class="h-12 w-12 rounded-sm grid place-items-center mb-6"
                     style="background: linear-gradient(135deg, var(--gold-100), #fffdf5); border:1px solid rgba(212,168,56,0.4);">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75" style="color:var(--gold-600);">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.4 7h12.8M7 13L5.4 5M10 21a1 1 0 100-2 1 1 0 000 2zm7 0a1 1 0 100-2 1 1 0 000 2z"/>
                    </svg>
                </div>
                <h3 class="text-base" style="font-family:'Cinzel',serif; font-weight:700; letter-spacing:0.05em; color:var(--kriya-800);">Untuk Seller UMKM</h3>
                <div class="my-3 w-10 h-px" style="background:linear-gradient(90deg, var(--gold-400), transparent); opacity:0.6;"></div>
                <p class="font-body text-sm leading-relaxed flex-1" style="color:var(--kriya-600);">
                    Kelola produk, toggle status aktif, pantau pesanan yang masuk, dan buat laporan penjualan — etalase digital fokus pada budaya.
                </p>
                <a href="{{ route('partners') }}" class="mt-6 font-body text-sm italic font-semibold hover:underline underline-offset-4" style="color:var(--gold-600);">Jadi seller →</a>
            </div>

            {{-- Platform --}}
            <div class="card-kriya p-8 flex flex-col">
                <div class="h-12 w-12 rounded-sm grid place-items-center mb-6"
                     style="background: linear-gradient(135deg, var(--teal-100), #e0f7f4); border:1px solid rgba(37,95,88,0.2);">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75" style="color:var(--teal-600);">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </div>
                <h3 class="text-base" style="font-family:'Cinzel',serif; font-weight:700; letter-spacing:0.05em; color:var(--kriya-800);">Untuk Platform</h3>
                <div class="my-3 w-10 h-px" style="background:linear-gradient(90deg, var(--gold-400), transparent); opacity:0.6;"></div>
                <p class="font-body text-sm leading-relaxed flex-1" style="color:var(--kriya-600);">
                    Employee dan admin memiliki panel monitoring sederhana untuk manajemen seller, produk, dan pengguna sesuai kebutuhan prototype.
                </p>
                <span class="mt-6 font-body text-sm italic font-semibold" style="color:var(--warm-400);">Panel Admin →</span>
            </div>
        </div>
    </div>

    {{-- Smooth fade into dark CTA --}}
    <div class="section-edge-fade section-edge-fade--to-dark" aria-hidden="true"></div>
</section>

{{-- ============================================================
     CULTURAL CTA BANNER
     ============================================================ --}}
<section class="relative overflow-hidden py-24 px-4">
    <div class="absolute inset-0 section-cta-gradient"></div>
    <div class="absolute inset-0 batik-bg-dark pointer-events-none" style="opacity:0.35;" aria-hidden="true"></div>

    {{-- Radial glows --}}
    <div class="pointer-events-none absolute -left-16 -top-16 h-72 w-72 rounded-full"
         style="background: radial-gradient(circle, rgba(212,168,56,0.18) 0%, transparent 65%);"></div>
    <div class="pointer-events-none absolute -right-10 bottom-0 h-56 w-56 rounded-full"
         style="background: radial-gradient(circle, rgba(184,96,48,0.15) 0%, transparent 65%);"></div>

    {{-- Top gold line --}}
    <div class="absolute top-0 left-0 right-0 h-px" style="background: linear-gradient(90deg, transparent 5%, var(--gold-400) 30%, var(--gold-300) 50%, var(--gold-400) 70%, transparent 95%); opacity:0.5;"></div>

    <div class="relative z-[2] mx-auto max-w-3xl text-center">
        <div class="label-pill mx-auto mb-6" style="border-color:rgba(212,168,56,0.35); background:rgba(212,168,56,0.1); color:var(--gold-300);">
            <span style="color:var(--gold-300);">◆</span>
            Bersama Kita Jaga Budaya
        </div>
        <h2 class="text-section-title text-white mt-4">
            Bangga dengan Identitas Budaya Indonesia
        </h2>
        <div class="gold-divider max-w-xs mx-auto my-6">
            <span style="color:var(--gold-400); font-size:0.65rem;">◆</span>
        </div>
        <p class="font-body text-sm leading-relaxed mx-auto" style="color: rgba(255,235,200,0.8); max-width:36rem;">
            KriyaLokal hadir untuk membantu UMKM berbasis budaya lokal mengemas identitas mereka melalui
            storytelling visual — meningkatkan diferensiasi dan keputusan pembelian konsumen.
        </p>
        <div class="mt-10 flex flex-wrap justify-center gap-4">
            <a href="{{ route('products.index') }}" class="btn-kriya"
               style="background: linear-gradient(135deg, var(--gold-500), var(--gold-600)); color: var(--kriya-900); border-color:rgba(0,0,0,0.15);">
                Jelajah Produk Budaya
            </a>
            <a href="{{ route('about') }}" class="btn-kriya-outline"
               style="color: rgba(255,235,200,0.9); border-color: rgba(212,168,56,0.45); background: rgba(212,168,56,0.08);">
                Pelajari Misi Kami
            </a>
        </div>
    </div>

    {{-- Fade into footer --}}
    <div class="section-edge-fade section-edge-fade--to-footer" aria-hidden="true"></div>
</section>

@endsection
