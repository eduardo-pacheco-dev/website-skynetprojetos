@props(['service', 'index' => null])

<a href="{{ route('services.show', $service) }}" {{ $attributes->merge(['class' => 'group relative flex h-full flex-col overflow-hidden rounded-xl border border-white/10 bg-navy-900/70 p-7 transition duration-300 hover:-translate-y-1 hover:border-technical-500/50 hover:bg-navy-800/80']) }}>
    <span class="absolute inset-x-0 top-0 h-0.5 origin-left scale-x-0 bg-technical-500 transition duration-300 group-hover:scale-x-100"></span>

    <div class="flex items-start justify-between gap-4">
        <div class="inline-flex h-12 w-12 items-center justify-center rounded-lg border border-technical-500/25 bg-technical-500/10 text-technical-400">
            <x-site.service-icon :name="$service->icon" />
        </div>
        @if($index)
            <span class="font-mono text-xs tracking-[0.2em] text-slate-600">{{ str_pad((string) $index, 2, '0', STR_PAD_LEFT) }}</span>
        @endif
    </div>

    <h3 class="mt-6 text-lg font-semibold text-white">{{ $service->title }}</h3>
    <p class="mt-3 flex-1 text-sm leading-6 text-slate-400">{{ $service->summary }}</p>

    <span class="mt-6 inline-flex items-center gap-2 text-sm font-semibold text-technical-400">
        Ver escopo técnico
        <svg viewBox="0 0 20 20" fill="none" class="h-4 w-4 transition group-hover:translate-x-1" aria-hidden="true">
            <path d="M4 10h12m-4-4 4 4-4 4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </span>
</a>
