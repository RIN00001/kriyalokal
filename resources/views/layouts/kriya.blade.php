<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Kriya.Lokal — Platform budaya lokal yang membantu UMKM mengemas identitas dan nilai budaya Indonesia melalui storytelling visual dan digital engagement.">

    <title>@yield('title', 'Kriya.Lokal — Budaya × Modern × Digital')</title>

    {{-- Google Fonts: Cinzel (display), Lora (body serif), DM Sans (UI) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700;900&family=Lora:ital,wght@0,400;0,500;0,600;1,400;1,500&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>
        window.__KRIYA_CATALOG__ = @json($catalog ?? []);
    </script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.3/dist/cdn.min.js"></script>
</head>

<body class="font-sans antialiased text-kriya-brown bg-kriya-cream-light text-[15px] leading-relaxed"
    x-data="{ mobileOpen: false, cartOpen: false }">

    @if(request()->has('demo'))
        <div class="fixed top-0 inset-x-0 z-[100] bg-kriya-gold-soft text-kriya-brown-deep text-center text-xs font-semibold py-1.5 px-4 shadow">
            Mode demo — pembayaran disimulasikan; data keranjang disimpan di peramban Anda.
        </div>
    @endif

    {{-- ─── NAVIGATION ─── --}}
    <header
        class="sticky z-50 {{ request()->has('demo') ? 'top-7' : 'top-0' }}"
        style="background: linear-gradient(135deg, #3d1d0d 0%, #5c3317 60%, #3d1d0d 100%); border-bottom: 1px solid rgba(201,162,39,0.35); box-shadow: 0 2px 24px rgba(61,29,13,0.35);">

        {{-- Gold decorative top line --}}
        <div style="height: 3px; background: linear-gradient(to right, transparent, rgba(201,162,39,0.4) 20%, rgba(201,162,39,0.85) 50%, rgba(201,162,39,0.4) 80%, transparent);"></div>

        <div class="mx-auto flex max-w-6xl items-center justify-between gap-3 px-4 py-3 md:px-6">
            {{-- Logo --}}
            <a href="{{ route('kriya.home') }}"
                class="flex items-center gap-2 group">
                <span class="font-serif-display text-xl md:text-2xl font-bold tracking-wide text-kriya-cream-light drop-shadow-sm transition-opacity group-hover:opacity-90">
                    Kriya<span class="text-kriya-gold-soft">.</span>Lokal
                </span>
            </a>

            {{-- Desktop Nav --}}
            <nav class="hidden lg:flex items-center gap-1 rounded-full px-2 py-1 text-sm font-medium text-kriya-cream/85"
                style="background: rgba(255,255,255,0.07); border: 1px solid rgba(201,162,39,0.18);">
                <a href="{{ route('kriya.home') }}"
                    class="rounded-full px-3 py-1.5 transition-colors hover:bg-white/10 hover:text-kriya-gold-soft {{ request()->routeIs('kriya.home') ? 'bg-white/10 text-kriya-gold-soft' : '' }}">
                    Beranda</a>
                <a href="{{ route('kriya.collection') }}"
                    class="rounded-full px-3 py-1.5 transition-colors hover:bg-white/10 hover:text-kriya-gold-soft {{ request()->routeIs('kriya.collection') || request()->routeIs('kriya.product') ? 'bg-white/10 text-kriya-gold-soft' : '' }}">
                    Koleksi</a>
                <a href="{{ route('kriya.about') }}"
                    class="rounded-full px-3 py-1.5 transition-colors hover:bg-white/10 hover:text-kriya-gold-soft {{ request()->routeIs('kriya.about') ? 'bg-white/10 text-kriya-gold-soft' : '' }}">
                    Tentang</a>
                <a href="{{ route('kriya.seller') }}"
                    class="rounded-full px-3 py-1.5 transition-colors hover:bg-white/10 hover:text-kriya-gold-soft {{ request()->routeIs('kriya.seller') ? 'bg-white/10 text-kriya-gold-soft' : '' }}">
                    Penjual</a>
            </nav>

            <div class="flex items-center gap-2 md:gap-3">
                @auth
                    <a href="{{ route('dashboard') }}"
                        class="hidden sm:inline-flex items-center gap-2 rounded-full px-3 py-2 text-xs font-semibold text-kriya-cream transition hover:text-kriya-gold-soft"
                        style="background: rgba(255,255,255,0.1); border: 1px solid rgba(201,162,39,0.22);">
                        <i class="fas fa-user text-[11px]"></i>
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                        class="hidden sm:inline-flex items-center gap-2 rounded-full px-3 py-2 text-xs font-semibold text-kriya-cream transition hover:text-kriya-gold-soft"
                        style="background: rgba(255,255,255,0.1); border: 1px solid rgba(201,162,39,0.22);">
                        <i class="fas fa-user text-[11px]"></i>
                        Masuk
                    </a>
                @endauth
                {{-- Mobile menu button --}}
                <button type="button" class="lg:hidden p-2 text-kriya-cream" @click="mobileOpen = !mobileOpen"
                    aria-label="Menu">
                    <i class="fas fa-bars text-lg"></i>
                </button>
                {{-- Cart --}}
                <a href="{{ auth()->check() ? route('cart.index') : route('kriya.cart') }}"
                    class="relative inline-flex h-9 w-9 items-center justify-center rounded-full text-kriya-cream hover:text-kriya-gold-soft transition"
                    style="background: rgba(255,255,255,0.1); border: 1px solid rgba(201,162,39,0.3);"
                    aria-label="Keranjang">
                    <i class="fas fa-shopping-bag text-sm"></i>
                    <span id="kriya-cart-badge"
                        class="absolute -top-0.5 -right-0.5 min-h-[1.1rem] min-w-[1.1rem] rounded-full px-1 text-center text-[10px] font-bold leading-none text-white hidden items-center justify-center"
                        style="background: var(--color-kriya-orange);">0</span>
                </a>
            </div>
        </div>

        {{-- Mobile Menu --}}
        <div x-show="mobileOpen" x-transition
            class="lg:hidden border-t border-white/10 px-4 py-3 space-y-1"
            style="background: rgba(45,20,8,0.98);">
            <a href="{{ route('kriya.home') }}" class="block py-2.5 px-3 rounded-lg text-kriya-cream hover:bg-white/10 hover:text-kriya-gold-soft transition">Beranda</a>
            <a href="{{ route('kriya.collection') }}" class="block py-2.5 px-3 rounded-lg text-kriya-cream hover:bg-white/10 hover:text-kriya-gold-soft transition">Koleksi</a>
            <a href="{{ route('kriya.about') }}" class="block py-2.5 px-3 rounded-lg text-kriya-cream hover:bg-white/10 hover:text-kriya-gold-soft transition">Tentang</a>
            <a href="{{ route('kriya.seller') }}" class="block py-2.5 px-3 rounded-lg text-kriya-cream hover:bg-white/10 hover:text-kriya-gold-soft transition">Penjual</a>
            @auth
                <a href="{{ route('dashboard') }}" class="block py-2.5 px-3 rounded-lg text-kriya-cream hover:bg-white/10 hover:text-kriya-gold-soft transition">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="block py-2.5 px-3 rounded-lg text-kriya-cream hover:bg-white/10 hover:text-kriya-gold-soft transition">Masuk</a>
            @endauth
        </div>
    </header>

    <main>
        @if (session('status'))
            <div class="mx-auto mt-4 max-w-6xl px-4 md:px-6">
                <div class="rounded-xl border border-kriya-gold/30 bg-kriya-gold-pale px-4 py-3 text-sm font-semibold text-kriya-brown-deep">
                    {{ session('status') }}
                </div>
            </div>
        @endif
        @yield('content')
    </main>

    {{-- ─── FOOTER ─── --}}
    <footer style="background: linear-gradient(135deg, #2a1008 0%, #3d1d0d 100%); border-top: 1px solid rgba(201,162,39,0.25);">
        {{-- Gold top line --}}
        <div style="height: 2px; background: linear-gradient(to right, transparent, rgba(201,162,39,0.35) 20%, rgba(201,162,39,0.7) 50%, rgba(201,162,39,0.35) 80%, transparent);"></div>

        <div class="mx-auto grid max-w-6xl gap-10 px-4 py-14 md:grid-cols-3 md:px-6">
            <div>
                <p class="font-serif-display text-2xl font-bold text-kriya-gold-soft tracking-wide">Kriya.Lokal</p>
                <p class="mt-1 text-xs text-kriya-gold/60 uppercase tracking-widest font-medium">Budaya × Modern × Digital</p>
                <p class="mt-4 max-w-sm text-sm leading-relaxed text-kriya-cream/75 font-body-serif">
                    Platform kurasi UMKM berbasis budaya Indonesia yang mengemas identitas dan nilai melalui
                    storytelling visual dan digital engagement.
                </p>
            </div>
            <div>
                <h3 class="font-semibold text-kriya-gold-soft tracking-widest uppercase text-xs mb-5">Navigasi</h3>
                <ul class="space-y-3 text-sm">
                    <li><a href="{{ route('kriya.home') }}" class="text-kriya-cream/70 hover:text-kriya-gold-soft transition">Beranda</a></li>
                    <li><a href="{{ route('kriya.collection') }}" class="text-kriya-cream/70 hover:text-kriya-gold-soft transition">Koleksi</a></li>
                    <li><a href="{{ route('kriya.about') }}" class="text-kriya-cream/70 hover:text-kriya-gold-soft transition">Tentang</a></li>
                    <li><a href="{{ route('kriya.seller') }}" class="text-kriya-cream/70 hover:text-kriya-gold-soft transition">Dashboard Penjual</a></li>
                </ul>
            </div>
            <div>
                <h3 class="font-semibold text-kriya-gold-soft tracking-widest uppercase text-xs mb-5">Kontak</h3>
                <ul class="space-y-3 text-sm">
                    <li class="flex items-center gap-2.5 text-kriya-cream/70">
                        <i class="fas fa-envelope text-kriya-gold/70 w-4 text-center"></i> halo@kriya.lokal
                    </li>
                    <li class="flex items-center gap-2.5 text-kriya-cream/70">
                        <i class="fab fa-instagram text-kriya-gold/70 w-4 text-center"></i> @KriyaLokal
                    </li>
                    <li class="flex items-center gap-2.5 text-kriya-cream/70">
                        <i class="fab fa-whatsapp text-kriya-gold/70 w-4 text-center"></i> +62 812-3456-7890
                    </li>
                </ul>
            </div>
        </div>
        <div style="border-top: 1px solid rgba(255,255,255,0.06);" class="py-5 text-center text-xs text-kriya-cream/40">
            &copy; {{ date('Y') }} Kriya.Lokal — Nusantara Kontemporer. Semua hak cipta dilindungi.
        </div>
    </footer>

    @stack('scripts')
</body>

</html>
