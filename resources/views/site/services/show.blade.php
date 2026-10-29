@php($settings = $siteSettings ?? [])

<x-layouts.site :title="$service->title" :description="$service->summary">
    <section class="relative overflow-hidden border-b border-white/5">
        <div class="absolute inset-0 bg-grid opacity-50 [mask-image:radial-gradient(ellipse_at_top,black,transparent_75%)]"></div>
        <div class="pointer-events-none absolute -top-24 right-1/4 h-72 w-72 rounded-full bg-technical-500/10 blur-3xl"></div>
        <div class="relative mx-auto max-w-7xl px-6 py-16 lg:px-8 lg:py-20">
            <nav class="flex items-center gap-2 text-xs text-slate-500" aria-label="Trilha de navegação">
                <a href="{{ route('home') }}" class="transition hover:text-technical-400">Início</a>
                <span>/</span>
                <a href="{{ route('services.index') }}" class="transition hover:text-technical-400">Serviços</a>
                <span>/</span>
                <span class="text-slate-300">{{ $service->title }}</span>
            </nav>

            <div class="mt-8 flex flex-col gap-6 sm:flex-row sm:items-start">
                <div class="inline-flex h-16 w-16 shrink-0 items-center justify-center rounded-xl border border-technical-500/30 bg-technical-500/10 text-technical-400">
                    <x-site.service-icon :name="$service->icon" class="h-8 w-8" />
                </div>
                <div class="max-w-3xl">
                    <p class="technical-label">Serviço de engenharia</p>
                    <h1 class="mt-3 text-4xl font-bold tracking-tight text-white sm:text-5xl">{{ $service->title }}</h1>
                    <p class="mt-4 text-lg leading-8 text-slate-400">{{ $service->summary }}</p>
                </div>
            </div>
        </div>
    </section>

    <section class="mx-auto grid max-w-7xl gap-12 px-6 py-20 lg:grid-cols-[1fr_360px] lg:px-8">
        <article>
            <h2 class="text-2xl font-bold text-white">Escopo de atuação</h2>
            <div class="mt-5 space-y-5 text-base leading-8 text-slate-400">
                @if($service->description)
                    <p>{!! nl2br(e($service->description)) !!}</p>
                @else
                    <p>{{ $service->summary }}</p>
                @endif
            </div>

            <div class="mt-10 grid gap-4 sm:grid-cols-2">
                <div class="rounded-xl border border-white/10 bg-navy-900/60 p-6">
                    <h3 class="flex items-center gap-2 text-sm font-semibold tracking-wide text-white uppercase">
                        <span class="h-1.5 w-1.5 rounded-full bg-technical-500"></span>
                        Atividades típicas
                    </h3>
                    <ul class="mt-4 space-y-2.5">
                        @foreach([
                            'Planejamento e mobilização de campo',
                            'Execução conforme procedimento do cliente',
                            'Registro fotográfico e coleta de evidências',
                            'Medições, testes e validação técnica',
                            'Tratativa e acompanhamento de pendências',
                            'Emissão de relatório e as-built',
                        ] as $activity)
                            <li class="flex items-start gap-2.5 text-sm leading-6 text-slate-400">
                                <svg viewBox="0 0 20 20" fill="none" class="mt-1 h-3.5 w-3.5 shrink-0 text-compliance-500" aria-hidden="true">
                                    <path d="m4 10.5 4 4 8-9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                {{ $activity }}
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="rounded-xl border border-white/10 bg-navy-900/60 p-6">
                    <h3 class="flex items-center gap-2 text-sm font-semibold tracking-wide text-white uppercase">
                        <span class="h-1.5 w-1.5 rounded-full bg-compliance-500"></span>
                        Entregáveis
                    </h3>
                    <ul class="mt-4 space-y-2.5">
                        @foreach([
                            'Relatório técnico fotográfico',
                            'Checklist de conformidade',
                            'Matriz de pendências e riscos',
                            'Documentação as-built',
                            'Base de dados e evidências digitais',
                            'Recomendações técnicas',
                        ] as $deliverable)
                            <li class="flex items-start gap-2.5 text-sm leading-6 text-slate-400">
                                <svg viewBox="0 0 20 20" fill="none" class="mt-1 h-3.5 w-3.5 shrink-0 text-technical-400" aria-hidden="true">
                                    <path d="M5 3.5h7l3 3V18H5V3.5Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/>
                                    <path d="M8 9h4M8 12h4" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>
                                </svg>
                                {{ $deliverable }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="mt-8 rounded-xl border border-compliance-500/20 bg-compliance-500/5 p-6">
                <h3 class="text-sm font-semibold tracking-wide text-compliance-400 uppercase">Segurança e conformidade</h3>
                <p class="mt-3 text-sm leading-6 text-slate-400">
                    Execução alinhada a EHS, guias FAM, NR-10, NR-35 e requisitos técnicos de operadoras. Toda atividade é precedida de análise de risco e liberação formal de trabalho.
                </p>
            </div>
        </article>

        <aside class="space-y-5">
            <div class="rounded-xl border border-technical-500/25 bg-navy-900 p-6">
                <h2 class="text-lg font-semibold text-white">Solicite uma avaliação técnica</h2>
                <p class="mt-3 text-sm leading-6 text-slate-400">Envie o escopo, a localidade e o prazo. Retornamos com uma proposta objetiva.</p>
                <a href="{{ route('contact.create') }}" class="mt-5 inline-flex w-full items-center justify-center rounded-lg bg-technical-500 px-5 py-3 text-sm font-bold text-navy-950 transition hover:bg-technical-400">
                    Solicitar orçamento
                </a>
                @if(filled($settings['whatsapp'] ?? null))
                    <a href="https://wa.me/{{ preg_replace('/\D+/', '', $settings['whatsapp']) }}" target="_blank" rel="noopener noreferrer" class="mt-3 inline-flex w-full items-center justify-center rounded-lg border border-white/15 bg-white/5 px-5 py-3 text-sm font-semibold text-white transition hover:bg-white/10">
                        Falar no WhatsApp
                    </a>
                @endif
            </div>

            <div class="rounded-xl border border-white/10 bg-navy-900/60 p-6">
                <h2 class="text-xs font-semibold tracking-[0.16em] text-slate-400 uppercase">Aderência técnica</h2>
                <div class="mt-4 flex flex-wrap gap-2">
                    @foreach(['EHS', 'FAM', 'NR-10', 'NR-35', '4G/5G'] as $badge)
                        <span class="rounded-sm border border-white/10 bg-white/5 px-2.5 py-1 font-mono text-[10px] tracking-wider text-slate-400">{{ $badge }}</span>
                    @endforeach
                </div>
            </div>

            @if($otherServices->isNotEmpty())
                <div class="rounded-xl border border-white/10 bg-navy-900/60 p-6">
                    <h2 class="text-xs font-semibold tracking-[0.16em] text-slate-400 uppercase">Outros serviços</h2>
                    <ul class="mt-4 space-y-3">
                        @foreach($otherServices as $otherService)
                            <li>
                                <a href="{{ route('services.show', $otherService) }}" class="group flex items-center justify-between gap-3 text-sm text-slate-400 transition hover:text-technical-400">
                                    {{ $otherService->title }}
                                    <svg viewBox="0 0 20 20" fill="none" class="h-4 w-4 shrink-0 transition group-hover:translate-x-1" aria-hidden="true">
                                        <path d="M4 10h12m-4-4 4 4-4 4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </aside>
    </section>
</x-layouts.site>
