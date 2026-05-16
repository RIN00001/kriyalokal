@extends('layouts.market')

@section('title', 'Konfirmasi Password - KriyaLokal')

@section('content')
    <section class="mx-auto max-w-md px-4 py-12 sm:px-6 lg:px-8">
        <div class="rounded-lg border border-[#eadcc8] bg-white p-6 shadow-sm">
            <h1 class="text-2xl font-extrabold text-[#2f221b]">Konfirmasi Password</h1>
            <p class="mt-2 text-sm leading-6 text-[#755846]">Masukkan password untuk melanjutkan ke area aman akun.</p>

            <form method="POST" action="{{ route('password.confirm') }}" class="mt-6 space-y-5">
                @csrf
                <div>
                    <label for="password" class="text-sm font-bold text-[#3a281f]">Password</label>
                    <input id="password" name="password" type="password" required autocomplete="current-password" class="mt-2 w-full rounded-md border-[#d8c4aa] bg-[#fffdf8] shadow-sm focus:border-[#b85f2f] focus:ring-[#b85f2f]">
                    <x-form-error name="password" />
                </div>
                <button type="submit" class="w-full rounded-md bg-[#b85f2f] px-4 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-[#9c4f26]">
                    Konfirmasi
                </button>
            </form>
        </div>
    </section>
@endsection
