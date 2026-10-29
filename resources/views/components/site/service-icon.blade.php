@props(['name' => null])

@php
    $icons = [
        'survey' => '<path d="M4 6.5 12 3l8 3.5v7.8c0 3.4-3 5.7-8 6.7-5-1-8-3.3-8-6.7V6.5Z" stroke-linejoin="round"/><path d="m8.2 11.6 2.4 2.4 5.1-5.2" stroke-linecap="round" stroke-linejoin="round"/>',
        'tower' => '<path d="M12 21V8M8 21h8M9.5 17h5M10 13h4" stroke-linecap="round"/><circle cx="12" cy="5.5" r="2.3"/><path d="M7.2 4a6.5 6.5 0 0 0 0 6.8M16.8 4a6.5 6.5 0 0 1 0 6.8" stroke-linecap="round" opacity=".7"/>',
        'swap' => '<path d="M4 8h13m0 0-3.2-3.2M17 8l-3.2 3.2M20 16H7m0 0 3.2-3.2M7 16l3.2 3.2" stroke-linecap="round" stroke-linejoin="round"/>',
        'audit' => '<path d="M9 4.5h6a1.5 1.5 0 0 1 1.5 1.5v13a1.5 1.5 0 0 1-1.5 1.5H9A1.5 1.5 0 0 1 7.5 19V6A1.5 1.5 0 0 1 9 4.5Z" stroke-linejoin="round"/><path d="m9.6 11.2 1.7 1.7 3.2-3.6M10 5V3h4v2" stroke-linecap="round" stroke-linejoin="round"/>',
        'maintenance' => '<path d="M14.8 6.2a4.2 4.2 0 0 0-5.6 5.3L4 16.7 7.3 20l5.2-5.2a4.2 4.2 0 0 0 5.3-5.6l-2.7 2.7-2.5-2.5 2.2-3.2Z" stroke-linejoin="round"/>',
        'docs' => '<path d="M7 3.5h7l3 3V20a.5.5 0 0 1-.5.5h-9A.5.5 0 0 1 7 20V3.5Z" stroke-linejoin="round"/><path d="M14 3.5V7h3M9.8 11h4.4M9.8 14.5h4.4" stroke-linecap="round"/>',
        'code' => '<path d="m8 9-4 3 4 3M16 9l4 3-4 3M13.5 5l-3 14" stroke-linecap="round" stroke-linejoin="round"/>',
        'automation' => '<path d="M12 3v3m0 12v3M3 12h3m12 0h3M5.6 5.6l2.1 2.1m8.6 8.6 2.1 2.1m0-12.8-2.1 2.1m-8.6 8.6-2.1 2.1" stroke-linecap="round"/><circle cx="12" cy="12" r="3.5"/>',
        'cloud' => '<path d="M7 18a4 4 0 0 1-.4-7.98A5.5 5.5 0 0 1 17.3 8.5 3.75 3.75 0 0 1 17 18H7Z" stroke-linejoin="round"/>',
        'mobile' => '<rect x="7" y="2.75" width="10" height="18.5" rx="2.25"/><path d="M10.5 18.25h3" stroke-linecap="round"/>',
        'chart' => '<path d="M4 19.5V13m5.3 6.5V8.8M14.7 19.5v-8.7M20 19.5V5" stroke-linecap="round"/>',
        'shield' => '<path d="M12 3 5 5.8v5.4c0 4.2 2.8 7.4 7 9.8 4.2-2.4 7-5.6 7-9.8V5.8L12 3Z" stroke-linejoin="round"/><path d="m9.3 12 1.9 1.9 3.5-3.8" stroke-linecap="round" stroke-linejoin="round"/>',
    ];
@endphp

<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" {{ $attributes->merge(['class' => 'h-6 w-6']) }} aria-hidden="true">
    {!! $icons[$name ?? ''] ?? $icons['tower'] !!}
</svg>
