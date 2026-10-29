@props(['href' => null, 'compact' => false])

@php($tag = $href ? 'a' : 'span')

<{{ $tag }} @if($href) href="{{ $href }}" @endif {{ $attributes->merge(['class' => 'group inline-flex items-center gap-2.5']) }}>
    <span class="relative flex h-9 w-9 items-center justify-center rounded-xl bg-gradient-to-br from-cyan-400 to-violet-500 shadow-lg shadow-cyan-500/20">
        <svg viewBox="0 0 24 24" fill="none" class="h-5 w-5 text-slate-950" aria-hidden="true">
            <path d="M12 2.75 20 7.4v9.2L12 21.25 4 16.6V7.4L12 2.75Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/>
            <circle cx="12" cy="12" r="2.6" fill="currentColor"/>
            <path d="M12 9.4V5.2M14.3 10.7l3.6-2M14.3 13.3l3.6 2M12 14.6v4.2M9.7 13.3l-3.6 2M9.7 10.7l-3.6-2" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>
        </svg>
    </span>
    @unless($compact)
        <span class="flex flex-col leading-none">
            <span class="text-base font-bold tracking-tight text-white">SkyNet</span>
            <span class="mt-1 text-[10px] font-semibold tracking-[0.32em] text-cyan-300/80 uppercase">Projetos</span>
        </span>
    @endunless
</{{ $tag }}>
