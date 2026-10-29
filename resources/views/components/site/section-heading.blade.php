@props(['eyebrow' => null, 'title', 'description' => null, 'align' => 'left'])

<div class="{{ $align === 'center' ? 'mx-auto max-w-2xl text-center' : 'max-w-2xl' }}">
    @if($eyebrow)
        <p class="mb-4 flex items-center gap-3 text-xs font-medium tracking-widest text-stone-900/60 uppercase {{ $align === 'center' ? 'justify-center' : '' }}">
            <span class="block h-px w-6 bg-accent"></span>
            {{ $eyebrow }}
        </p>
    @endif
    <h2 class="text-3xl leading-snug font-light tracking-tight text-balance text-stone-900 md:text-4xl">{{ $title }}</h2>
    @if($description)
        <p class="mt-5 max-w-[60ch] text-base leading-relaxed text-pretty text-stone-900/60">{{ $description }}</p>
    @endif
</div>
