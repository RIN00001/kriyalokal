@extends('layouts.market')

@section('title', 'Tentang Kami — KriyaLokal, Pasar Budaya Indonesia')

@section('content')

{{-- ============================================================
     ABOUT HERO
     ============================================================ --}}
<section class="relative overflow-hidden">
    <div class="absolute inset-0 hero-bg batik-texture"></div>
    <div class="pointer-events-none absolute -right-20 -top-20 h-80 w-80 rounded-full opacity-10"
         style="background: radial-gradient(circle, var(--gold-400) 0%, transparent 70%);"></div>

    <div class="relative mx-auto max-w-4xl px-4 py-20 sm:px-6 lg:px-8 text-center">
        <span class="tag-cultural flex justify-center items-center gap-2">
            <span class="inline-block w-6 h-px" style="background: var(--kriya-400);"></span>
            Tentang KriyaLokal
            <span class="inline-block w-6 h-px" style="background: var(--kriya-400);"></span>
        </span>
        <h1 class="mt-5 text-[2.4rem] font-bold leading-tight sm:text-[3rem]"
            style="font-family:'Playfair Display',serif; color:var(--kriya-800);">
            Membawa Produk Budaya Indonesia<br>ke Ruang Digital yang Lebih <em class="not-italic" style="color:var(--kriya-400);">Terarah</em>.
        </h1>
        <div class="mt-5 flex justify-center">
        </div>
        <p class="mt-6 max-w-2xl mx-auto text-lg leading-relaxed" style="color:var(--kriya-600);">
            KriyaLokal adalah platform semi e-commerce yang membantu produk budaya lokal mendapatkan
            eksposur lebih luas. Platform ini mendukung pembelian langsung di website serta tautan ke
            marketplace eksternal milik seller.
        </p>
    </div>
</section>

{{-- ============================================================
     MISSION & VISION CARDS
     ============================================================ --}}
<section class="mx-auto max-w-5xl px-4 py-16 sm:px-6 lg:px-8">

    <div class="grid gap-6 md:grid-cols-2">

        {{-- Misi --}}
        <div class="card-kriya p-8 relative overflow-hidden">
            <div class="absolute -top-6 -right-6 w-32 h-32 rounded-full opacity-5" style="background:var(--kriya-400);"></div>
            <div class="h-12 w-12 rounded-xl grid place-items-center mb-6"
                 style="background: linear-gradient(135deg, var(--kriya-100), var(--warm-100));">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75" style="color:var(--kriya-500);">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <h2 class="text-xl font-bold mb-3" style="font-family:'Playfair Display',serif; color:var(--kriya-800);">Misi Kami</h2>
            <p class="text-sm leading-7" style="color:var(--kriya-600);">
                Membuat batik, kerajinan, aksesoris, dekorasi, dan produk budaya lain lebih mudah ditemukan
                oleh masyarakat modern. Kami percaya bahwa identitas budaya lokal adalah kekuatan kompetitif
                yang perlu dikemas dengan storytelling visual yang kuat.
            </p>
        </div>

        {{-- Visi --}}
        <div class="card-kriya p-8 relative overflow-hidden" style="border-color: var(--kriya-200);">
            <div class="absolute -top-6 -right-6 w-32 h-32 rounded-full opacity-5" style="background:var(--gold-400);"></div>
            <div class="h-12 w-12 rounded-xl grid place-items-center mb-6"
                 style="background: linear-gradient(135deg, var(--gold-100), #fffdf5);">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75" style="color:var(--gold-600);">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                </svg>
            </div>
            <h2 class="text-xl font-bold mb-3" style="font-family:'Playfair Display',serif; color:var(--kriya-800);">Visi Kami</h2>
            <p class="text-sm leading-7" style="color:var(--kriya-600);">
                Menjadi jembatan antara UMKM budaya lokal dengan konsumen generasi digital — membantu
                para pengrajin dan seniman lokal Indonesia untuk meningkatkan diferensiasi produk dan
                keputusan pembelian konsumen melalui digital engagement.
            </p>
        </div>

        {{-- Prototype scope --}}
        <div class="card-kriya p-8 relative overflow-hidden">
            <div class="h-12 w-12 rounded-xl grid place-items-center mb-6"
                 style="background: linear-gradient(135deg, var(--teal-100), #e0f7f4);">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75" style="color:var(--teal-600);">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                </svg>
            </div>
            <h2 class="text-xl font-bold mb-3" style="font-family:'Playfair Display',serif; color:var(--kriya-800);">Fitur Prototype</h2>
            <p class="text-sm leading-7" style="color:var(--kriya-600);">
                Fokus prototype mencakup alur belanja lengkap, keranjang, transaksi, seller CRUD, pencarian
                & filter produk, serta laporan penjualan dasar. Semua fitur dirancang untuk demonstrasi
                model bisnis yang tervalidasi.
            </p>
        </div>

        {{-- Values --}}
        <div class="card-kriya p-8 relative overflow-hidden">
            <div class="h-12 w-12 rounded-xl grid place-items-center mb-6"
                 style="background: linear-gradient(135deg, var(--kriya-100), var(--warm-100));">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75" style="color:var(--kriya-500);">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                </svg>
            </div>
            <h2 class="text-xl font-bold mb-3" style="font-family:'Playfair Display',serif; color:var(--kriya-800);">Nilai-Nilai Kami</h2>
            <div class="grid grid-cols-2 gap-3 mt-4">
                @foreach(['Autentisitas', 'Inovasi', 'Komunitas', 'Kualitas'] as $val)
                <div class="flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full shrink-0" style="background:var(--gold-400);"></span>
                    <span class="text-sm font-semibold" style="color:var(--kriya-700);">{{ $val }}</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ============================================================
     CTA
     ============================================================ --}}
<section class="pb-16 px-4">
    <div class="mx-auto max-w-3xl rounded-2xl p-10 text-center relative overflow-hidden"
         style="background: linear-gradient(135deg, var(--kriya-600), var(--kriya-800));">
        <div class="pointer-events-none absolute -left-10 -top-10 h-40 w-40 rounded-full opacity-10" style="background:var(--gold-400);"></div>
        <h2 class="text-2xl font-bold text-white sm:text-3xl" style="font-family:'Playfair Display',serif;">
            Bergabunglah dengan Gerakan Budaya
        </h2>
        <p class="mt-3 text-sm leading-7" style="color:var(--kriya-200);">
            Bersama-sama melestarikan dan merayakan kebudayaan Indonesia untuk generasi mendatang.
        </p>
        <div class="mt-7 flex flex-wrap justify-center gap-4">
            <a href="{{ route('products.index') }}" class="btn-kriya"
               style="background: linear-gradient(135deg, var(--gold-400), var(--gold-500)); color: var(--kriya-900);">
                Jelajah Produk
            </a>
            <a href="{{ route('partners') }}" class="btn-kriya-outline"
               style="color:white; border-color:rgba(255,255,255,0.35); background:rgba(255,255,255,0.08);">
                Jadi Seller
            </a>
        </div>
    </div>
</section>

@endsection
