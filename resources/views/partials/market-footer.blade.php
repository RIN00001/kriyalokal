<footer class="footer-kriya batik-border-top">
    {{-- Top ornamental strip is rendered by batik-border-top --}}

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        {{-- Main footer grid --}}
        <div class="grid gap-10 py-14 md:grid-cols-[1.6fr_1fr_1fr] lg:gap-16">

            {{-- Brand column --}}
            <div>
                <div class="flex items-center gap-3 mb-5">
                    <span class="grid h-10 w-10 place-items-center rounded-xl text-white shadow-md"
                          style="background: linear-gradient(135deg, var(--kriya-400), var(--kriya-600));">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 2L22 12L12 22L2 12L12 2Z" fill="rgba(255,255,255,0.3)" stroke="rgba(255,255,255,0.75)" stroke-width="1.5"/>
                            <circle cx="12" cy="12" r="3.5" fill="white" opacity="0.9"/>
                        </svg>
                    </span>
                    <span>
                        <span class="block text-lg font-extrabold text-white" style="font-family:'Playfair Display',serif;">KriyaLokal</span>
                        <span class="block text-xs font-semibold tracking-widest uppercase" style="color: var(--kriya-200);">Pasar Budaya Indonesia</span>
                    </span>
                </div>

                <p class="text-sm leading-7" style="color: var(--kriya-200);">
                    Ruang digital untuk menemukan produk budaya Indonesia — dari toko lokal sampai karya modern bernuansa tradisi. Mendukung identitas budaya melalui <em>storytelling visual</em> dan digital engagement.
                </p>

                {{-- Cultural quote --}}
                <blockquote class="mt-6 border-l-2 pl-4 text-sm italic" style="border-color: var(--gold-400); color: var(--kriya-200);">
                    "Budaya adalah jiwa bangsa yang tak pernah padam."
                </blockquote>
            </div>

            {{-- Navigation column --}}
            <div>
                <p class="text-sm font-bold tracking-widest uppercase mb-5" style="color: var(--gold-300);">Jelajah</p>
                <div class="flex flex-col gap-3 text-sm">
                    <a href="{{ route('home') }}" class="transition hover:text-white flex items-center gap-2 group" style="color: var(--kriya-200);">
                        <span class="inline-block w-0 group-hover:w-3 h-px transition-all" style="background: var(--gold-400);"></span>
                        Beranda
                    </a>
                    <a href="{{ route('products.index') }}" class="transition hover:text-white flex items-center gap-2 group" style="color: var(--kriya-200);">
                        <span class="inline-block w-0 group-hover:w-3 h-px transition-all" style="background: var(--gold-400);"></span>
                        Produk Budaya
                    </a>
                    <a href="{{ route('partners') }}" class="transition hover:text-white flex items-center gap-2 group" style="color: var(--kriya-200);">
                        <span class="inline-block w-0 group-hover:w-3 h-px transition-all" style="background: var(--gold-400);"></span>
                        Partner Seller
                    </a>
                    <a href="{{ route('about') }}" class="transition hover:text-white flex items-center gap-2 group" style="color: var(--kriya-200);">
                        <span class="inline-block w-0 group-hover:w-3 h-px transition-all" style="background: var(--gold-400);"></span>
                        Tentang Kami
                    </a>
                </div>
            </div>

            {{-- Info column --}}
            <div>
                <p class="text-sm font-bold tracking-widest uppercase mb-5" style="color: var(--gold-300);">Platform</p>
                <div class="flex flex-col gap-3 text-sm" style="color: var(--kriya-200);">
                    <p class="flex items-start gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mt-0.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="color:var(--gold-400);">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Pembelian internal langsung
                    </p>
                    <p class="flex items-start gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mt-0.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="color:var(--gold-400);">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Redirect marketplace eksternal
                    </p>
                    <p class="flex items-start gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mt-0.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="color:var(--gold-400);">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Laporan & CRUD seller
                    </p>
                    <p class="flex items-start gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mt-0.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="color:var(--gold-400);">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Prototype semi e-commerce
                    </p>
                </div>
            </div>
        </div>

        {{-- Bottom bar --}}
        <div class="flex flex-col items-center justify-between gap-4 border-t py-6 text-xs sm:flex-row"
             style="border-color: rgba(255,255,255,0.08); color: var(--warm-400);">
            <p>© {{ date('Y') }} KriyaLokal. Semua hak dilindungi.</p>
            <p class="flex items-center gap-2">
                <span class="inline-block w-5 h-px" style="background: var(--gold-400);"></span>
                Dibuat dengan ♥ untuk kebudayaan Indonesia
                <span class="inline-block w-5 h-px" style="background: var(--gold-400);"></span>
            </p>
        </div>
    </div>
</footer>
