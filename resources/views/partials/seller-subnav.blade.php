@php
    $sellerLink = 'rounded-md px-3 py-2 text-sm font-semibold transition';
@endphp

<div class="border-b border-[#eadcc8] bg-white/75">
    <div class="mx-auto flex max-w-7xl gap-2 overflow-x-auto px-4 py-3 sm:px-6 lg:px-8">
        <a href="{{ route('seller.dashboard') }}" class="{{ $sellerLink }} {{ request()->routeIs('seller.dashboard') ? 'bg-[#b85f2f] text-white' : 'text-[#4c392d] hover:bg-[#f7ead8]' }}">Dashboard</a>
        <a href="{{ route('seller.products.index') }}" class="{{ $sellerLink }} {{ request()->routeIs('seller.products.*') ? 'bg-[#b85f2f] text-white' : 'text-[#4c392d] hover:bg-[#f7ead8]' }}">Produk Saya</a>
        <a href="{{ route('seller.orders.index') }}" class="{{ $sellerLink }} {{ request()->routeIs('seller.orders.*') ? 'bg-[#b85f2f] text-white' : 'text-[#4c392d] hover:bg-[#f7ead8]' }}">Pesanan Seller</a>
        <a href="{{ route('seller.reports.index') }}" class="{{ $sellerLink }} {{ request()->routeIs('seller.reports.*') ? 'bg-[#b85f2f] text-white' : 'text-[#4c392d] hover:bg-[#f7ead8]' }}">Laporan</a>
    </div>
</div>
