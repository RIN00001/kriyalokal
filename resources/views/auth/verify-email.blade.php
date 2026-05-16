@extends('layouts.market')

@section('title', 'Verifikasi Email - KriyaLokal')

@section('content')
    <section class="mx-auto max-w-xl px-4 py-12 sm:px-6 lg:px-8">
        <div class="rounded-lg border border-[#eadcc8] bg-white p-6 shadow-sm">
            <h1 class="text-2xl font-extrabold text-[#2f221b]">Verifikasi Email</h1>
            <p class="mt-2 text-sm leading-6 text-[#755846]">Sebelum lanjut, cek email kamu untuk tautan verifikasi. Jika belum menerima, kirim ulang tautannya.</p>

            <div class="mt-6 flex flex-wrap gap-3">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="rounded-md bg-[#b85f2f] px-4 py-2 text-sm font-bold text-white shadow-sm transition hover:bg-[#9c4f26]">
                        Kirim Ulang
                    </button>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="rounded-md border border-[#d8c4aa] px-4 py-2 text-sm font-bold text-[#4c392d] transition hover:bg-[#f7ead8]">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </section>
@endsection
