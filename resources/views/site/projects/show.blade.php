@php($settings = $siteSettings ?? [])

<x-layouts.site :title="$project->title" :description="$project->summary">
    <section class="relative overflow-hidden border-b border-white/5">
        <div class="absolute inset-0 bg-grid opacity-50 [mask-image:radial-gradient(ellipse_at_top,black,transparent_75%)]"></div>
        <div class="pointer-events-none absolute -top-32 left-1/4 h-80 w-80 rounded-full bg-technical-500/10 blur-3xl"></div>
        <div class="relative mx-auto max-w-7xl px-6 py-16 lg:px-8 lg:py-20">
            <nav class="flex items-center gap-2 text-xs text-slate-500" aria-label="Trilha de navegação">
                <a href="{{ route('home') }}" class="transition hover:text-technical-400">Início</a>
                <span>/</span>
                <a href="{{ route('projects.index') }}" class="transition hover:text-technical-400">Portfólio</a>
                <span>/</span>
                <span class="text-slate-300">{{ $project->title }}</span>
            </nav>

            <div class="mt-8 max-w-3xl">
                <div class="flex flex-wrap items-center gap-3 text-xs text-slate-500">
                    @if($project->client)
                        <span class="rounded-sm border border-technical-500/25 bg-technical-500/5 px-3 py-1 font-medium text-technical-400">{{ $project->client }}</span>
                    @endif
                    @if($project->completed_at)
                        <span>Concluído em {{ $project->completed_at->format('m/Y') }}</span>
                    @endif
                    <span class="flex items-center gap-1.5 text-compliance-400">
                        <span class="h-1.5 w-1.5 rounded-full bg-compliance-500"></span>
                        Conformidade validada
                    </span>
                </div>

                <p class="technical-label mt-6">Caso de atuação</p>
                <h1 class="mt-3 text-4xl font-bold tracking-tight text-white sm:text-5xl">{{ $project->title }}</h1>
                <p class="mt-5 text-lg leading-8 text-slate-400">{{ $project->summary }}</p>
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-6 py-16 lg:px-8">
        <div class="overflow-hidden rounded-xl border border-white/10 bg-navy-900">
            @if($project->cover_image_url)
                <img src="{{ $project->cover_image_url }}" alt="Capa do projeto {{ $project->title }}" class="max-h-[560px] w-full object-cover">
            @else
                <div class="relative flex h-64 items-center justify-center overflow-hidden bg-blueprint bg-navy-800 sm:h-80">
                    <div class="absolute inset-0 bg-gradient-to-br from-navy-800 via-transparent to-technical-500/10"></div>
                    <svg viewBox="0 0 700 260" class="absolute inset-0 h-full w-full" fill="none" aria-hidden="true">
                        <path d="M0 210 140 100l110 62 130-110 130 84 190-58" stroke="rgba(249,115,22,0.3)" stroke-width="1.5"/>
                        <path d="M0 230 150 128l100 52 150-92 120 74 180-44" stroke="rgba(148,163,184,0.16)" stroke-width="1"/>
                        <circle cx="380" cy="52" r="5" fill="#f97316"/>
                        <circle cx="380" cy="52" r="18" stroke="rgba(249,115,22,0.4)"/>
                        <circle cx="380" cy="52" r="34" stroke="rgba(249,115,22,0.18)"/>
                    </svg>
                    <span class="relative font-mono text-[11px] tracking-[0.24em] text-technical-400 uppercase">Infraestrutura de telecom</span>
                </div>
            @endif
        </div>

        <div class="mt-12 grid gap-12 lg:grid-cols-[1fr_320px]">
            <article>
                <h2 class="text-2xl font-bold text-white">Contexto e execução</h2>
                <div class="mt-5 space-y-5 text-base leading-8 text-slate-400">
                    @if($project->description)
                        <p>{!! nl2br(e($project->description)) !!}</p>
                    @else
                        <p>{{ $project->summary }}</p>
                    @endif
                </div>

                <div class="mt-8 grid gap-4 sm:grid-cols-2">
                    <div class="rounded-xl border border-white/10 bg-navy-900/60 p-5">
                        <h3 class="text-xs font-semibold tracking-[0.16em] text-white uppercase">Escopo executado</h3>
                        <ul class="mt-4 space-y-2.5 text-sm text-slate-400">
                            @foreach(['Planejamento e mobilização', 'Execução conforme procedimento', 'Validação técnica e evidências', 'Entrega de relatório e as-built'] as $item)
                                <li class="flex items-start gap-2.5">
                                    <span class="mt-2 h-1 w-1 shrink-0 rounded-full bg-technical-500"></span>
                                    {{ $item }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="rounded-xl border border-compliance-500/20 bg-compliance-500/5 p-5">
                        <h3 class="text-xs font-semibold tracking-[0.16em] text-compliance-400 uppercase">Compromissos</h3>
                        <ul class="mt-4 space-y-2.5 text-sm text-slate-400">
                            @foreach(['Zero incidente de segurança', 'Aderência a EHS e FAM', 'Rastreabilidade completa', 'Comunicação e reporte contínuos'] as $item)
                                <li class="flex items-start gap-2.5">
                                    <svg viewBox="0 0 20 20" fill="none" class="mt-1 h-3.5 w-3.5 shrink-0 text-compliance-500" aria-hidden="true">
                                        <path d="m4 10.5 4 4 8-9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    {{ $item }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                @if(filled($project->project_url))
                    <a href="{{ $project->project_url }}" target="_blank" rel="noopener noreferrer" class="mt-8 inline-flex items-center gap-2 rounded-lg border border-technical-500/30 bg-technical-500/10 px-5 py-3 text-sm font-semibold text-technical-400 transition hover:bg-technical-500/20">
                        Visitar referência
                        <svg viewBox="0 0 20 20" fill="none" class="h-4 w-4" aria-hidden="true">
                            <path d="M7 5h8v8M15 5 5 15" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                @endif
            </article>

            <aside class="space-y-5">
                @if(filled($project->technologies))
                    <div class="rounded-xl border border-white/10 bg-navy-900/60 p-6">
                        <h2 class="text-xs font-semibold tracking-[0.16em] text-white uppercase">Tecnologias e disciplinas</h2>
                        <div class="mt-4 flex flex-wrap gap-2">
                            @foreach($project->technologies as $technology)
                                <span class="rounded-sm border border-white/10 bg-white/5 px-2.5 py-1.5 text-[11px] tracking-wide text-slate-300 uppercase">{{ $technology }}</span>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="rounded-xl border border-technical-500/25 bg-navy-900 p-6">
                    <h2 class="text-lg font-semibold text-white">Precisa de execução semelhante?</h2>
                    <p class="mt-3 text-sm leading-6 text-slate-400">Vamos avaliar seu escopo e estruturar o plano de campo.</p>
                    <a href="{{ route('contact.create') }}" class="mt-5 inline-flex w-full items-center justify-center rounded-lg bg-technical-500 px-5 py-3 text-sm font-bold text-navy-950 transition hover:bg-technical-400">
                        Falar com especialista
                    </a>
                </div>
            </aside>
        </div>
    </section>

    @if($relatedProjects->isNotEmpty())
        <section class="border-t border-white/5 bg-steel-800/30">
            <div class="mx-auto max-w-7xl px-6 py-20 lg:px-8">
                <x-site.section-heading eyebrow="Continue explorando" title="Outros casos de atuação" />
                <div class="mt-10 grid gap-5 md:grid-cols-2 lg:grid-cols-3">
                    @foreach($relatedProjects as $relatedProject)
                        <x-site.project-card :project="$relatedProject" class="reveal" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <x-site.cta />
</x-layouts.site>
