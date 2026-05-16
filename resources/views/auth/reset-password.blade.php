@extends('layouts.market')

@section('title', 'Reset Password - KriyaLokal')

@section('content')
    <section class="mx-auto max-w-md px-4 py-12 sm:px-6 lg:px-8">
        <div class="rounded-lg border border-[#eadcc8] bg-white p-6 shadow-sm">
            <h1 class="text-2xl font-extrabold text-[#2f221b]">Reset Password</h1>

            <form method="POST" action="{{ route('password.store') }}" class="mt-6 space-y-5">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div>
                    <label for="email" class="text-sm font-bold text-[#3a281f]">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username" class="mt-2 w-full rounded-md border-[#d8c4aa] bg-[#fffdf8] shadow-sm focus:border-[#b85f2f] focus:ring-[#b85f2f]">
                    <x-form-error name="email" />
                </div>

                <div>
                    <label for="password" class="text-sm font-bold text-[#3a281f]">Password Baru</label>
                    <input id="password" name="password" type="password" required autocomplete="new-password" class="mt-2 w-full rounded-md border-[#d8c4aa] bg-[#fffdf8] shadow-sm focus:border-[#b85f2f] focus:ring-[#b85f2f]">
                    <x-form-error name="password" />
                </div>

                <div>
                    <label for="password_confirmation" class="text-sm font-bold text-[#3a281f]">Konfirmasi Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password" class="mt-2 w-full rounded-md border-[#d8c4aa] bg-[#fffdf8] shadow-sm focus:border-[#b85f2f] focus:ring-[#b85f2f]">
                    <x-form-error name="password_confirmation" />
                </div>

                <button type="submit" class="w-full rounded-md bg-[#b85f2f] px-4 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-[#9c4f26]">
                    Simpan Password Baru
                </button>
            </form>
        </div>
    </section>
@endsection
