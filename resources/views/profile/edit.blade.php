@extends('layouts.market')

@section('title', 'Profil - KriyaLokal')

@section('content')
    <section class="mx-auto max-w-5xl px-4 py-10 sm:px-6 lg:px-8">
        <div>
            <p class="text-sm font-bold uppercase tracking-normal text-[#b85f2f]">Akun KriyaLokal</p>
            <h1 class="mt-2 text-3xl font-extrabold text-[#2f221b]">Profil</h1>
            <p class="mt-2 text-[#755846]">Kelola nama, email, password, dan keamanan akun.</p>
        </div>

        <div class="mt-8 space-y-6">
            <div class="rounded-lg border border-[#eadcc8] bg-white p-6 shadow-sm">
                @include('profile.partials.update-profile-information-form')
            </div>
            <div class="rounded-lg border border-[#eadcc8] bg-white p-6 shadow-sm">
                @include('profile.partials.update-password-form')
            </div>
            <div class="rounded-lg border border-red-200 bg-white p-6 shadow-sm">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </section>
@endsection
