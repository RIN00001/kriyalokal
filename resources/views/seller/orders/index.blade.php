@extends('layouts.market')

@section('title', 'Pesanan Seller - KriyaLokal')

@section('content')
    @include('partials.seller-subnav')

    <section class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-extrabold text-[#2f221b]">Pesanan Seller</h1>

        @if ($orderItems->isEmpty())
            <x-empty-state class="mt-8" title="Belum ada pesanan seller" message="Order item dari customer akan tampil di sini." />
        @else
            <div class="mt-8 overflow-hidden rounded-lg border border-[#eadcc8] bg-white shadow-sm">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-[#eadcc8]">
                        <thead class="bg-[#fff8ec]">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-normal text-[#8a6a55]">Order</th>
                                <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-normal text-[#8a6a55]">Produk</th>
                                <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-normal text-[#8a6a55]">Customer</th>
                                <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-normal text-[#8a6a55]">Subtotal</th>
                                <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-normal text-[#8a6a55]">Status</th>
                                <th class="px-4 py-3 text-right text-xs font-bold uppercase tracking-normal text-[#8a6a55]">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#eadcc8]">
                            @foreach ($orderItems as $item)
                                <tr>
                                    <td class="px-4 py-4 font-bold">{{ $item->order?->order_code }}</td>
                                    <td class="px-4 py-4">
                                        <p class="font-bold text-[#2f221b]">{{ $item->product_name }}</p>
                                        <p class="text-sm text-[#755846]">{{ $item->quantity }} item</p>
                                    </td>
                                    <td class="px-4 py-4">{{ $item->order?->user?->name ?? '-' }}</td>
                                    <td class="px-4 py-4 font-semibold">Rp{{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                    <td class="px-4 py-4"><x-status-badge :status="$item->seller_status" /></td>
                                    <td class="px-4 py-4">
                                        @if ($item->seller_status === 'pending')
                                            <div class="flex justify-end gap-2">
                                                <form method="POST" action="{{ route('seller.orders.items.accept', $item) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="text-sm font-bold text-emerald-700 hover:underline">Terima</button>
                                                </form>
                                                <form method="POST" action="{{ route('seller.orders.items.reject', $item) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="text-sm font-bold text-red-700 hover:underline">Tolak</button>
                                                </form>
                                            </div>
                                        @else
                                            <p class="text-right text-sm font-semibold text-[#755846]">Keputusan terkunci</p>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mt-8">{{ $orderItems->links() }}</div>
        @endif
    </section>
@endsection
