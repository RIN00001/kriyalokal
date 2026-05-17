@props([
    'title'   => 'Belum ada data',
    'message' => 'Data akan muncul di sini setelah tersedia.',
    'action'  => null,
    'href'    => null,
])

<div {{ $attributes->merge(['class' => 'rounded-2xl border border-dashed p-10 text-center']) }}
     style="border-color:var(--warm-300); background:rgba(253,248,243,0.7);">

    {{-- Decorative icon --}}
    <div class="mx-auto h-16 w-16 rounded-full grid place-items-center mb-5 relative"
         style="background: linear-gradient(135deg, var(--kriya-100), var(--warm-100));">
        {{-- Diamond motif --}}
        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 2L22 12L12 22L2 12L12 2Z" fill="rgba(184,96,48,0.15)" stroke="var(--kriya-400)" stroke-width="1.5"/>
            <circle cx="12" cy="12" r="3" fill="var(--kriya-400)" opacity="0.5"/>
        </svg>
    </div>

    <h3 class="text-lg font-bold" style="font-family:'Playfair Display',serif; color:var(--kriya-800);">
        {{ $title }}
    </h3>
    <p class="mx-auto mt-2 max-w-sm text-sm leading-6" style="color:var(--kriya-600);">
        {{ $message }}
    </p>

    @if ($action && $href)
        <a href="{{ $href }}" class="btn-kriya mt-6 inline-flex">
            {{ $action }}
        </a>
    @endif
</div>
