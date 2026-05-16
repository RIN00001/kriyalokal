@extends('layouts.market')

@section('title', 'Tambah Produk - KriyaLokal')

@section('content')
    @include('partials.seller-subnav')

    <section class="mx-auto max-w-4xl px-4 py-10 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-extrabold text-[#2f221b]">Tambah Produk</h1>
        <form method="POST" action="{{ route('seller.products.store') }}" enctype="multipart/form-data" class="mt-8 rounded-lg border border-[#eadcc8] bg-white p-6 shadow-sm">
            @csrf
            @include('seller.products._form')
            <div class="mt-6 flex flex-wrap gap-3">
                <button type="submit" class="rounded-md bg-[#b85f2f] px-5 py-3 text-sm font-bold text-white transition hover:bg-[#9c4f26]">Simpan Produk</button>
                <a href="{{ route('seller.products.index') }}" class="rounded-md border border-[#d8c4aa] px-5 py-3 text-sm font-bold text-[#4c392d] transition hover:bg-[#f7ead8]">Batal</a>
            </div>
        </form>
    </section>
@endsection
