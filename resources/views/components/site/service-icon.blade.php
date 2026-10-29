@props(['name' => null])

@php
    $icons = [
        'code' => '<path d="m8 9-4 3 4 3M16 9l4 3-4 3M13.5 5l-3 14" stroke-linecap="round" stroke-linejoin="round"/>',
        'automation' => '<path d="M12 3v3m0 12v3M3 12h3m12 0h3M5.6 5.6l2.1 2.1m8.6 8.6 2.1 2.1m0-12.8-2.1 2.1m-8.6 8.6-2.1 2.1" stroke-linecap="round"/><circle cx="12" cy="12" r="3.5"/>',
        'cloud' => '<path d="M7 18a4 4 0 0 1-.4-7.98A5.5 5.5 0 0 1 17.3 8.5 3.75 3.75 0 0 1 17 18H7Z" stroke-linejoin="round"/>',
        'mobile' => '<rect x="7" y="2.75" width="10" height="18.5" rx="2.25"/><path d="M10.5 18.25h3" stroke-linecap="round"/>',
        'chart' => '<path d="M4 19.5V13m5.3 6.5V8.8M14.7 19.5v-8.7M20 19.5V5" stroke-linecap="round"/>',
        'shield' => '<path d="M12 3 5 5.8v5.4c0 4.2 2.8 7.4 7 9.8 4.2-2.4 7-5.6 7-9.8V5.8L12 3Z" stroke-linejoin="round"/><path d="m9.3 12 1.9 1.9 3.5-3.8" stroke-linecap="round" stroke-linejoin="round"/>',
    ];
@endphp

<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" {{ $attributes->merge(['class' => 'h-6 w-6']) }} aria-hidden="true">
    {!! $icons[$name ?? ''] ?? $icons['code'] !!}
</svg>
