@extends('layouts.market')

@section('title', 'Login - KriyaLokal')

@section('content')
    <section class="mx-auto grid max-w-6xl gap-8 px-4 py-12 sm:px-6 lg:grid-cols-[1fr_440px] lg:px-8">
        <div class="flex items-center">
            <div>
                <p class="text-sm font-bold uppercase tracking-normal text-[#b85f2f]">Masuk ke pasar budaya</p>
                <h1 class="mt-3 text-4xl font-extrabold leading-tight text-[#2f221b]">Temukan karya lokal, dukung seller budaya Indonesia.</h1>
                <p class="mt-4 max-w-xl text-base leading-7 text-[#755846]">Login untuk belanja, menyimpan transaksi, mengelola keranjang, dan melanjutkan perjalanan menjadi seller KriyaLokal.</p>
            </div>
        </div>

        <div class="rounded-lg border border-[#eadcc8] bg-white p-6 shadow-sm">
            <h2 class="text-2xl font-extrabold text-[#2f221b]">Login</h2>
            <p class="mt-2 text-sm text-[#755846]">Gunakan email dan password, atau lanjutkan dengan Google.</p>

            <a href="{{ route('google.redirect') }}" class="mt-6 flex w-full items-center justify-center rounded-md border border-[#d8c4aa] px-4 py-3 text-sm font-bold text-[#4c392d] transition hover:bg-[#f7ead8]">
                Lanjutkan dengan Google
            </a>

            <div class="my-6 flex items-center gap-3 text-xs font-bold uppercase tracking-normal text-[#a88770]">
                <span class="h-px flex-1 bg-[#eadcc8]"></span>
                atau
                <span class="h-px flex-1 bg-[#eadcc8]"></span>
            </div>

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="text-sm font-bold text-[#3a281f]">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus autocomplete="username" class="mt-2 w-full rounded-md border-[#d8c4aa] bg-[#fffdf8] shadow-sm focus:border-[#b85f2f] focus:ring-[#b85f2f]">
                    <x-form-error name="email" />
                </div>

                <div>
                    <label for="password" class="text-sm font-bold text-[#3a281f]">Password</label>
                    <input id="password" name="password" type="password" required autocomplete="current-password" class="mt-2 w-full rounded-md border-[#d8c4aa] bg-[#fffdf8] shadow-sm focus:border-[#b85f2f] focus:ring-[#b85f2f]">
                    <x-form-error name="password" />
                </div>

                <label class="flex items-center gap-2 text-sm text-[#755846]">
                    <input type="checkbox" name="remember" class="rounded border-[#d8c4aa] text-[#b85f2f] focus:ring-[#b85f2f]">
                    Ingat saya
                </label>

                <button type="submit" class="w-full rounded-md bg-[#b85f2f] px-4 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-[#9c4f26]">
                    Masuk
                </button>

                <div class="flex flex-wrap items-center justify-between gap-3 text-sm">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="font-semibold text-[#9c4f26] hover:underline">Lupa password?</a>
                    @endif
                    <a href="{{ route('register') }}" class="font-semibold text-[#9c4f26] hover:underline">Belum punya akun?</a>
                </div>
            </form>
        </div>
    </section>
@endsection
