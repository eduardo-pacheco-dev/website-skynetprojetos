@props(['eyebrow' => null, 'title', 'description' => null, 'align' => 'left'])

<div class="{{ $align === 'center' ? 'mx-auto max-w-3xl text-center' : 'max-w-3xl' }}">
    @if($eyebrow)
        <p class="mb-3 inline-flex items-center gap-2 text-xs font-semibold tracking-[0.2em] text-cyan-300 uppercase">
            <span class="h-1.5 w-1.5 rounded-full bg-cyan-400"></span>
            {{ $eyebrow }}
        </p>
    @endif
    <h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl">{{ $title }}</h2>
    @if($description)
        <p class="mt-4 text-base leading-7 text-slate-400">{{ $description }}</p>
    @endif
</div>
