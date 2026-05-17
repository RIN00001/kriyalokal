@extends('layouts.kriya')

@section('title', ($product ? $product['name'] : 'Produk') . ' — Kriya.Lokal')

@section('content')
    @if ($product)
        @php
            $backendId = $product['backend_id'] ?? null;
            $canBuyBackend = $backendId && in_array($product['selling_type'] ?? 'internal', ['internal', 'both']) && (($product['stock'] ?? 0) > 0);
        @endphp
        <section class="border-b border-kriya-brown/10 bg-kriya-cream-dark py-10 md:py-14">
            <div class="mx-auto max-w-6xl px-4 md:px-6">
                <div data-kriya-product="{{ $product['id'] }}" class="grid gap-10 md:grid-cols-2">
                <div class="space-y-4">
                    <div class="overflow-hidden rounded-2xl bg-kriya-brown-deep/10 kriya-frame-gold">
                        <img src="{{ asset('images/kriya/' . $product['image']) }}" alt="{{ $product['name'] }}"
                            data-field="image"
                            class="aspect-[3/4] w-full object-cover"
                            onerror="this.onerror=null;this.src='{{ asset('images/kriya/placeholder.svg') }}';">
                    </div>
                    <p class="text-xs uppercase tracking-wider text-kriya-brown/60">Storytelling produk</p>
                    <p class="text-sm leading-relaxed text-kriya-brown/85" data-field="story">{{ $product['story'] }}</p>
                </div>
                <div class="flex flex-col gap-5">
                    <span
                        class="inline-flex w-fit rounded-full bg-kriya-brown-deep/10 px-3 py-1 text-xs font-semibold uppercase tracking-wide text-kriya-terracotta"
                        data-field="category">{{ $product['category'] }}</span>
                    <span class="text-xs font-medium text-kriya-brown/60" data-field="heritage">{{ $product['heritage'] }}</span>
                    <h1 class="font-serif-display text-4xl font-semibold text-kriya-brown-deep" data-field="name">
                        {{ $product['name'] }}</h1>
                    <p class="text-lg font-semibold text-kriya-terracotta" data-field="price">
                        Rp{{ number_format($product['price'], 0, ',', '.') }}</p>
                    <p class="text-kriya-brown/85 leading-relaxed" data-field="description">{{ $product['description'] }}</p>
                    <div class="rounded-2xl border border-kriya-brown/15 bg-white p-4 text-sm text-kriya-brown/80">
                        <strong class="text-kriya-brown-deep">MoFu:</strong> bandingkan keaslian cerita, ketebalan bahan
                        (deskripsi studio), dan eksklusivitas desain sebelum checkout — varian lebih ringan dapat ditambahkan
                        seller di dashboard.
                    </div>
                    <div class="flex flex-wrap gap-3 pt-2">
                        @if ($canBuyBackend)
                            <form method="POST" action="{{ route('cart.store', $backendId) }}" class="flex flex-1 min-w-[200px]">
                                @csrf
                                <button type="submit"
                                    class="inline-flex w-full items-center justify-center gap-2 rounded-full bg-kriya-orange px-6 py-3 text-sm font-semibold text-white shadow hover:bg-kriya-rust transition">
                                    <i class="fas fa-shopping-bag"></i> Tambah ke keranjang
                                </button>
                            </form>
                        @else
                            <button type="button"
                                class="kriya-add-cart inline-flex flex-1 min-w-[200px] items-center justify-center gap-2 rounded-full bg-kriya-orange px-6 py-3 text-sm font-semibold text-white shadow hover:bg-kriya-rust transition"
                                data-product-id="{{ $product['id'] }}">
                                <i class="fas fa-shopping-bag"></i> Tambah ke keranjang
                            </button>
                        @endif
                        <a href="{{ route('kriya.collection') }}"
                            class="inline-flex items-center justify-center rounded-full border border-kriya-brown/25 px-6 py-3 text-sm font-semibold text-kriya-brown-deep hover:bg-white transition">
                            Kembali ke koleksi
                        </a>
                    </div>
                </div>
                </div>
            </div>
        </section>
    @else
        <section class="border-b border-kriya-brown/10 bg-kriya-cream-dark py-10 md:py-14">
            <div id="kriya-product-shell" data-slug="{{ $slug }}"
                class="mx-auto hidden max-w-6xl gap-10 px-4 md:grid md:grid-cols-2 md:px-6">
                <div class="space-y-4">
                    <div class="overflow-hidden rounded-2xl bg-kriya-brown-deep/10 kriya-frame-gold">
                        <img data-slot="image" src="{{ asset('images/kriya/placeholder.svg') }}" alt=""
                            class="aspect-[3/4] w-full object-cover">
                    </div>
                    <p class="text-xs uppercase tracking-wider text-kriya-brown/60">Storytelling produk</p>
                    <p class="text-sm leading-relaxed text-kriya-brown/85" data-slot="story"></p>
                </div>
                <div class="flex flex-col gap-5">
                    <span
                        class="inline-flex w-fit rounded-full bg-kriya-brown-deep/10 px-3 py-1 text-xs font-semibold uppercase tracking-wide text-kriya-terracotta"
                        data-slot="category"></span>
                    <span class="text-xs font-medium text-kriya-brown/60" data-slot="heritage"></span>
                    <h1 class="font-serif-display text-4xl font-semibold text-kriya-brown-deep" data-slot="title"></h1>
                    <p class="text-lg font-semibold text-kriya-terracotta" data-slot="price"></p>
                    <p class="text-kriya-brown/85 leading-relaxed" data-slot="description"></p>
                    <div class="flex flex-wrap gap-3 pt-2">
                        <button type="button"
                            class="kriya-add-cart inline-flex flex-1 min-w-[200px] items-center justify-center gap-2 rounded-full bg-kriya-orange px-6 py-3 text-sm font-semibold text-white shadow hover:bg-kriya-rust transition"
                            data-product-id="">
                            <i class="fas fa-shopping-bag"></i> Tambah ke keranjang
                        </button>
                        <a href="{{ route('kriya.collection') }}"
                            class="inline-flex items-center justify-center rounded-full border border-kriya-brown/25 px-6 py-3 text-sm font-semibold text-kriya-brown-deep hover:bg-white transition">
                            Kembali ke koleksi
                        </a>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection
