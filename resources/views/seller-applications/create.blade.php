@extends('layouts.market')

@section('title', 'Jadi Seller - KriyaLokal')

@section('content')
    <section class="mx-auto max-w-5xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="grid gap-8 lg:grid-cols-[0.9fr_1.1fr]">
            <div>
                <p class="text-sm font-bold uppercase tracking-normal text-[#b85f2f]">Program seller</p>
                <h1 class="mt-2 text-3xl font-extrabold text-[#2f221b]">Buka etalase budaya di KriyaLokal.</h1>
                <p class="mt-4 leading-7 text-[#755846]">Pada prototype ini, pengajuan seller disetujui otomatis setelah form dikirim. Verifikasi dokumen nyata belum diimplementasikan.</p>
            </div>

            <form method="POST" action="{{ route('seller-applications.store') }}" class="rounded-lg border border-[#eadcc8] bg-white p-6 shadow-sm">
                @csrf
                <div class="space-y-5">
                    <div>
                        <label for="shop_name" class="text-sm font-bold text-[#3a281f]">Nama Toko</label>
                        <input id="shop_name" name="shop_name" type="text" value="{{ old('shop_name') }}" required class="mt-2 w-full rounded-md border-[#d8c4aa] bg-[#fffdf8] focus:border-[#b85f2f] focus:ring-[#b85f2f]">
                        <x-form-error name="shop_name" />
                    </div>
                    <div>
                        <label for="description" class="text-sm font-bold text-[#3a281f]">Deskripsi Toko</label>
                        <textarea id="description" name="description" rows="5" class="mt-2 w-full rounded-md border-[#d8c4aa] bg-[#fffdf8] focus:border-[#b85f2f] focus:ring-[#b85f2f]">{{ old('description') }}</textarea>
                        <x-form-error name="description" />
                    </div>
                    <div class="rounded-lg border border-dashed border-[#d8c4aa] bg-[#fff8ec] p-5">
                        <p class="text-sm font-bold text-[#3a281f]">Dokumen Seller</p>
                        <p class="mt-2 text-sm text-[#755846]">Placeholder untuk KTP, izin usaha, atau dokumen toko. Upload belum diproses oleh backend prototype.</p>
                    </div>
                    <button type="submit" class="w-full rounded-md bg-[#b85f2f] px-4 py-3 text-sm font-bold text-white transition hover:bg-[#9c4f26]">Kirim Pengajuan</button>
                </div>
            </form>
        </div>
    </section>
@endsection
