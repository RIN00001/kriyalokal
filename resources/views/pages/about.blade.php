@extends('layouts.market')

@section('title', 'Tentang Kami - KriyaLokal')

@section('content')
    <section class="mx-auto max-w-5xl px-4 py-14 sm:px-6 lg:px-8">
        <p class="text-sm font-bold uppercase tracking-normal text-[#b85f2f]">Tentang KriyaLokal</p>
        <h1 class="mt-3 text-4xl font-extrabold text-[#2f221b]">Membawa produk budaya Indonesia ke ruang digital yang lebih terarah.</h1>
        <p class="mt-5 text-lg leading-8 text-[#755846]">KriyaLokal adalah prototype semi e-commerce yang membantu produk budaya lokal mendapatkan eksposur. Platform ini mendukung pembelian langsung di website serta tautan ke marketplace eksternal milik seller.</p>

        <div class="mt-10 grid gap-6 md:grid-cols-2">
            <div class="rounded-lg border border-[#eadcc8] bg-white p-6 shadow-sm">
                <h2 class="text-xl font-extrabold text-[#2f221b]">Misi</h2>
                <p class="mt-3 leading-7 text-[#755846]">Membuat batik, kerajinan, aksesoris, dekorasi, dan produk budaya lain lebih mudah ditemukan oleh masyarakat modern.</p>
            </div>
            <div class="rounded-lg border border-[#eadcc8] bg-white p-6 shadow-sm">
                <h2 class="text-xl font-extrabold text-[#2f221b]">Prototype</h2>
                <p class="mt-3 leading-7 text-[#755846]">Fokus prototype adalah alur belanja, keranjang, transaksi, seller CRUD, pencarian, filter, dan laporan dasar.</p>
            </div>
        </div>
    </section>
@endsection
