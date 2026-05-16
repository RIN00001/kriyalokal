@props([
    'title' => 'Belum ada data',
    'message' => 'Data akan muncul di sini setelah tersedia.',
    'action' => null,
    'href' => null,
])

<div {{ $attributes->merge(['class' => 'rounded-lg border border-dashed border-[#d8c4aa] bg-white/70 p-8 text-center shadow-sm']) }}>
    <div class="mx-auto grid h-14 w-14 place-items-center rounded-full bg-[#f7ead8] text-xl font-extrabold text-[#b85f2f]">KL</div>
    <h3 class="mt-4 text-lg font-bold text-[#2f221b]">{{ $title }}</h3>
    <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-[#755846]">{{ $message }}</p>

    @if ($action && $href)
        <a href="{{ $href }}" class="mt-5 inline-flex items-center justify-center rounded-md bg-[#b85f2f] px-4 py-2 text-sm font-bold text-white shadow-sm transition hover:bg-[#9c4f26]">
            {{ $action }}
        </a>
    @endif
</div>
