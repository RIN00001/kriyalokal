@props(['status'])

@php
    $normalized = str_replace('-', '_', strtolower((string) $status));
    $label = [
        'active' => 'Aktif',
        'inactive' => 'Nonaktif',
        'pending' => 'Menunggu',
        'accepted' => 'Diterima',
        'rejected' => 'Ditolak',
        'paid' => 'Dibayar',
        'unpaid' => 'Belum Dibayar',
        'success' => 'Selesai',
        'refund_requested' => 'Refund Diminta',
        'expired' => 'Kedaluwarsa',
        'cancelled' => 'Dibatalkan',
        'shipped' => 'Dikirim',
    ][$normalized] ?? ucfirst(str_replace('_', ' ', $normalized));

    $classes = [
        'active' => 'border-emerald-200 bg-emerald-50 text-emerald-700',
        'accepted' => 'border-emerald-200 bg-emerald-50 text-emerald-700',
        'paid' => 'border-emerald-200 bg-emerald-50 text-emerald-700',
        'success' => 'border-emerald-200 bg-emerald-50 text-emerald-700',
        'pending' => 'border-amber-200 bg-amber-50 text-amber-800',
        'unpaid' => 'border-amber-200 bg-amber-50 text-amber-800',
        'refund_requested' => 'border-orange-200 bg-orange-50 text-orange-800',
        'inactive' => 'border-stone-200 bg-stone-50 text-stone-700',
        'expired' => 'border-stone-200 bg-stone-50 text-stone-700',
        'cancelled' => 'border-red-200 bg-red-50 text-red-700',
        'rejected' => 'border-red-200 bg-red-50 text-red-700',
        'shipped' => 'border-sky-200 bg-sky-50 text-sky-700',
    ][$normalized] ?? 'border-[#eadcc8] bg-[#fff8ec] text-[#6f4c39]';
@endphp

<span {{ $attributes->merge(['class' => 'inline-flex items-center rounded-full border px-2.5 py-1 text-xs font-bold ' . $classes]) }}>
    {{ $label }}
</span>
