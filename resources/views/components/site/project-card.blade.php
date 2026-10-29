@props(['project'])

<a href="{{ route('projects.show', $project) }}" {{ $attributes->merge(['class' => 'group flex h-full flex-col border border-stone-200 bg-stone-100 transition-colors duration-200 hover:border-stone-900']) }}>
    <div class="relative h-44 overflow-hidden border-b border-stone-200 bg-stone-200">
        @if($project->cover_image_url)
            <img src="{{ $project->cover_image_url }}" alt="Capa do projeto {{ $project->title }}" class="h-full w-full object-cover" loading="lazy">
        @else
            <div class="absolute inset-0 swiss-grid opacity-60"></div>
            <svg viewBox="0 0 600 200" class="absolute inset-0 h-full w-full" fill="none" aria-hidden="true">
                <path d="M0 160 120 80l90 48 110-88 120 70 160-42" stroke="rgba(28,25,23,0.25)" stroke-width="1.2"/>
                <path d="M0 175 130 105l85 42 125-68 110 64 150-38" stroke="rgba(28,25,23,0.12)" stroke-width="1"/>
                <circle cx="330" cy="40" r="3.5" fill="#c8102e"/>
                <circle cx="330" cy="40" r="13" stroke="rgba(200,16,46,0.35)"/>
                <circle cx="330" cy="40" r="24" stroke="rgba(200,16,46,0.15)"/>
            </svg>
            <span class="absolute bottom-4 left-5 font-mono text-[10px] tracking-widest text-stone-900/60 uppercase">Caso técnico</span>
        @endif
        @if($project->is_featured)
            <span class="absolute top-4 left-4 border border-accent/30 bg-accent/10 px-2 py-1 text-[10px] font-medium tracking-widest text-accent uppercase">
                Destaque
            </span>
        @endif
    </div>

    <div class="flex flex-1 flex-col p-6">
        @if($project->client)
            <p class="text-[11px] font-medium tracking-widest text-stone-900/60 uppercase">{{ $project->client }}</p>
        @endif
        <h3 class="mt-2 text-lg leading-snug font-normal text-stone-900">{{ $project->title }}</h3>
        <p class="mt-2 max-w-[48ch] flex-1 text-sm leading-relaxed text-stone-900/60">{{ $project->summary }}</p>

        @if(filled($project->technologies))
            <div class="mt-4 flex flex-wrap gap-1.5">
                @foreach(array_slice($project->technologies, 0, 3) as $technology)
                    <span class="border border-stone-300 px-2 py-1 text-[10px] tracking-widest text-stone-900/60 uppercase">{{ $technology }}</span>
                @endforeach
            </div>
        @endif

        <span class="mt-6 inline-flex min-h-[44px] items-center gap-2 text-sm font-medium text-stone-900 transition-colors group-hover:text-accent">
            Detalhes do projeto
            <svg viewBox="0 0 20 20" fill="none" class="h-4 w-4 transition-transform duration-200 group-hover:translate-x-1" aria-hidden="true">
                <path d="M4 10h12m-4-4 4 4-4 4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </span>
    </div>
</a>
