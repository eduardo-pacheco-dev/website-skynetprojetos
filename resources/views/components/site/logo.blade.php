@props(['href' => null, 'compact' => false])

@php($tag = $href ? 'a' : 'span')

<{{ $tag }} @if($href) href="{{ $href }}" @endif {{ $attributes->merge(['class' => 'group inline-flex items-center gap-3']) }}>
    <span class="relative flex h-10 w-10 shrink-0 items-center justify-center overflow-hidden rounded-lg border border-technical-500/50 bg-navy-800">
        <span class="absolute inset-x-0 top-0 h-px bg-technical-500/70"></span>
        <svg viewBox="0 0 24 24" fill="none" class="h-6 w-6 text-technical-400" aria-hidden="true">
            <path d="M12 21V8M8 21h8M9.5 17h5M10 13h4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
            <path d="M12 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z" stroke="currentColor" stroke-width="1.5"/>
            <path d="M7.2 6.4a6.5 6.5 0 0 0 0 6.8M16.8 6.4a6.5 6.5 0 0 1 0 6.8" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" opacity=".7"/>
        </svg>
    </span>
    @unless($compact)
        <span class="flex flex-col leading-none">
            <span class="text-[17px] font-bold tracking-[0.08em] text-white uppercase">SkyNet</span>
            <span class="mt-1.5 text-[9px] font-semibold tracking-[0.2em] text-slate-400 uppercase">Engenharia de Telecom</span>
        </span>
    @endunless
</{{ $tag }}>
