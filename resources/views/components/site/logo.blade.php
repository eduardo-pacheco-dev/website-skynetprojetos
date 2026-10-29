@props(['href' => null, 'compact' => false])

@php($tag = $href ? 'a' : 'span')

<{{ $tag }} @if($href) href="{{ $href }}" @endif {{ $attributes->merge(['class' => 'group inline-flex min-h-[44px] items-center gap-3']) }}>
    <span class="flex h-10 w-10 shrink-0 items-center justify-center bg-accent">
        <svg viewBox="0 0 24 24" fill="none" class="h-6 w-6 text-white" aria-hidden="true">
            <path d="M12 21V8M8 21h8M9.5 17h5M10 13h4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>
            <circle cx="12" cy="5.5" r="2.2" stroke="currentColor" stroke-width="1.6"/>
            <path d="M7.2 4a6.5 6.5 0 0 0 0 6.8M16.8 4a6.5 6.5 0 0 1 0 6.8" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" opacity=".8"/>
        </svg>
    </span>
    @unless($compact)
        <span class="flex flex-col leading-none">
            <span class="text-[13px] font-medium tracking-[0.14em] text-stone-900 uppercase">SkyNet</span>
            <span class="mt-1.5 text-[9px] font-normal tracking-[0.2em] text-stone-900/60 uppercase">Engenharia de Telecom</span>
        </span>
    @endunless
</{{ $tag }}>
