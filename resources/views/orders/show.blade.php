@extends('layouts.market')

@section('title', 'Detail Pesanan - KriyaLokal')

@section('content')
    @php
        $payment = $order->payment;
        $canPayWithMidtrans = in_array($order->payment_status, ['unpaid', 'pending']) && $payment?->snap_token;
        $subtotal = $order->subtotalAmount();
        $tax = $order->taxAmount();
        $displayTotal = $order->totalAmountWithTax();
        $snapScriptUrl = config('services.midtrans.is_production')
            ? 'https://app.midtrans.com/snap/snap.js'
            : 'https://app.sandbox.midtrans.com/snap/snap.js';
    @endphp

    <section class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        <a href="{{ route('orders.index') }}" class="text-sm font-bold text-[#9c4f26] hover:underline">Kembali ke pesanan</a>

        <div class="mt-6 grid gap-8 lg:grid-cols-[1fr_360px]">
            <div class="space-y-4">
                <div class="rounded-lg border border-[#eadcc8] bg-white p-6 shadow-sm">
                    <p class="text-sm font-bold uppercase tracking-normal text-[#b85f2f]">Detail pesanan</p>
                    <h1 class="mt-2 text-3xl font-extrabold text-[#2f221b]">{{ $order->order_code }}</h1>
                    <div class="mt-4 flex flex-wrap gap-3">
                        <x-status-badge :status="$order->status" />
                        <x-status-badge :status="$order->payment_status" />
                    </div>
                </div>

                @foreach ($order->items as $item)
                    <div class="rounded-lg border border-[#eadcc8] bg-white p-4 shadow-sm">
                        <div class="flex flex-wrap items-start justify-between gap-4">
                            <div>
                                <h2 class="font-extrabold text-[#2f221b]">{{ $item->product_name }}</h2>
                                <p class="mt-1 text-sm text-[#755846]">Seller: {{ $item->seller?->shop_name ?? 'Seller KriyaLokal' }}</p>
                                <p class="mt-2 text-sm text-[#755846]">{{ $item->quantity }} x Rp{{ number_format($item->price, 0, ',', '.') }}</p>
                            </div>
                            <div class="text-right">
                                <x-status-badge :status="$item->seller_status" />
                                <p class="mt-3 font-extrabold text-[#2f221b]">Rp{{ number_format($item->subtotal, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <aside class="h-fit rounded-lg border border-[#eadcc8] bg-white p-6 shadow-sm">
                <h2 class="text-xl font-extrabold text-[#2f221b]">Pembayaran</h2>
                <div class="mt-5 space-y-3 text-sm">
                    <div class="flex justify-between gap-4">
                        <span class="text-[#755846]">Gateway</span>
                        <span class="font-bold">{{ $payment?->payment_gateway ?? 'Midtrans' }}</span>
                    </div>
                    <div class="flex justify-between gap-4">
                        <span class="text-[#755846]">Status</span>
                        <span class="font-bold">{{ $payment?->status ?? $order->payment_status }}</span>
                    </div>
                    @if ($payment?->payment_type)
                        <div class="flex justify-between gap-4">
                            <span class="text-[#755846]">Metode</span>
                            <span class="font-bold">{{ str_replace('_', ' ', $payment->payment_type) }}</span>
                        </div>
                    @endif
                    @if ($payment?->transaction_id)
                        <div class="flex justify-between gap-4">
                            <span class="text-[#755846]">Transaksi</span>
                            <span class="max-w-[180px] truncate font-bold">{{ $payment->transaction_id }}</span>
                        </div>
                    @endif
                    <div class="flex justify-between gap-4">
                        <span class="text-[#755846]">Midtrans Order</span>
                        <span class="max-w-[180px] truncate font-bold">{{ $order->midtrans_order_id }}</span>
                    </div>
                    <div class="flex justify-between gap-4 border-t border-[#eadcc8] pt-3">
                        <span class="text-[#755846]">Subtotal produk</span>
                        <span class="font-bold">Rp{{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between gap-4">
                        <span class="text-[#755846]">Pajak 5%</span>
                        <span class="font-bold">Rp{{ number_format($tax, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between gap-4 border-t border-[#eadcc8] pt-3 text-lg">
                        <span class="font-extrabold">Total Bayar</span>
                        <span class="font-extrabold">Rp{{ number_format($displayTotal, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="mt-6 space-y-3">
                    @if ($order->payment_status === 'paid')
                        <div class="rounded-lg border border-emerald-200 bg-emerald-50 p-4 text-sm font-semibold text-emerald-800">
                            Pembayaran sudah diterima.
                        </div>
                    @elseif ($canPayWithMidtrans)
                        <button type="button" id="pay-button" class="w-full rounded-md bg-[#b85f2f] px-4 py-3 text-sm font-bold text-white transition hover:bg-[#9c4f26]">
                            Bayar dengan Midtrans
                        </button>
                        <p id="midtrans-message" class="hidden rounded-md bg-[#fff8ec] px-3 py-2 text-sm font-semibold text-[#755846]"></p>

                        @if ($payment?->redirect_url)
                            <a href="{{ $payment->redirect_url }}" target="_blank" rel="noopener" class="flex w-full items-center justify-center rounded-md border border-[#d8c4aa] px-4 py-3 text-sm font-bold text-[#4c392d] transition hover:bg-[#f7ead8]">
                                Buka Halaman Pembayaran
                            </a>
                        @endif
                    @else
                        <form method="POST" action="{{ route('orders.payment-token', $order) }}">
                            @csrf
                            <button type="submit" class="w-full rounded-md bg-[#b85f2f] px-4 py-3 text-sm font-bold text-white transition hover:bg-[#9c4f26]">
                                Siapkan Pembayaran Midtrans
                            </button>
                        </form>
                    @endif

                    @if (in_array($order->status, ['paid', 'shipped']))
                        <form method="POST" action="{{ route('orders.success', $order) }}">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="w-full rounded-md bg-emerald-700 px-4 py-3 text-sm font-bold text-white transition hover:bg-emerald-800">Tandai Selesai</button>
                        </form>
                    @endif

                    @if (in_array($order->status, ['paid', 'shipped', 'success']))
                        <form method="POST" action="{{ route('orders.refund', $order) }}">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="w-full rounded-md border border-orange-200 px-4 py-3 text-sm font-bold text-orange-800 transition hover:bg-orange-50">Request Refund</button>
                        </form>
                    @endif
                </div>
            </aside>
        </div>
    </section>
@endsection

@if ($canPayWithMidtrans)
    @push('scripts')
        <script src="{{ $snapScriptUrl }}" data-client-key="{{ config('services.midtrans.client_key') }}"></script>
        <script>
            const payButton = document.getElementById('pay-button');
            const midtransMessage = document.getElementById('midtrans-message');
            const callbackUrl = @json(route('orders.midtrans-callback', $order));
            const snapToken = @json($payment->snap_token);
            const csrfToken = @json(csrf_token());

            function showMidtransMessage(message) {
                midtransMessage.textContent = message;
                midtransMessage.classList.remove('hidden');
            }

            async function sendMidtransResult(result) {
                showMidtransMessage('Memperbarui status pembayaran...');

                await fetch(callbackUrl, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify(result),
                });

                window.location.reload();
            }

            payButton?.addEventListener('click', function () {
                if (!window.snap) {
                    showMidtransMessage('Snap JS Midtrans belum berhasil dimuat. Coba refresh halaman.');
                    return;
                }

                window.snap.pay(snapToken, {
                    onSuccess: sendMidtransResult,
                    onPending: sendMidtransResult,
                    onError: sendMidtransResult,
                    onClose: function () {
                        showMidtransMessage('Popup pembayaran ditutup. Kamu bisa membuka Midtrans lagi dari tombol pembayaran.');
                    },
                });
            });
        </script>
    @endpush
@endif
