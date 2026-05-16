@extends('layouts.market')

@section('title', 'Produk Saya - KriyaLokal')

@section('content')
    @include('partials.seller-subnav')

    <section class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <h1 class="text-3xl font-extrabold text-[#2f221b]">Produk Saya</h1>
            <a href="{{ route('seller.products.create') }}" class="rounded-md bg-[#b85f2f] px-4 py-2 text-sm font-bold text-white transition hover:bg-[#9c4f26]">Tambah Produk</a>
        </div>

        @if ($products->isEmpty())
            <x-empty-state class="mt-8" title="Belum ada produk" message="Tambahkan produk budaya pertama untuk mulai tampil di katalog KriyaLokal." action="Tambah Produk" :href="route('seller.products.create')" />
        @else
            <div class="mt-8 overflow-hidden rounded-lg border border-[#eadcc8] bg-white shadow-sm">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-[#eadcc8]">
                        <thead class="bg-[#fff8ec]">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-normal text-[#8a6a55]">Produk</th>
                                <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-normal text-[#8a6a55]">Kategori</th>
                                <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-normal text-[#8a6a55]">Harga</th>
                                <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-normal text-[#8a6a55]">Status</th>
                                <th class="px-4 py-3 text-right text-xs font-bold uppercase tracking-normal text-[#8a6a55]">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#eadcc8]">
                            @foreach ($products as $product)
                                <tr>
                                    <td class="px-4 py-4">
                                        <p class="font-bold text-[#2f221b]">{{ $product->name }}</p>
                                        <p class="text-sm text-[#755846]">{{ $product->stock }} stok | {{ ucfirst($product->selling_type) }}</p>
                                    </td>
                                    <td class="px-4 py-4">{{ $product->category?->name ?? '-' }}</td>
                                    <td class="px-4 py-4 font-semibold">Rp{{ number_format($product->price, 0, ',', '.') }}</td>
                                    <td class="px-4 py-4"><x-status-badge :status="$product->is_active ? 'active' : 'inactive'" /></td>
                                    <td class="px-4 py-4">
                                        <div class="flex flex-wrap justify-end gap-2">
                                            <a href="{{ route('seller.products.show', $product) }}" class="text-sm font-bold text-[#9c4f26] hover:underline">Detail</a>
                                            <a href="{{ route('seller.products.edit', $product) }}" class="text-sm font-bold text-[#315f57] hover:underline">Edit</a>
                                            <form method="POST" action="{{ route('seller.products.toggle', $product) }}">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="text-sm font-bold text-[#4c392d] hover:underline">Toggle</button>
                                            </form>
                                            <form method="POST" action="{{ route('seller.products.destroy', $product) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-sm font-bold text-red-700 hover:underline">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-8">{{ $products->links() }}</div>
        @endif
    </section>
@endsection
