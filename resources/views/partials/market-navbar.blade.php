@php
    $user = auth()->user();
    $role = $user?->role;
    $navLink = 'rounded-md px-3 py-2 text-sm font-semibold transition hover:bg-[#f7ead8] hover:text-[#9c4f26]';
    $activeLink = 'bg-[#f7ead8] text-[#9c4f26]';
    $idleLink = 'text-[#4c392d]';
@endphp

<nav x-data="{ open: false }" class="sticky top-0 z-40 border-b border-[#eadcc8] bg-[#fff8ec]/95 shadow-sm backdrop-blur">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between gap-4">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <span class="grid h-10 w-10 place-items-center rounded-lg bg-[#b85f2f] text-lg font-extrabold text-white shadow-sm">KL</span>
                <span>
                    <span class="block text-lg font-extrabold leading-5 text-[#2f221b]">KriyaLokal</span>
                    <span class="block text-xs font-semibold text-[#8a6a55]">Pasar budaya Indonesia</span>
                </span>
            </a>

            <div class="hidden items-center gap-1 lg:flex">
                <a href="{{ route('home') }}" class="{{ $navLink }} {{ request()->routeIs('home') ? $activeLink : $idleLink }}">Beranda</a>
                <a href="{{ route('products.index') }}" class="{{ $navLink }} {{ request()->routeIs('products.*') ? $activeLink : $idleLink }}">Produk</a>
                <a href="{{ route('partners') }}" class="{{ $navLink }} {{ request()->routeIs('partners') ? $activeLink : $idleLink }}">Partner Kita</a>
                <a href="{{ route('about') }}" class="{{ $navLink }} {{ request()->routeIs('about') ? $activeLink : $idleLink }}">Tentang Kami</a>

                @guest
                    <a href="{{ route('login') }}" class="{{ $navLink }} {{ request()->routeIs('login') ? $activeLink : $idleLink }}">Login</a>
                    <a href="{{ route('register') }}" class="rounded-md bg-[#b85f2f] px-4 py-2 text-sm font-bold text-white shadow-sm transition hover:bg-[#9c4f26]">Register</a>
                @else
                    @if (in_array($role, ['customer', 'seller']))
                        <a href="{{ route('cart.index') }}" class="{{ $navLink }} {{ request()->routeIs('cart.*') ? $activeLink : $idleLink }}">Keranjang</a>
                        <a href="{{ route('orders.index') }}" class="{{ $navLink }} {{ request()->routeIs('orders.*') ? $activeLink : $idleLink }}">Pesanan</a>
                    @endif

                    @if ($role === 'customer')
                        <a href="{{ route('seller-applications.create') }}" class="{{ $navLink }} {{ request()->routeIs('seller-applications.*') ? $activeLink : $idleLink }}">Jadi Seller</a>
                    @endif

                    @if ($role === 'seller')
                        <a href="{{ route('seller.dashboard') }}" class="{{ $navLink }} {{ request()->routeIs('seller.dashboard') ? $activeLink : $idleLink }}">Seller Dashboard</a>
                        <a href="{{ route('seller.products.index') }}" class="{{ $navLink }} {{ request()->routeIs('seller.products.*') ? $activeLink : $idleLink }}">Produk Saya</a>
                        <a href="{{ route('seller.orders.index') }}" class="{{ $navLink }} {{ request()->routeIs('seller.orders.*') ? $activeLink : $idleLink }}">Pesanan Seller</a>
                        <a href="{{ route('seller.reports.index') }}" class="{{ $navLink }} {{ request()->routeIs('seller.reports.*') ? $activeLink : $idleLink }}">Laporan</a>
                    @endif

                    <a href="{{ route('profile.edit') }}" class="{{ $navLink }} {{ request()->routeIs('profile.*') ? $activeLink : $idleLink }}">Profil</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="{{ $navLink }} {{ $idleLink }}">Logout</button>
                    </form>
                @endguest
            </div>

            <button type="button" @click="open = !open" class="inline-flex h-10 w-10 items-center justify-center rounded-md border border-[#d8c4aa] text-[#4c392d] lg:hidden" aria-label="Buka menu">
                <span x-show="!open" class="text-xl font-bold">=</span>
                <span x-show="open" x-cloak class="text-xl font-bold">x</span>
            </button>
        </div>
    </div>

    <div x-show="open" x-cloak class="border-t border-[#eadcc8] bg-[#fff8ec] lg:hidden">
        <div class="mx-auto flex max-w-7xl flex-col gap-1 px-4 py-4 sm:px-6">
            <a href="{{ route('home') }}" class="{{ $navLink }}">Beranda</a>
            <a href="{{ route('products.index') }}" class="{{ $navLink }}">Produk</a>
            <a href="{{ route('partners') }}" class="{{ $navLink }}">Partner Kita</a>
            <a href="{{ route('about') }}" class="{{ $navLink }}">Tentang Kami</a>

            @guest
                <a href="{{ route('login') }}" class="{{ $navLink }}">Login</a>
                <a href="{{ route('register') }}" class="{{ $navLink }}">Register</a>
            @else
                @if (in_array($role, ['customer', 'seller']))
                    <a href="{{ route('cart.index') }}" class="{{ $navLink }}">Keranjang</a>
                    <a href="{{ route('orders.index') }}" class="{{ $navLink }}">Pesanan</a>
                @endif
                @if ($role === 'customer')
                    <a href="{{ route('seller-applications.create') }}" class="{{ $navLink }}">Jadi Seller</a>
                @endif
                @if ($role === 'seller')
                    <a href="{{ route('seller.dashboard') }}" class="{{ $navLink }}">Seller Dashboard</a>
                    <a href="{{ route('seller.products.index') }}" class="{{ $navLink }}">Produk Saya</a>
                    <a href="{{ route('seller.orders.index') }}" class="{{ $navLink }}">Pesanan Seller</a>
                    <a href="{{ route('seller.reports.index') }}" class="{{ $navLink }}">Laporan</a>
                @endif
                <a href="{{ route('profile.edit') }}" class="{{ $navLink }}">Profil</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="{{ $navLink }} text-left">Logout</button>
                </form>
            @endguest
        </div>
    </div>
</nav>
