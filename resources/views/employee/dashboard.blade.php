@extends('layouts.maintenance')

@section('title', 'Employee Dashboard - KriyaLokal')
@section('page-title', 'Employee Dashboard')

@section('content')
    <div class="grid gap-5 md:grid-cols-3">
        <div class="rounded-lg border border-[#eadcc8] bg-white p-5 shadow-sm">
            <p class="text-sm font-bold text-[#8a6a55]">Premium Monitoring</p>
            <p class="mt-2 text-3xl font-extrabold text-[#2f221b]">Prototype</p>
            <p class="mt-2 text-sm text-[#755846]">Pantau fitur premium seller secara konseptual.</p>
        </div>
        <div class="rounded-lg border border-[#eadcc8] bg-white p-5 shadow-sm">
            <p class="text-sm font-bold text-[#8a6a55]">Seller Reports</p>
            <p class="mt-2 text-3xl font-extrabold text-[#2f221b]">Review</p>
            <p class="mt-2 text-sm text-[#755846]">Laporan seller dapat diperiksa pada fase berikutnya.</p>
        </div>
        <div class="rounded-lg border border-[#eadcc8] bg-white p-5 shadow-sm">
            <p class="text-sm font-bold text-[#8a6a55]">Report Corrections</p>
            <p class="mt-2 text-3xl font-extrabold text-[#2f221b]">Manual</p>
            <p class="mt-2 text-sm text-[#755846]">Koreksi laporan ditampilkan sebagai placeholder prototype.</p>
        </div>
    </div>

    <div class="mt-8 rounded-lg border border-[#eadcc8] bg-white p-6 shadow-sm">
        <h2 class="text-xl font-extrabold text-[#2f221b]">Catatan Employee</h2>
        <p class="mt-3 leading-7 text-[#755846]">Employee berperan sebagai semi-admin yang mengawasi premium feature, laporan otomatis, dan kualitas data seller. Pada prototype ini, fungsi tersebut belum mengubah data produksi.</p>
    </div>
@endsection
