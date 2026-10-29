@props(['service'])

<a href="{{ route('services.show', $service) }}" {{ $attributes->merge(['class' => 'group relative flex h-full flex-col overflow-hidden rounded-2xl border border-white/10 bg-white/[0.03] p-6 transition duration-300 hover:-translate-y-1 hover:border-cyan-400/40 hover:bg-white/[0.05]']) }}>
    <div class="absolute -top-16 -right-16 h-32 w-32 rounded-full bg-cyan-400/10 blur-2xl transition group-hover:bg-cyan-400/20"></div>
    <div class="relative mb-5 inline-flex h-12 w-12 items-center justify-center rounded-xl border border-cyan-400/20 bg-cyan-400/10 text-cyan-300">
        <x-site.service-icon :name="$service->icon" />
    </div>
    <h3 class="relative text-lg font-semibold text-white">{{ $service->title }}</h3>
    <p class="relative mt-3 flex-1 text-sm leading-6 text-slate-400">{{ $service->summary }}</p>
    <span class="relative mt-5 inline-flex items-center gap-2 text-sm font-medium text-cyan-300">
        Saiba mais
        <svg viewBox="0 0 20 20" fill="none" class="h-4 w-4 transition group-hover:translate-x-1" aria-hidden="true">
            <path d="M4 10h12m-4-4 4 4-4 4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </span>
</a>
