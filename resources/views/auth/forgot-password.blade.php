@extends('layouts.market')

@section('title', 'Lupa Password - KriyaLokal')

@section('content')
    <section class="mx-auto max-w-md px-4 py-12 sm:px-6 lg:px-8">
        <div class="rounded-lg border border-[#eadcc8] bg-white p-6 shadow-sm">
            <h1 class="text-2xl font-extrabold text-[#2f221b]">Lupa Password</h1>
            <p class="mt-2 text-sm leading-6 text-[#755846]">Masukkan email akunmu. Kami akan mengirim tautan reset password jika email terdaftar.</p>

            <form method="POST" action="{{ route('password.email') }}" class="mt-6 space-y-5">
                @csrf
                <div>
                    <label for="email" class="text-sm font-bold text-[#3a281f]">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus class="mt-2 w-full rounded-md border-[#d8c4aa] bg-[#fffdf8] shadow-sm focus:border-[#b85f2f] focus:ring-[#b85f2f]">
                    <x-form-error name="email" />
                </div>
                <button type="submit" class="w-full rounded-md bg-[#b85f2f] px-4 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-[#9c4f26]">
                    Kirim Tautan Reset
                </button>
            </form>
        </div>
    </section>
@endsection
