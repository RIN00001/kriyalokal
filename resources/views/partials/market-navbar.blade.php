@php
    $user = auth()->user();
    $role = $user?->role;
@endphp

{{-- ============================================================
     KriyaLokal Market Navbar — Cultural Indonesian Design
     ============================================================ --}}
<nav x-data="{ open: false, sellerOpen: false, profileOpen: false }"
     class="navbar-kriya sticky top-0 z-40"
     @click.outside="open = false; sellerOpen = false; profileOpen = false">

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-[68px] items-center justify-between gap-4">

            {{-- ---- Brand Logo ---- --}}
            <a href="{{ route('home') }}" class="flex items-center gap-3 shrink-0 group">
                <span class="grid h-10 w-10 place-items-center rounded-xl text-base font-extrabold text-white shadow-md transition group-hover:shadow-lg"
                      style="background: linear-gradient(135deg, var(--kriya-400), var(--kriya-600));">
                    {{-- Small batik-diamond icon --}}
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2L22 12L12 22L2 12L12 2Z" fill="rgba(255,255,255,0.35)" stroke="rgba(255,255,255,0.8)" stroke-width="1.5"/>
                        <circle cx="12" cy="12" r="3.5" fill="white" opacity="0.9"/>
                    </svg>
                </span>
                <span class="flex flex-col leading-none">
                    <span class="text-[16px] font-bold tracking-wider" style="font-family:'Cinzel',Georgia,serif; letter-spacing:0.06em; color: var(--kriya-800);">KriyaLokal</span>
                    <span class="text-[9px] font-semibold tracking-widest uppercase" style="font-family:'Cinzel',Georgia,serif; color: var(--gold-600); letter-spacing:0.2em;">Pasar Budaya</span>
                </span>
            </a>

            {{-- ---- Desktop Navigation ---- --}}
            <div class="hidden items-center gap-1 lg:flex">

                {{-- Core public links --}}
                @php
                    $navLink = 'rounded px-3.5 py-2 text-[0.72rem] font-semibold tracking-wider uppercase transition-all duration-150 hover:bg-[#f2e3d0]';
                    $activeLink = 'bg-[#f2e3d0] font-bold';
                    $idleLink = '';
                @endphp

                <a href="{{ route('home') }}"
                   class="{{ $navLink }} {{ request()->routeIs('home') ? $activeLink : $idleLink }}"
                   style="color: var(--kriya-700);">Beranda</a>

                <a href="{{ route('products.index') }}"
                   class="{{ $navLink }} {{ request()->routeIs('products.*') ? $activeLink : $idleLink }}"
                   style="color: var(--kriya-700);">Produk</a>

                <a href="{{ route('partners') }}"
                   class="{{ $navLink }} {{ request()->routeIs('partners') ? $activeLink : $idleLink }}"
                   style="color: var(--kriya-700);">Seller</a>

                <a href="{{ route('about') }}"
                   class="{{ $navLink }} {{ request()->routeIs('about') ? $activeLink : $idleLink }}"
                   style="color: var(--kriya-700);">Tentang</a>

                {{-- Divider --}}
                <div class="mx-2 h-6 w-px" style="background: var(--warm-300);"></div>

                @guest
                    <a href="{{ route('login') }}"
                       class="{{ $navLink }}"
                       style="color: var(--kriya-700);">Masuk</a>
                    <a href="{{ route('register') }}" class="btn-kriya ml-1">Daftar</a>

                @else
                    {{-- Cart & Orders for customer/seller --}}
                    @if (in_array($role, ['customer', 'seller']))
                        <a href="{{ route('cart.index') }}"
                           class="{{ $navLink }} {{ request()->routeIs('cart.*') ? $activeLink : $idleLink }}"
                           style="color: var(--kriya-700);" title="Keranjang">
                            <svg xmlns="http://www.w3.org/2000/svg" class="inline w-4 h-4 mr-1 -mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.4 7h12.8M7 13L5.4 5M10 21a1 1 0 100-2 1 1 0 000 2zm7 0a1 1 0 100-2 1 1 0 000 2z"/>
                            </svg>
                            Keranjang
                        </a>
                        <a href="{{ route('orders.index') }}"
                           class="{{ $navLink }} {{ request()->routeIs('orders.*') ? $activeLink : $idleLink }}"
                           style="color: var(--kriya-700);">Pesanan</a>
                    @endif

                    {{-- Seller dashboard dropdown --}}
                    @if ($role === 'seller')
                        <div class="relative" x-data="{ sellerOpen: false }">
                            <button @click="sellerOpen = !sellerOpen"
                                    class="{{ $navLink }} flex items-center gap-1"
                                    style="color: var(--kriya-700);">
                                Toko Saya
                                <svg :class="sellerOpen ? 'rotate-180' : ''" class="w-3.5 h-3.5 transition-transform" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd"/>
                                </svg>
                            </button>
                            <div x-show="sellerOpen" x-cloak x-transition
                                 @click.outside="sellerOpen = false"
                                 class="absolute right-0 mt-2 w-48 rounded-xl border py-1.5 shadow-xl z-50"
                                 style="background:#fff; border-color: var(--warm-200); box-shadow: 0 8px 24px rgba(47,26,14,0.12);">
                                <a href="{{ route('seller.dashboard') }}" class="block px-4 py-2.5 text-sm font-semibold hover:bg-[#f7ead8] transition" style="color:var(--kriya-700);">Dashboard</a>
                                <a href="{{ route('seller.products.index') }}" class="block px-4 py-2.5 text-sm font-semibold hover:bg-[#f7ead8] transition" style="color:var(--kriya-700);">Produk Saya</a>
                                <a href="{{ route('seller.orders.index') }}" class="block px-4 py-2.5 text-sm font-semibold hover:bg-[#f7ead8] transition" style="color:var(--kriya-700);">Pesanan Masuk</a>
                                <a href="{{ route('seller.reports.index') }}" class="block px-4 py-2.5 text-sm font-semibold hover:bg-[#f7ead8] transition" style="color:var(--kriya-700);">Laporan</a>
                            </div>
                        </div>
                    @endif

                    @if ($role === 'customer')
                        <a href="{{ route('seller-applications.create') }}"
                           class="{{ $navLink }} {{ request()->routeIs('seller-applications.*') ? $activeLink : $idleLink }}"
                           style="color: var(--kriya-700);">Jadi Seller</a>
                    @endif

                    {{-- Profile dropdown --}}
                    <div class="relative" x-data="{ profileOpen: false }">
                        <button @click="profileOpen = !profileOpen"
                                class="flex items-center gap-2 rounded-xl border px-3 py-2 text-sm font-semibold transition hover:bg-[#f2e3d0]"
                                style="border-color: var(--warm-300); color: var(--kriya-700);">
                            <span class="grid h-7 w-7 place-items-center rounded-full text-xs font-extrabold text-white" style="background: var(--kriya-400);">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </span>
                            <span class="max-w-[90px] truncate">{{ auth()->user()->name }}</span>
                            <svg :class="profileOpen ? 'rotate-180' : ''" class="w-3.5 h-3.5 transition-transform" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                        <div x-show="profileOpen" x-cloak x-transition
                             @click.outside="profileOpen = false"
                             class="absolute right-0 mt-2 w-44 rounded-xl border py-1.5 shadow-xl z-50"
                             style="background:#fff; border-color: var(--warm-200); box-shadow: 0 8px 24px rgba(47,26,14,0.12);">
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2.5 text-sm font-semibold hover:bg-[#f7ead8] transition" style="color:var(--kriya-700);">Profil Saya</a>
                            <div class="my-1 border-t" style="border-color: var(--warm-200);"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left block px-4 py-2.5 text-sm font-semibold hover:bg-red-50 transition" style="color:#c0392b;">Keluar</button>
                            </form>
                        </div>
                    </div>
                @endguest
            </div>

            {{-- ---- Mobile Hamburger ---- --}}
            <button type="button"
                    @click="open = !open"
                    class="inline-flex h-10 w-10 items-center justify-center rounded-lg border transition lg:hidden"
                    style="border-color: var(--warm-300); color: var(--kriya-700);"
                    aria-label="Toggle menu">
                <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg x-show="open" x-cloak xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>

    {{-- ---- Mobile Menu ---- --}}
    <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
         class="border-t lg:hidden"
         style="background: #fdf8f3; border-color: var(--warm-200);">
        <div class="mx-auto flex max-w-7xl flex-col divide-y px-4 py-3 sm:px-6" style="divide-color: var(--warm-100);">

            {{-- Public links --}}
            <div class="flex flex-col gap-0.5 pb-3">
                @php $mobLink = 'block rounded-lg px-3 py-2.5 text-sm font-semibold transition hover:bg-[#f2e3d0]'; @endphp
                <a href="{{ route('home') }}" class="{{ $mobLink }}" style="color:var(--kriya-700);">Beranda</a>
                <a href="{{ route('products.index') }}" class="{{ $mobLink }}" style="color:var(--kriya-700);">Produk</a>
                <a href="{{ route('partners') }}" class="{{ $mobLink }}" style="color:var(--kriya-700);">Seller</a>
                <a href="{{ route('about') }}" class="{{ $mobLink }}" style="color:var(--kriya-700);">Tentang Kami</a>
            </div>

            {{-- Auth links --}}
            <div class="flex flex-col gap-0.5 pt-3">
                @guest
                    <a href="{{ route('login') }}" class="{{ $mobLink }}" style="color:var(--kriya-700);">Masuk</a>
                    <a href="{{ route('register') }}" class="{{ $mobLink }} font-bold" style="color:var(--kriya-400);">Daftar Gratis</a>
                @else
                    @if (in_array($role, ['customer', 'seller']))
                        <a href="{{ route('cart.index') }}" class="{{ $mobLink }}" style="color:var(--kriya-700);">Keranjang</a>
                        <a href="{{ route('orders.index') }}" class="{{ $mobLink }}" style="color:var(--kriya-700);">Pesanan Saya</a>
                    @endif
                    @if ($role === 'customer')
                        <a href="{{ route('seller-applications.create') }}" class="{{ $mobLink }}" style="color:var(--kriya-700);">Jadi Seller</a>
                    @endif
                    @if ($role === 'seller')
                        <a href="{{ route('seller.dashboard') }}" class="{{ $mobLink }}" style="color:var(--kriya-700);">Seller Dashboard</a>
                        <a href="{{ route('seller.products.index') }}" class="{{ $mobLink }}" style="color:var(--kriya-700);">Produk Saya</a>
                        <a href="{{ route('seller.orders.index') }}" class="{{ $mobLink }}" style="color:var(--kriya-700);">Pesanan Masuk</a>
                        <a href="{{ route('seller.reports.index') }}" class="{{ $mobLink }}" style="color:var(--kriya-700);">Laporan</a>
                    @endif
                    <a href="{{ route('profile.edit') }}" class="{{ $mobLink }}" style="color:var(--kriya-700);">Profil Saya</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="{{ $mobLink }} w-full text-left" style="color:#c0392b;">Keluar</button>
                    </form>
                @endguest
            </div>
        </div>
    </div>
</nav>
