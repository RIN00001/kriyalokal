@extends('layouts.market')

@section('title', 'Pesanan - KriyaLokal')

@section('content')
    <section class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-extrabold text-[#2f221b]">Riwayat Pesanan</h1>

        @if ($orders->isEmpty())
            <x-empty-state class="mt-8" title="Belum ada pesanan" message="Pesanan akan muncul setelah kamu checkout dari keranjang." action="Jelajah Produk" :href="route('products.index')" />
        @else
            <div class="mt-8 overflow-hidden rounded-lg border border-[#eadcc8] bg-white shadow-sm">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-[#eadcc8]">
                        <thead class="bg-[#fff8ec]">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-normal text-[#8a6a55]">Kode</th>
                                <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-normal text-[#8a6a55]">Total</th>
                                <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-normal text-[#8a6a55]">Status</th>
                                <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-normal text-[#8a6a55]">Pembayaran</th>
                                <th class="px-4 py-3 text-right text-xs font-bold uppercase tracking-normal text-[#8a6a55]">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#eadcc8]">
                            @foreach ($orders as $order)
                                @php
                                    $displayTotal = $order->relationLoaded('items')
                                        ? $order->totalAmountWithTax()
                                        : $order->total_amount;
                                @endphp
                                <tr>
                                    <td class="px-4 py-4 font-bold text-[#2f221b]">{{ $order->order_code }}</td>
                                    <td class="px-4 py-4 font-semibold">Rp{{ number_format($displayTotal, 0, ',', '.') }}</td>
                                    <td class="px-4 py-4"><x-status-badge :status="$order->status" /></td>
                                    <td class="px-4 py-4"><x-status-badge :status="$order->payment_status" /></td>
                                    <td class="px-4 py-4 text-right">
                                        <a href="{{ route('orders.show', $order) }}" class="text-sm font-bold text-[#9c4f26] hover:underline">Detail</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-8">
                {{ $orders->links() }}
            </div>
        @endif
    </section>
@endsection
