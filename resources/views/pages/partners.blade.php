@extends('layouts.market')

@section('title', 'Partner Seller — KriyaLokal, Pasar Budaya Indonesia')

@section('content')

{{-- ============================================================
     PARTNERS HERO
     ============================================================ --}}
<section class="relative overflow-hidden">
    <div class="absolute inset-0 hero-bg batik-texture"></div>
    <div class="pointer-events-none absolute -left-16 bottom-0 h-72 w-72 rounded-full opacity-8"
         style="background: radial-gradient(circle, var(--kriya-300) 0%, transparent 70%);"></div>

    <div class="relative mx-auto max-w-6xl px-4 py-20 sm:px-6 lg:px-8">
        <div class="grid gap-14 lg:grid-cols-[1fr_1.1fr] items-center">

            {{-- Left copy --}}
            <div class="animate-fade-up">
                <span class="tag-cultural flex items-center gap-2">
                    <span class="inline-block w-5 h-px" style="background:var(--kriya-400);"></span>
                    Partner Seller UMKM
                </span>
                <h1 class="mt-5 text-[2.4rem] font-bold leading-tight sm:text-[2.8rem]"
                    style="font-family:'Playfair Display',serif; color:var(--kriya-800);">
                    Seller Lokal Mendapat<br>
                    <em class="not-italic" style="color:var(--kriya-400);">Etalase Digital</em><br>
                    Berbasis Budaya.
                </h1>
                <div class="mt-4 section-divider" style="max-width:80px; margin:1.5rem 0;"></div>
                <p class="text-base leading-relaxed" style="color:var(--kriya-600);">
                    Partner dapat menampilkan produk budaya, memilih penjualan internal, redirect ke
                    marketplace eksternal, atau menggunakan keduanya sekaligus — dikemas dengan identitas
                    budaya yang kuat.
                </p>

                <div class="mt-8 flex flex-wrap gap-4">
                    @auth
                        @if (auth()->user()->role === 'customer')
                            <a href="{{ route('seller-applications.create') }}" class="btn-kriya">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                                </svg>
                                Ajukan Jadi Seller
                            </a>
                        @else
                            <a href="{{ route('products.index') }}" class="btn-kriya">Lihat Produk</a>
                        @endif
                    @else
                        <a href="{{ route('register') }}" class="btn-kriya">
                            Daftar untuk Mulai
                        </a>
                        <a href="{{ route('login') }}" class="btn-kriya-outline">Sudah punya akun</a>
                    @endauth
                </div>

                {{-- Stats --}}
                <div class="mt-10 flex flex-wrap gap-6">
                    <div class="stat-box text-center min-w-[90px]">
                        <p class="text-2xl font-extrabold" style="font-family:'Playfair Display',serif; color:var(--kriya-500);">2 Tipe</p>
                        <p class="text-xs font-semibold mt-1" style="color:var(--kriya-600);">Penjualan</p>
                    </div>
                    <div class="stat-box text-center min-w-[90px]">
                        <p class="text-2xl font-extrabold" style="font-family:'Playfair Display',serif; color:var(--kriya-500);">UMKM</p>
                        <p class="text-xs font-semibold mt-1" style="color:var(--kriya-600);">Fokus Budaya</p>
                    </div>
                    <div class="stat-box text-center min-w-[90px]">
                        <p class="text-2xl font-extrabold" style="font-family:'Playfair Display',serif; color:var(--kriya-500);">Free</p>
                        <p class="text-xs font-semibold mt-1" style="color:var(--kriya-600);">Bergabung</p>
                    </div>
                </div>
            </div>

            {{-- Right feature cards --}}
            <div class="animate-fade-up delay-200 grid grid-cols-2 gap-4">

                <div class="card-kriya p-6 flex flex-col gap-3">
                    <div class="h-10 w-10 rounded-lg grid place-items-center"
                         style="background:var(--kriya-100);">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75" style="color:var(--kriya-500);">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h16M4 18h7"/>
                        </svg>
                    </div>
                    <h3 class="text-base font-bold" style="font-family:'Playfair Display',serif; color:var(--kriya-800);">Etalase Produk</h3>
                    <p class="text-xs leading-5" style="color:var(--kriya-600);">Kelola katalog dan status aktif produk budaya Anda.</p>
                </div>

                <div class="card-kriya p-6 flex flex-col gap-3">
                    <div class="h-10 w-10 rounded-lg grid place-items-center"
                         style="background:var(--gold-100);">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75" style="color:var(--gold-600);">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                    <h3 class="text-base font-bold" style="font-family:'Playfair Display',serif; color:var(--kriya-800);">Pesanan Masuk</h3>
                    <p class="text-xs leading-5" style="color:var(--kriya-600);">Lihat order, terima atau tolak dengan mudah.</p>
                </div>

                <div class="card-kriya p-6 flex flex-col gap-3">
                    <div class="h-10 w-10 rounded-lg grid place-items-center"
                         style="background:var(--teal-100);">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75" style="color:var(--teal-600);">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                    <h3 class="text-base font-bold" style="font-family:'Playfair Display',serif; color:var(--kriya-800);">Laporan Penjualan</h3>
                    <p class="text-xs leading-5" style="color:var(--kriya-600);">Laporan dasar dan ekspor CSV untuk analisis.</p>
                </div>

                <div class="card-kriya p-6 flex flex-col gap-3">
                    <div class="h-10 w-10 rounded-lg grid place-items-center"
                         style="background:var(--kriya-100);">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75" style="color:var(--kriya-500);">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                        </svg>
                    </div>
                    <h3 class="text-base font-bold" style="font-family:'Playfair Display',serif; color:var(--kriya-800);">Semi E-commerce</h3>
                    <p class="text-xs leading-5" style="color:var(--kriya-600);">Internal checkout atau redirect ke toko eksternal.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ============================================================
     HOW TO BECOME SELLER
     ============================================================ --}}
<section class="py-16" style="background: linear-gradient(180deg, var(--warm-100), var(--warm-50));">
    <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <span class="tag-cultural">Cara Bergabung</span>
            <h2 class="mt-3 text-3xl font-bold" style="font-family:'Playfair Display',serif; color:var(--kriya-800);">
                3 Langkah Mudah Menjadi Partner Seller
            </h2>
        </div>

        <div class="grid gap-6 md:grid-cols-3">
            @foreach([
                ['num'=>'01', 'title'=>'Daftar Akun', 'desc'=>'Buat akun KriyaLokal gratis, lalu ajukan permohonan menjadi seller dari menu profil Anda.', 'color'=>'var(--kriya-400)'],
                ['num'=>'02', 'title'=>'Lengkapi Profil Toko', 'desc'=>'Isi informasi toko, deskripsi produk budaya, dan hubungkan marketplace eksternal jika ada.', 'color'=>'var(--gold-500)'],
                ['num'=>'03', 'title'=>'Mulai Berjualan', 'desc'=>'Upload produk, atur harga dan stok, aktifkan listing, dan mulai terima pesanan dari pelanggan.', 'color'=>'var(--teal-600)'],
            ] as $step)
            <div class="card-kriya p-7 flex flex-col items-start gap-4">
                <span class="text-4xl font-extrabold opacity-20" style="font-family:'Playfair Display',serif; color:{{ $step['color'] }};">{{ $step['num'] }}</span>
                <h3 class="text-lg font-bold -mt-2" style="font-family:'Playfair Display',serif; color:var(--kriya-800);">{{ $step['title'] }}</h3>
                <p class="text-sm leading-6" style="color:var(--kriya-600);">{{ $step['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
