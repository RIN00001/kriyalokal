@extends('layouts.market')

@section('title', 'Register - KriyaLokal')

@section('content')
    <section class="mx-auto grid max-w-6xl gap-8 px-4 py-12 sm:px-6 lg:grid-cols-[1fr_460px] lg:px-8">
        <div class="flex items-center">
            <div>
                <p class="text-sm font-bold uppercase tracking-normal text-[#b85f2f]">Bergabung dengan KriyaLokal</p>
                <h1 class="mt-3 text-4xl font-extrabold leading-tight text-[#2f221b]">Mulai belanja produk budaya dari seller lokal pilihan.</h1>
                <p class="mt-4 max-w-xl text-base leading-7 text-[#755846]">Akun customer dapat melihat produk, membuat keranjang, menyelesaikan transaksi prototype, dan mendaftar menjadi seller.</p>
            </div>
        </div>

        <div class="rounded-lg border border-[#eadcc8] bg-white p-6 shadow-sm">
            <h2 class="text-2xl font-extrabold text-[#2f221b]">Buat Akun</h2>

            <a href="{{ route('google.redirect') }}" class="mt-6 flex w-full items-center justify-center rounded-md border border-[#d8c4aa] px-4 py-3 text-sm font-bold text-[#4c392d] transition hover:bg-[#f7ead8]">
                Daftar dengan Google
            </a>

            <div class="my-6 flex items-center gap-3 text-xs font-bold uppercase tracking-normal text-[#a88770]">
                <span class="h-px flex-1 bg-[#eadcc8]"></span>
                atau
                <span class="h-px flex-1 bg-[#eadcc8]"></span>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="name" class="text-sm font-bold text-[#3a281f]">Nama</label>
                    <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus autocomplete="name" class="mt-2 w-full rounded-md border-[#d8c4aa] bg-[#fffdf8] shadow-sm focus:border-[#b85f2f] focus:ring-[#b85f2f]">
                    <x-form-error name="name" />
                </div>

                <div>
                    <label for="email" class="text-sm font-bold text-[#3a281f]">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="username" class="mt-2 w-full rounded-md border-[#d8c4aa] bg-[#fffdf8] shadow-sm focus:border-[#b85f2f] focus:ring-[#b85f2f]">
                    <x-form-error name="email" />
                </div>

                <div>
                    <label for="password" class="text-sm font-bold text-[#3a281f]">Password</label>
                    <input id="password" name="password" type="password" required autocomplete="new-password" class="mt-2 w-full rounded-md border-[#d8c4aa] bg-[#fffdf8] shadow-sm focus:border-[#b85f2f] focus:ring-[#b85f2f]">
                    <x-form-error name="password" />
                </div>

                <div>
                    <label for="password_confirmation" class="text-sm font-bold text-[#3a281f]">Konfirmasi Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password" class="mt-2 w-full rounded-md border-[#d8c4aa] bg-[#fffdf8] shadow-sm focus:border-[#b85f2f] focus:ring-[#b85f2f]">
                    <x-form-error name="password_confirmation" />
                </div>

                <button type="submit" class="w-full rounded-md bg-[#b85f2f] px-4 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-[#9c4f26]">
                    Daftar
                </button>

                <p class="text-sm text-[#755846]">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="font-semibold text-[#9c4f26] hover:underline">Login</a>
                </p>
            </form>
        </div>
    </section>
@endsection
