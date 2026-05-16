@extends('layouts.market')

@section('title', 'Dashboard - KriyaLokal')

@section('content')
    @php
        $user = auth()->user();
        $role = $user?->role ?? 'customer';
        $roleLabel = [
            'customer' => 'Customer',
            'seller' => 'Seller',
            'employee' => 'Employee',
            'admin' => 'Admin',
        ][$role] ?? ucfirst($role);
    @endphp

    <section class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="rounded-lg border border-[#eadcc8] bg-white p-6 shadow-sm">
            <p class="text-sm font-bold uppercase tracking-normal text-[#b85f2f]">Dashboard Akun</p>
            <h1 class="mt-2 text-3xl font-extrabold text-[#2f221b]">Halo, {{ $user->name }}</h1>
            <p class="mt-2 text-[#755846]">Ini halaman preview untuk memastikan login dan navigasi role berjalan.</p>

            <div class="mt-6 grid gap-4 md:grid-cols-3">
                <div class="rounded-lg bg-[#fff8ec] p-4">
                    <p class="text-xs font-bold uppercase tracking-normal text-[#8a6a55]">Email</p>
                    <p class="mt-1 font-bold text-[#2f221b]">{{ $user->email }}</p>
                </div>
                <div class="rounded-lg bg-[#fff8ec] p-4">
                    <p class="text-xs font-bold uppercase tracking-normal text-[#8a6a55]">Role</p>
                    <p class="mt-1 font-bold text-[#2f221b]">{{ $roleLabel }}</p>
                </div>
                <div class="rounded-lg bg-[#fff8ec] p-4">
                    <p class="text-xs font-bold uppercase tracking-normal text-[#8a6a55]">Status</p>
                    <p class="mt-1 font-bold text-emerald-700">Aktif</p>
                </div>
            </div>

            <div class="mt-8 grid gap-3 sm:grid-cols-2 lg:grid-cols-4">
                <a href="{{ route('products.index') }}" class="rounded-md border border-[#d8c4aa] px-4 py-3 text-sm font-bold text-[#4c392d] transition hover:bg-[#f7ead8]">Jelajah Produk</a>

                @if (in_array($role, ['customer', 'seller']))
                    <a href="{{ route('cart.index') }}" class="rounded-md border border-[#d8c4aa] px-4 py-3 text-sm font-bold text-[#4c392d] transition hover:bg-[#f7ead8]">Keranjang</a>
                    <a href="{{ route('orders.index') }}" class="rounded-md border border-[#d8c4aa] px-4 py-3 text-sm font-bold text-[#4c392d] transition hover:bg-[#f7ead8]">Riwayat Pesanan</a>
                @endif

                @if ($role === 'customer')
                    <a href="{{ route('seller-applications.create') }}" class="rounded-md bg-[#b85f2f] px-4 py-3 text-sm font-bold text-white transition hover:bg-[#9c4f26]">Jadi Seller</a>
                @elseif ($role === 'seller')
                    <a href="{{ route('seller.dashboard') }}" class="rounded-md bg-[#b85f2f] px-4 py-3 text-sm font-bold text-white transition hover:bg-[#9c4f26]">Dashboard Seller</a>
                @elseif ($role === 'employee')
                    <a href="{{ route('employee.dashboard') }}" class="rounded-md bg-[#b85f2f] px-4 py-3 text-sm font-bold text-white transition hover:bg-[#9c4f26]">Dashboard Employee</a>
                @elseif ($role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="rounded-md bg-[#b85f2f] px-4 py-3 text-sm font-bold text-white transition hover:bg-[#9c4f26]">Dashboard Admin</a>
                @endif
            </div>
        </div>
    </section>
@endsection
