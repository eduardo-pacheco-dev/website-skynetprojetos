@php($settings = $siteSettings ?? [])

<x-layouts.site :title="$project->title" :description="$project->summary">
    <section class="relative overflow-hidden border-b border-white/5">
        <div class="absolute inset-0 bg-grid opacity-30 [mask-image:radial-gradient(ellipse_at_top,black,transparent_70%)]"></div>
        <div class="pointer-events-none absolute -top-32 left-1/4 h-80 w-80 rounded-full bg-violet-500/15 blur-3xl"></div>
        <div class="relative mx-auto max-w-7xl px-6 py-16 lg:px-8 lg:py-20">
            <nav class="flex items-center gap-2 text-xs text-slate-500" aria-label="Trilha de navegação">
                <a href="{{ route('home') }}" class="transition hover:text-cyan-300">Início</a>
                <span>/</span>
                <a href="{{ route('projects.index') }}" class="transition hover:text-cyan-300">Projetos</a>
                <span>/</span>
                <span class="text-slate-300">{{ $project->title }}</span>
            </nav>

            <div class="mt-8 max-w-3xl">
                <div class="flex flex-wrap items-center gap-3 text-xs text-slate-500">
                    @if($project->client)
                        <span class="rounded-full border border-cyan-400/20 bg-cyan-400/5 px-3 py-1 font-medium text-cyan-300">{{ $project->client }}</span>
                    @endif
                    @if($project->completed_at)
                        <span>Concluído em {{ $project->completed_at->format('m/Y') }}</span>
                    @endif
                </div>
                <h1 class="mt-5 text-4xl font-bold tracking-tight text-white sm:text-5xl">{{ $project->title }}</h1>
                <p class="mt-5 text-lg leading-8 text-slate-400">{{ $project->summary }}</p>
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-6 py-16 lg:px-8">
        <div class="overflow-hidden rounded-3xl border border-white/10 bg-white/[0.02]">
            @if($project->cover_image_url)
                <img src="{{ $project->cover_image_url }}" alt="Capa do projeto {{ $project->title }}" class="max-h-[560px] w-full object-cover">
            @else
                <div class="flex h-72 w-full items-center justify-center bg-gradient-to-br from-cyan-500/20 via-sky-500/10 to-violet-500/20 sm:h-96">
                    <span class="text-7xl font-black tracking-tight text-white/15">{{ Str::upper(Str::substr($project->title, 0, 2)) }}</span>
                </div>
            @endif
        </div>

        <div class="mt-12 grid gap-12 lg:grid-cols-[1fr_320px]">
            <article>
                <h2 class="text-2xl font-bold text-white">Sobre o projeto</h2>
                <div class="mt-5 space-y-5 text-base leading-8 text-slate-400">
                    @if($project->description)
                        <p>{!! nl2br(e($project->description)) !!}</p>
                    @else
                        <p>{{ $project->summary }}</p>
                    @endif
                </div>

                @if(filled($project->project_url))
                    <a href="{{ $project->project_url }}" target="_blank" rel="noopener noreferrer" class="mt-8 inline-flex items-center gap-2 rounded-xl border border-cyan-400/30 bg-cyan-400/10 px-5 py-3 text-sm font-semibold text-cyan-300 transition hover:bg-cyan-400/20">
                        Visitar projeto
                        <svg viewBox="0 0 20 20" fill="none" class="h-4 w-4" aria-hidden="true">
                            <path d="M7 5h8v8M15 5 5 15" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                @endif
            </article>

            <aside class="space-y-6">
                @if(filled($project->technologies))
                    <div class="rounded-2xl border border-white/10 bg-white/[0.02] p-6">
                        <h2 class="text-sm font-semibold tracking-wide text-white uppercase">Tecnologias</h2>
                        <div class="mt-4 flex flex-wrap gap-2">
                            @foreach($project->technologies as $technology)
                                <span class="rounded-lg border border-white/10 bg-white/5 px-2.5 py-1.5 text-xs text-slate-300">{{ $technology }}</span>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="rounded-2xl border border-cyan-400/20 bg-gradient-to-br from-cyan-500/10 to-violet-500/5 p-6">
                    <h2 class="text-lg font-semibold text-white">Tem um desafio parecido?</h2>
                    <p class="mt-3 text-sm leading-6 text-slate-300">Vamos conversar sobre como aplicar essa experiência no seu contexto.</p>
                    <a href="{{ route('contact.create') }}" class="mt-5 inline-flex w-full items-center justify-center rounded-xl bg-gradient-to-r from-cyan-400 to-sky-500 px-5 py-3 text-sm font-semibold text-slate-950 transition hover:brightness-110">
                        Falar com especialista
                    </a>
                </div>
            </aside>
        </div>
    </section>

    @if($relatedProjects->isNotEmpty())
        <section class="border-t border-white/5 bg-white/[0.015]">
            <div class="mx-auto max-w-7xl px-6 py-20 lg:px-8">
                <x-site.section-heading eyebrow="Continue explorando" title="Outros projetos" />
                <div class="mt-10 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @foreach($relatedProjects as $relatedProject)
                        <x-site.project-card :project="$relatedProject" class="reveal" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <x-site.cta />
</x-layouts.site>
