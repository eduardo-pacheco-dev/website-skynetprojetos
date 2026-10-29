@props(['project'])

<a href="{{ route('projects.show', $project) }}" {{ $attributes->merge(['class' => 'group flex h-full flex-col overflow-hidden rounded-2xl border border-white/10 bg-white/[0.03] transition duration-300 hover:-translate-y-1 hover:border-violet-400/40']) }}>
    <div class="relative h-48 overflow-hidden">
        @if($project->cover_image_url)
            <img src="{{ $project->cover_image_url }}" alt="Capa do projeto {{ $project->title }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105" loading="lazy">
        @else
            <div class="flex h-full w-full items-center justify-center bg-gradient-to-br from-cyan-500/20 via-sky-500/10 to-violet-500/20">
                <span class="text-4xl font-black tracking-tight text-white/20">{{ Str::upper(Str::substr($project->title, 0, 2)) }}</span>
            </div>
        @endif
        <div class="absolute inset-0 bg-gradient-to-t from-[#04070f] via-transparent to-transparent"></div>
        @if($project->is_featured)
            <span class="absolute top-4 left-4 rounded-full border border-amber-400/30 bg-amber-400/10 px-2.5 py-1 text-[10px] font-semibold tracking-wider text-amber-300 uppercase">
                Destaque
            </span>
        @endif
    </div>
    <div class="flex flex-1 flex-col p-6">
        @if($project->client)
            <p class="text-xs font-medium tracking-wide text-cyan-300/80 uppercase">{{ $project->client }}</p>
        @endif
        <h3 class="mt-2 text-lg font-semibold text-white">{{ $project->title }}</h3>
        <p class="mt-2 flex-1 text-sm leading-6 text-slate-400">{{ $project->summary }}</p>
        @if(filled($project->technologies))
            <div class="mt-4 flex flex-wrap gap-1.5">
                @foreach($project->technologies as $technology)
                    <span class="rounded-md border border-white/10 bg-white/5 px-2 py-1 text-[11px] text-slate-300">{{ $technology }}</span>
                @endforeach
            </div>
        @endif
        <span class="mt-5 inline-flex items-center gap-2 text-sm font-medium text-cyan-300">
            Ver projeto
            <svg viewBox="0 0 20 20" fill="none" class="h-4 w-4 transition group-hover:translate-x-1" aria-hidden="true">
                <path d="M4 10h12m-4-4 4 4-4 4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </span>
    </div>
</a>
