@props(['service', 'index' => null])

<a href="{{ route('services.show', $service) }}" {{ $attributes->merge(['class' => 'group flex h-full flex-col border border-stone-200 border-t-2 border-t-stone-900 bg-stone-100 p-8 transition-colors duration-200 hover:border-t-accent hover:bg-stone-50']) }}>
    <div class="flex items-start justify-between gap-4">
        <div class="flex h-10 w-10 items-center justify-center border border-stone-300 text-stone-900">
            <x-site.service-icon :name="$service->icon" class="h-5 w-5" />
        </div>
        @if($index)
            <span class="font-mono text-xs tracking-widest text-stone-900/60 tabular-nums">{{ str_pad((string) $index, 2, '0', STR_PAD_LEFT) }}</span>
        @endif
    </div>

    <h3 class="mt-10 text-xl leading-snug font-normal text-stone-900">{{ $service->title }}</h3>
    <p class="mt-3 max-w-[48ch] flex-1 text-sm leading-relaxed text-stone-900/60">{{ $service->summary }}</p>

    <span class="mt-8 inline-flex min-h-[44px] items-center gap-2 text-sm font-medium text-stone-900 transition-colors group-hover:text-accent">
        Ver escopo técnico
        <svg viewBox="0 0 20 20" fill="none" class="h-4 w-4 transition-transform duration-200 group-hover:translate-x-1" aria-hidden="true">
            <path d="M4 10h12m-4-4 4 4-4 4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </span>
</a>
