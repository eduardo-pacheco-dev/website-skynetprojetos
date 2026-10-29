@php($settings = $siteSettings ?? [])

<x-layouts.site :title="$project->title" :description="$project->summary">
    <section class="border-b border-stone-200">
        <div class="mx-auto max-w-6xl px-4 py-16 md:px-8 md:py-24">
            <nav class="flex flex-wrap items-center gap-2 text-xs tracking-wide text-stone-900/60" aria-label="Trilha de navegação">
                <a href="{{ route('home') }}" class="transition-colors hover:text-stone-900">Início</a>
                <span aria-hidden="true">/</span>
                <a href="{{ route('projects.index') }}" class="transition-colors hover:text-stone-900">Portfólio</a>
                <span aria-hidden="true">/</span>
                <span class="text-stone-900/60">{{ $project->title }}</span>
            </nav>

            <div class="mt-10 max-w-3xl">
                <div class="flex flex-wrap items-center gap-3 text-xs text-stone-900/60">
                    @if($project->client)
                        <span class="border border-accent/30 bg-accent/10 px-3 py-1 font-medium tracking-wide text-accent uppercase">{{ $project->client }}</span>
                    @endif
                    @if($project->completed_at)
                        <span>Concluído em {{ $project->completed_at->format('m/Y') }}</span>
                    @endif
                    <span class="flex items-center gap-1.5">
                        <span class="h-1 w-1 bg-accent"></span>
                        Conformidade validada
                    </span>
                </div>

                <p class="mt-8 text-xs font-medium tracking-widest text-stone-900/60 uppercase">Caso de atuação</p>
                <h1 class="mt-3 text-4xl leading-tight font-light tracking-tight text-balance text-stone-900 md:text-5xl">{{ $project->title }}</h1>
                <p class="mt-5 max-w-[60ch] text-base leading-relaxed text-stone-900/60 md:text-lg">{{ $project->summary }}</p>
            </div>
        </div>
    </section>

    <section class="border-b border-stone-200">
        <div class="mx-auto max-w-6xl px-4 py-16 md:px-8 md:py-24">
            <figure class="border border-stone-200 bg-stone-100">
                @if($project->cover_image_url)
                    <img src="{{ $project->cover_image_url }}" alt="Capa do projeto {{ $project->title }}" class="max-h-[560px] w-full object-cover">
                @else
                    <div class="relative flex h-64 items-center justify-center overflow-hidden sm:h-80">
                        <div class="absolute inset-0 swiss-grid opacity-70"></div>
                        <svg viewBox="0 0 700 260" class="absolute inset-0 h-full w-full" fill="none" aria-hidden="true">
                            <path d="M0 210 140 100l110 62 130-110 130 84 190-58" stroke="rgba(28,25,23,0.28)" stroke-width="1.2"/>
                            <path d="M0 230 150 128l100 52 150-92 120 74 180-44" stroke="rgba(28,25,23,0.12)" stroke-width="1"/>
                            <circle cx="380" cy="52" r="4" fill="#c8102e"/>
                            <circle cx="380" cy="52" r="16" stroke="rgba(200,16,46,0.35)"/>
                            <circle cx="380" cy="52" r="30" stroke="rgba(200,16,46,0.15)"/>
                        </svg>
                        <span class="relative font-mono text-[11px] tracking-widest text-stone-900/60 uppercase">Infraestrutura de telecom</span>
                    </div>
                @endif
                <figcaption class="flex items-center justify-between border-t border-stone-200 px-4 py-3 text-[10px] tracking-widest text-stone-900/60 uppercase">
                    <span>Fig. 02 — Registro de execução</span>
                    <span>{{ $project->client ?? 'SkyNet Projetos' }}</span>
                </figcaption>
            </figure>

            <div class="mt-12 grid grid-cols-12 gap-8">
                <article class="col-span-12 lg:col-span-8">
                    <h2 class="text-2xl leading-snug font-light tracking-tight text-stone-900">Contexto e execução</h2>
                    <div class="mt-5 max-w-[60ch] space-y-5 text-base leading-relaxed text-pretty text-stone-900/60">
                        @if($project->description)
                            <p>{!! nl2br(e($project->description)) !!}</p>
                        @else
                            <p>{{ $project->summary }}</p>
                        @endif
                    </div>

                    <div class="mt-10 grid grid-cols-1 gap-px border border-stone-200 bg-stone-200 sm:grid-cols-2">
                        <div class="bg-stone-50 p-6">
                            <h3 class="text-xs font-medium tracking-widest text-stone-900/60 uppercase">Escopo executado</h3>
                            <ul class="mt-4 space-y-2.5 text-sm leading-relaxed text-stone-900/60">
                                @foreach(['Planejamento e mobilização', 'Execução conforme procedimento', 'Validação técnica e evidências', 'Entrega de relatório e as-built'] as $item)
                                    <li class="flex items-start gap-2.5">
                                        <span class="mt-2 h-1 w-1 shrink-0 bg-accent"></span>
                                        {{ $item }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="bg-stone-50 p-6">
                            <h3 class="text-xs font-medium tracking-widest text-stone-900/60 uppercase">Compromissos</h3>
                            <ul class="mt-4 space-y-2.5 text-sm leading-relaxed text-stone-900/60">
                                @foreach(['Zero incidente de segurança', 'Aderência a EHS e FAM', 'Rastreabilidade completa', 'Comunicação e reporte contínuos'] as $item)
                                    <li class="flex items-start gap-2.5">
                                        <span class="mt-2 h-1 w-1 shrink-0 bg-accent"></span>
                                        {{ $item }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    @if(filled($project->project_url))
                        <a href="{{ $project->project_url }}" target="_blank" rel="noopener noreferrer" class="mt-8 inline-flex min-h-[44px] items-center gap-2 border border-stone-300 px-5 py-3 text-sm font-medium tracking-wide text-stone-900 transition-colors hover:border-stone-900">
                            Visitar referência
                            <svg viewBox="0 0 20 20" fill="none" class="h-4 w-4" aria-hidden="true">
                                <path d="M7 5h8v8M15 5 5 15" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    @endif
                </article>

                <aside class="col-span-12 space-y-4 lg:col-span-4">
                    @if(filled($project->technologies))
                        <div class="border border-stone-200 bg-stone-50 p-6">
                            <h2 class="text-xs font-medium tracking-widest text-stone-900/60 uppercase">Tecnologias e disciplinas</h2>
                            <div class="mt-4 flex flex-wrap gap-2">
                                @foreach($project->technologies as $technology)
                                    <span class="border border-stone-300 px-2.5 py-1.5 text-[11px] tracking-widest text-stone-900/60 uppercase">{{ $technology }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="border border-stone-200 border-t-2 border-t-accent bg-stone-100 p-6">
                        <h2 class="text-lg font-normal text-stone-900">Precisa de execução semelhante?</h2>
                        <p class="mt-3 text-sm leading-relaxed text-stone-900/60">Vamos avaliar seu escopo e estruturar o plano de campo.</p>
                        <a href="{{ route('contact.create') }}" class="mt-5 inline-flex min-h-[44px] w-full items-center justify-center bg-accent px-5 py-3 text-sm font-medium tracking-wide text-white transition-colors hover:bg-accent/90">
                            Falar com especialista
                        </a>
                    </div>
                </aside>
            </div>
        </div>
    </section>

    @if($relatedProjects->isNotEmpty())
        <section class="border-b border-stone-200 bg-stone-100">
            <div class="mx-auto max-w-6xl px-4 py-16 md:px-8 md:py-24">
                <x-site.section-heading eyebrow="Continue explorando" title="Outros casos de atuação" />
                <div class="mt-10 grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3 md:gap-8">
                    @foreach($relatedProjects as $relatedProject)
                        <x-site.project-card :project="$relatedProject" class="reveal" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <x-site.cta />
</x-layouts.site>
