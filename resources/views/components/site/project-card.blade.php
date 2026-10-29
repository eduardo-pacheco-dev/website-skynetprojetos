@props(['project'])

<a href="{{ route('projects.show', $project) }}" {{ $attributes->merge(['class' => 'group flex h-full flex-col overflow-hidden rounded-xl border border-white/10 bg-navy-900/70 transition duration-300 hover:-translate-y-1 hover:border-technical-500/40 hover:bg-navy-800/80']) }}>
    <div class="relative h-44 overflow-hidden border-b border-white/10 bg-navy-800">
        @if($project->cover_image_url)
            <img src="{{ $project->cover_image_url }}" alt="Capa do projeto {{ $project->title }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105" loading="lazy">
        @else
            <div class="absolute inset-0 bg-blueprint opacity-40"></div>
            <div class="absolute inset-0 bg-gradient-to-br from-navy-700/40 via-transparent to-technical-500/10"></div>
            <svg viewBox="0 0 600 200" class="absolute inset-0 h-full w-full" fill="none" aria-hidden="true">
                <path d="M0 160 120 80l90 48 110-88 120 70 160-42" stroke="rgba(249,115,22,0.28)" stroke-width="1.5"/>
                <path d="M0 175 130 105l85 42 125-68 110 64 150-38" stroke="rgba(148,163,184,0.16)" stroke-width="1"/>
                <circle cx="330" cy="40" r="4" fill="#f97316"/>
                <circle cx="330" cy="40" r="14" stroke="rgba(249,115,22,0.4)"/>
                <circle cx="330" cy="40" r="26" stroke="rgba(249,115,22,0.18)"/>
            </svg>
            <span class="absolute bottom-4 left-5 font-mono text-[10px] tracking-[0.22em] text-technical-400/80 uppercase">Caso técnico</span>
        @endif
        <div class="absolute inset-0 bg-gradient-to-t from-navy-950/80 via-transparent to-transparent"></div>
        @if($project->is_featured)
            <span class="absolute top-4 left-4 rounded-sm border border-technical-500/30 bg-navy-950/80 px-2 py-1 text-[10px] font-semibold tracking-wider text-technical-400 uppercase">
                Destaque
            </span>
        @endif
    </div>

    <div class="flex flex-1 flex-col p-6">
        @if($project->client)
            <p class="text-[11px] font-semibold tracking-[0.16em] text-slate-500 uppercase">{{ $project->client }}</p>
        @endif
        <h3 class="mt-2 text-lg font-semibold text-white">{{ $project->title }}</h3>
        <p class="mt-2 flex-1 text-sm leading-6 text-slate-400">{{ $project->summary }}</p>

        @if(filled($project->technologies))
            <div class="mt-4 flex flex-wrap gap-1.5">
                @foreach(array_slice($project->technologies, 0, 3) as $technology)
                    <span class="rounded-sm border border-white/10 bg-white/5 px-2 py-1 text-[10px] tracking-wide text-slate-400 uppercase">{{ $technology }}</span>
                @endforeach
            </div>
        @endif

        <span class="mt-5 inline-flex items-center gap-2 text-sm font-semibold text-technical-400">
            Detalhes do projeto
            <svg viewBox="0 0 20 20" fill="none" class="h-4 w-4 transition group-hover:translate-x-1" aria-hidden="true">
                <path d="M4 10h12m-4-4 4 4-4 4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </span>
    </div>
</a>
