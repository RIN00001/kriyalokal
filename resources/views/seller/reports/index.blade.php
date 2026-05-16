@extends('layouts.market')

@section('title', 'Laporan Seller - KriyaLokal')

@section('content')
    @include('partials.seller-subnav')

    <section class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <h1 class="text-3xl font-extrabold text-[#2f221b]">Laporan Seller</h1>
            <div class="flex flex-wrap gap-2">
                <form method="POST" action="{{ route('seller.reports.generate') }}">
                    @csrf
                    <button type="submit" class="rounded-md bg-[#b85f2f] px-4 py-2 text-sm font-bold text-white transition hover:bg-[#9c4f26]">Generate Report</button>
                </form>
                <a href="{{ route('seller.reports.export') }}" class="rounded-md border border-[#d8c4aa] px-4 py-2 text-sm font-bold text-[#4c392d] transition hover:bg-[#f7ead8]">Export CSV</a>
            </div>
        </div>

        <div class="mt-8 grid gap-4 md:grid-cols-3">
            <div class="rounded-lg border border-[#eadcc8] bg-white p-5 shadow-sm">
                <p class="text-sm font-bold text-[#8a6a55]">Total Sales</p>
                <p class="mt-2 text-3xl font-extrabold">Rp{{ number_format($totalSales, 0, ',', '.') }}</p>
            </div>
            <div class="rounded-lg border border-[#eadcc8] bg-white p-5 shadow-sm">
                <p class="text-sm font-bold text-[#8a6a55]">Produk Terjual</p>
                <p class="mt-2 text-3xl font-extrabold">{{ $totalProductsSold }}</p>
            </div>
            <div class="rounded-lg border border-[#eadcc8] bg-white p-5 shadow-sm">
                <p class="text-sm font-bold text-[#8a6a55]">Total Order</p>
                <p class="mt-2 text-3xl font-extrabold">{{ $totalOrders }}</p>
            </div>
        </div>

        <div class="mt-8 rounded-lg border border-[#eadcc8] bg-white p-6 shadow-sm">
            <h2 class="text-xl font-extrabold text-[#2f221b]">Riwayat Laporan</h2>
            @if ($reports->isEmpty())
                <x-empty-state class="mt-5" title="Belum ada laporan" message="Tekan Generate Report untuk membuat ringkasan penjualan seller." />
            @else
                <div class="mt-5 space-y-3">
                    @foreach ($reports as $report)
                        <div class="rounded-lg border border-[#eadcc8] bg-[#fff8ec] p-4">
                            <div class="flex flex-wrap items-start justify-between gap-3">
                                <div>
                                    <p class="font-extrabold text-[#2f221b]">{{ $report->title }}</p>
                                    <p class="mt-1 text-sm text-[#755846]">{{ $report->description }}</p>
                                </div>
                                <span class="text-sm font-semibold text-[#8a6a55]">{{ $report->generated_at?->format('d M Y H:i') }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-6">{{ $reports->links() }}</div>
            @endif
        </div>
    </section>
@endsection
