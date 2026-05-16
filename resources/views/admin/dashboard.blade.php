@extends('layouts.maintenance')

@section('title', 'Admin Dashboard - KriyaLokal')
@section('page-title', 'Admin Dashboard')

@section('content')
    <div class="grid gap-5 md:grid-cols-3">
        <div class="rounded-lg border border-[#eadcc8] bg-white p-5 shadow-sm">
            <p class="text-sm font-bold text-[#8a6a55]">Users</p>
            <p class="mt-2 text-3xl font-extrabold text-[#2f221b]">Monitor</p>
            <p class="mt-2 text-sm text-[#755846]">Placeholder untuk pengelolaan user.</p>
        </div>
        <div class="rounded-lg border border-[#eadcc8] bg-white p-5 shadow-sm">
            <p class="text-sm font-bold text-[#8a6a55]">Products</p>
            <p class="mt-2 text-3xl font-extrabold text-[#2f221b]">Audit</p>
            <p class="mt-2 text-sm text-[#755846]">Pantau katalog dan seller secara konseptual.</p>
        </div>
        <div class="rounded-lg border border-[#eadcc8] bg-white p-5 shadow-sm">
            <p class="text-sm font-bold text-[#8a6a55]">Maintenance</p>
            <p class="mt-2 text-3xl font-extrabold text-[#2f221b]">Standby</p>
            <p class="mt-2 text-sm text-[#755846]">Emergency shutdown tidak diimplementasikan pada prototype.</p>
        </div>
    </div>

    <div class="mt-8 rounded-lg border border-[#eadcc8] bg-white p-6 shadow-sm">
        <h2 class="text-xl font-extrabold text-[#2f221b]">Catatan Admin</h2>
        <p class="mt-3 leading-7 text-[#755846]">Admin bertanggung jawab pada pengelolaan aplikasi secara menyeluruh saat terjadi masalah besar. Panel ini disiapkan sebagai fondasi visual, bukan sistem maintenance aktif.</p>
    </div>
@endsection
