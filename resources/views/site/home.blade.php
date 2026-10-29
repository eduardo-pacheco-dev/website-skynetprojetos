@php
    $settings = $siteSettings ?? [];
    $heroTitle = $settings['hero_title'] ?? 'Excelência e precisão em infraestrutura e engenharia de telecomunicações';
    $heroSubtitle = $settings['hero_subtitle'] ?? 'Vistorias técnicas, implantação de ERBs, projetos de swap e auditorias de conformidade para operadoras, torre companies e provedores em todo o Brasil.';
    [$heroLead, $heroHighlight] = array_pad(explode(' em ', $heroTitle, 2), 2, null);
    $stats = [
        ['value' => number_format((int) ($settings['stat_projects'] ?? 1200), 0, ',', '.'), 'suffix' => '+', 'label' => 'Sites vistoriados'],
        ['value' => number_format((int) ($settings['stat_clients'] ?? 350), 0, ',', '.'), 'suffix' => '+', 'label' => 'ERBs implantadas'],
        ['value' => $settings['stat_years'] ?? '18', 'suffix' => '', 'label' => 'Estados atendidos'],
    ];
@endphp

<x-layouts.site :description="$heroSubtitle">
    <section class="relative overflow-hidden border-b border-white/5">
        <div class="absolute inset-0 bg-grid opacity-60 [mask-image:radial-gradient(ellipse_at_top_left,black,transparent_75%)]"></div>
        <div class="pointer-events-none absolute -top-32 left-1/4 h-[28rem] w-[28rem] rounded-full bg-technical-500/10 blur-3xl"></div>
        <div class="pointer-events-none absolute top-1/3 right-0 h-80 w-80 rounded-full bg-navy-700/40 blur-3xl"></div>

        <div class="relative mx-auto grid max-w-7xl items-center gap-14 px-6 py-16 lg:grid-cols-[1.05fr_0.95fr] lg:px-8 lg:py-24">
            <div class="reveal">
                <span class="inline-flex items-center gap-2.5 rounded-sm border border-technical-500/30 bg-technical-500/5 px-3 py-1.5 text-[11px] font-semibold tracking-[0.16em] text-technical-400 uppercase">
                    <span class="relative flex h-1.5 w-1.5">
                        <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-technical-500 opacity-60"></span>
                        <span class="relative inline-flex h-1.5 w-1.5 rounded-full bg-technical-500"></span>
                    </span>
                    Engenharia de campo · Redes 4G/5G
                </span>

                <h1 class="mt-7 text-4xl font-bold leading-[1.1] tracking-tight text-white sm:text-5xl lg:text-[3.4rem]">
                    @if($heroHighlight)
                        {{ $heroLead }} <span class="text-gradient">em {{ $heroHighlight }}</span>
                    @else
                        {{ $heroTitle }}
                    @endif
                </h1>

                <p class="mt-6 max-w-xl text-base leading-8 text-slate-400 sm:text-lg">
                    {{ $heroSubtitle }}
                </p>

                <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                    <a href="{{ route('contact.create') }}" class="inline-flex items-center justify-center gap-2 rounded-lg bg-technical-500 px-6 py-3.5 text-sm font-bold text-navy-950 transition hover:bg-technical-400">
                        Fale com um especialista
                        <svg viewBox="0 0 20 20" fill="none" class="h-4 w-4" aria-hidden="true">
                            <path d="M4 10h12m-4-4 4 4-4 4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                    <a href="{{ route('services.index') }}" class="inline-flex items-center justify-center rounded-lg border border-white/15 bg-white/5 px-6 py-3.5 text-sm font-semibold text-white transition hover:border-technical-500/40 hover:bg-white/10">
                        Nossos serviços
                    </a>
                </div>

                <div class="mt-9 flex flex-wrap gap-x-6 gap-y-3 text-xs text-slate-500">
                    @foreach(['Vistorias em todo o Brasil', 'ERBs Greenfield e Rooftop', 'Auditorias EHS/FAM'] as $item)
                        <span class="flex items-center gap-2">
                            <svg viewBox="0 0 20 20" fill="none" class="h-4 w-4 text-compliance-500" aria-hidden="true">
                                <path d="m4 10.5 4 4 8-9" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            {{ $item }}
                        </span>
                    @endforeach
                </div>

                <dl class="mt-10 grid max-w-lg grid-cols-3 gap-4 border-t border-white/10 pt-7">
                    @foreach($stats as $stat)
                        <div>
                            <dt class="text-2xl font-bold text-white sm:text-3xl">{{ $stat['value'] }}<span class="text-technical-400">{{ $stat['suffix'] }}</span></dt>
                            <dd class="mt-1 text-[11px] leading-4 tracking-wide text-slate-500 uppercase">{{ $stat['label'] }}</dd>
                        </div>
                    @endforeach
                </dl>
            </div>

            <div class="reveal relative">
                <div class="absolute -inset-4 rounded-2xl bg-technical-500/5 blur-2xl"></div>
                <div class="relative overflow-hidden rounded-xl border border-white/10 bg-navy-900 shadow-2xl shadow-black/40">
                    <div class="flex items-center justify-between border-b border-white/10 px-5 py-3">
                        <span class="font-mono text-[10px] tracking-[0.2em] text-slate-500 uppercase">SkyNet · Campo 04</span>
                        <span class="flex items-center gap-2 text-[10px] font-semibold tracking-wider text-compliance-400 uppercase">
                            <span class="h-1.5 w-1.5 rounded-full bg-compliance-500"></span>
                            Sistema ativo
                        </span>
                    </div>

                    <div class="relative h-[310px] overflow-hidden sm:h-[380px]">
                        <div class="absolute inset-0 bg-blueprint opacity-50"></div>
                        <div class="absolute inset-0 bg-gradient-to-t from-navy-950/80 via-transparent to-transparent"></div>

                        <svg viewBox="0 0 440 380" class="absolute inset-0 h-full w-full" fill="none" aria-hidden="true">
                            <g opacity=".45" stroke="#f97316" stroke-width="1">
                                <path d="M0 310h440M0 230h440M0 150h440M0 70h440"/>
                                <path d="M80 0v380M170 0v380M260 0v380M350 0v380"/>
                            </g>
                            <g stroke="#94a3b8" stroke-width="1.4" opacity=".35">
                                <path d="M220 330V150M190 330h60M203 300h34M209 268h22M214 236h12"/>
                                <circle cx="220" cy="140" r="5" fill="#f97316" stroke="none"/>
                            </g>
                            <g stroke="#f97316" stroke-linecap="round">
                                <path d="M220 122a26 26 0 0 0 0 36" stroke-width="2.5" opacity=".9"/>
                                <path d="M220 122a26 26 0 0 1 0 36" stroke-width="2.5" opacity=".9"/>
                                <path d="M220 104a50 50 0 0 0 0 72" stroke-width="2" opacity=".5"/>
                                <path d="M220 104a50 50 0 0 1 0 72" stroke-width="2" opacity=".5"/>
                                <path d="M220 86a78 78 0 0 0 0 108" stroke-width="1.4" opacity=".25"/>
                                <path d="M220 86a78 78 0 0 1 0 108" stroke-width="1.4" opacity=".25"/>
                            </g>
                            <g fill="#4ade80">
                                <circle cx="120" cy="96" r="3"/>
                                <circle cx="338" cy="180" r="3"/>
                                <circle cx="92" cy="250" r="2.5"/>
                            </g>
                        </svg>

                        <div class="absolute top-5 left-5 rounded border border-white/10 bg-navy-950/80 px-3 py-2 backdrop-blur-sm">
                            <p class="font-mono text-[9px] tracking-widest text-slate-500 uppercase">Tecnologia</p>
                            <p class="mt-1 text-xs font-semibold text-white">5G NR · 4G LTE</p>
                        </div>

                        <div class="absolute top-5 right-5 rounded border border-compliance-500/30 bg-navy-950/80 px-3 py-2 backdrop-blur-sm">
                            <p class="font-mono text-[9px] tracking-widest text-slate-500 uppercase">Conformidade</p>
                            <p class="mt-1 text-xs font-semibold text-compliance-400">EHS · FAM</p>
                        </div>

                        <div class="absolute bottom-5 left-5 rounded border border-technical-500/25 bg-navy-900/90 px-4 py-3 backdrop-blur-sm">
                            <p class="flex items-center gap-2 text-xs font-semibold text-white">
                                <span class="h-1.5 w-1.5 rounded-full bg-technical-500"></span>
                                Vistoria concluída
                            </p>
                            <p class="mt-1 text-[10px] text-slate-500">Relatório técnico emitido em campo</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-px border-t border-white/10 bg-white/10">
                        @foreach([
                            ['value' => '99,9%', 'label' => 'SLA operacional'],
                            ['value' => '24/7', 'label' => 'Suporte O&M'],
                            ['value' => '100%', 'label' => 'As-built digital'],
                        ] as $metric)
                            <div class="bg-navy-900 px-4 py-4 text-center">
                                <p class="text-base font-bold text-white">{{ $metric['value'] }}</p>
                                <p class="mt-1 text-[9px] tracking-wide text-slate-500 uppercase">{{ $metric['label'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="border-b border-white/5 bg-navy-900/40">
        <div class="mx-auto flex max-w-7xl flex-col items-center gap-5 px-6 py-7 text-center lg:flex-row lg:justify-between lg:px-8 lg:text-left">
            <p class="technical-label">Atendemos</p>
            <div class="flex flex-wrap items-center justify-center gap-x-8 gap-y-3 text-[11px] font-semibold tracking-[0.14em] text-slate-500 uppercase">
                <span>Operadoras Tier 1</span>
                <span class="hidden h-1 w-1 rounded-full bg-slate-700 lg:block"></span>
                <span>Torre companies</span>
                <span class="hidden h-1 w-1 rounded-full bg-slate-700 lg:block"></span>
                <span>Provedores regionais</span>
                <span class="hidden h-1 w-1 rounded-full bg-slate-700 lg:block"></span>
                <span>Integradores</span>
                <span class="hidden h-1 w-1 rounded-full bg-slate-700 lg:block"></span>
                <span>Infraestrutura crítica</span>
            </div>
        </div>
    </section>

    <section id="servicos" class="mx-auto max-w-7xl scroll-mt-24 px-6 py-20 lg:px-8 lg:py-24">
        <div class="flex flex-col justify-between gap-6 sm:flex-row sm:items-end">
            <x-site.section-heading
                eyebrow="Pilares de atuação"
                title="Engenharia de campo do levantamento à entrega"
                description="Executamos o ciclo completo de infraestrutura de telecomunicações com segurança, rastreabilidade e conformidade técnica."
            />
            <a href="{{ route('services.index') }}" class="shrink-0 text-sm font-semibold text-technical-400 transition hover:text-technical-300">
                Ver todos os serviços →
            </a>
        </div>

        <div class="mt-12 grid gap-5 md:grid-cols-2">
            @foreach($services->take(4) as $service)
                <x-site.service-card :service="$service" :index="$loop->iteration" class="reveal" />
            @endforeach
        </div>
    </section>

    <section id="diferenciais" class="scroll-mt-24 border-y border-white/5 bg-steel-800/30">
        <div class="mx-auto grid max-w-7xl gap-12 px-6 py-20 lg:grid-cols-[0.8fr_1.2fr] lg:px-8 lg:py-24">
            <div class="reveal">
                <x-site.section-heading
                    eyebrow="Por que a SkyNet"
                    title="Precisão técnica que sustenta a operação"
                    description="Processos auditáveis, equipes certificadas e disciplina de campo para operações que não podem parar."
                />

                <div class="mt-8 rounded-xl border border-compliance-500/20 bg-compliance-500/5 p-5">
                    <p class="flex items-center gap-2 text-xs font-semibold tracking-wide text-compliance-400 uppercase">
                        <span class="h-1.5 w-1.5 rounded-full bg-compliance-500"></span>
                        Conformidade como padrão
                    </p>
                    <p class="mt-2 text-sm leading-6 text-slate-400">
                        Atuação alinhada a EHS, guias FAM, NR-10, NR-35 e requisitos técnicos de grandes operadoras.
                    </p>
                </div>

                <div class="mt-6 flex flex-wrap gap-2">
                    @foreach(['EHS', 'FAM', 'NR-10', 'NR-35', '5G NR'] as $badge)
                        <span class="rounded-sm border border-white/10 bg-white/5 px-2.5 py-1 font-mono text-[10px] tracking-wider text-slate-400">{{ $badge }}</span>
                    @endforeach
                </div>
            </div>

            <div class="grid gap-4 sm:grid-cols-2">
                @foreach([
                    ['icon' => 'survey', 'title' => 'Mobilização ágil', 'text' => 'Equipes próprias e parceiros homologados para atender cronogramas críticos em todo o território nacional.'],
                    ['icon' => 'audit', 'title' => 'Conformidade rigorosa', 'text' => 'Checklists, evidências fotográficas e validação técnica alinhados aos padrões das operadoras.'],
                    ['icon' => 'docs', 'title' => 'Relatórios em tempo real', 'text' => 'Dados de campo digitalizados, rastreabilidade e entrega de as-built com agilidade.'],
                    ['icon' => 'maintenance', 'title' => 'Engenharia qualificada', 'text' => 'Engenheiros e técnicos experientes em RAN, transmissão, energia e infraestrutura de sites.'],
                ] as $item)
                    <div class="reveal rounded-xl border border-white/10 bg-navy-900/60 p-6 transition hover:border-technical-500/30">
                        <div class="inline-flex h-10 w-10 items-center justify-center rounded-lg bg-technical-500/10 text-technical-400">
                            <x-site.service-icon :name="$item['icon']" />
                        </div>
                        <h3 class="mt-5 text-base font-semibold text-white">{{ $item['title'] }}</h3>
                        <p class="mt-2 text-sm leading-6 text-slate-400">{{ $item['text'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section id="atuacao" class="relative scroll-mt-24 overflow-hidden border-b border-white/5 bg-navy-900">
        <div class="absolute inset-0 bg-grid opacity-30"></div>
        <div class="pointer-events-none absolute -bottom-32 right-0 h-96 w-96 rounded-full bg-technical-500/5 blur-3xl"></div>

        <div class="relative mx-auto grid max-w-7xl gap-14 px-6 py-20 lg:grid-cols-2 lg:px-8 lg:py-24">
            <div class="reveal">
                <x-site.section-heading
                    eyebrow="Área de atuação"
                    title="Soluções para operadoras e infraestrutura de redes 4G/5G"
                    description="Apoiamos operadoras, torre companies e integradores em expansão, modernização e sustentação de redes em ambientes de alta criticidade."
                />

                <ul class="mt-8 space-y-4">
                    @foreach([
                        'Expansão e densificação de redes 4G e 5G',
                        'Implantação e comissionamento de ERBs Greenfield e Rooftop',
                        'Swap de equipamentos RAN com plano de rollback',
                        'Auditorias EHS, qualidade e aderência a procedimentos',
                        'Regularização, documentação técnica e as-built',
                        'O&M preventivo, corretivo e atendimento a emergências',
                    ] as $item)
                        <li class="flex items-start gap-3 text-sm leading-6 text-slate-300">
                            <span class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded-sm bg-technical-500/10 text-technical-400">
                                <svg viewBox="0 0 20 20" fill="none" class="h-3.5 w-3.5" aria-hidden="true">
                                    <path d="m4 10.5 4 4 8-9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                            {{ $item }}
                        </li>
                    @endforeach
                </ul>

                <div class="mt-9 flex flex-wrap gap-3">
                    <a href="{{ route('contact.create') }}" class="inline-flex items-center gap-2 rounded-lg bg-technical-500 px-5 py-3 text-sm font-bold text-navy-950 transition hover:bg-technical-400">
                        Solicitar proposta B2B
                    </a>
                    <a href="{{ route('projects.index') }}" class="inline-flex items-center gap-2 rounded-lg border border-white/15 px-5 py-3 text-sm font-semibold text-white transition hover:bg-white/5">
                        Ver casos de atuação
                    </a>
                </div>
            </div>

            <div class="reveal grid gap-4 sm:grid-cols-2">
                @foreach([
                    ['tag' => 'Expansão', 'title' => 'Rollout 4G/5G', 'text' => 'Planejamento de campo, instalação e comissionamento com foco em prazo e qualidade.'],
                    ['tag' => 'Modernização', 'title' => 'Swap RAN', 'text' => 'Substituição tecnológica com janelas controladas e mínimo de indisponibilidade.'],
                    ['tag' => 'Qualidade', 'title' => 'Auditoria técnica', 'text' => 'Diagnóstico de conformidade, EHS e aderência às especificações da operadora.'],
                    ['tag' => 'Operação', 'title' => 'O&M e emergências', 'text' => 'Sustentação de sites, manutenção preventiva e resposta rápida a incidentes.'],
                ] as $item)
                    <div class="relative overflow-hidden rounded-xl border border-white/10 bg-navy-950/60 p-6">
                        <span class="absolute top-0 right-0 h-16 w-16 rounded-bl-full border-b border-l border-technical-500/10"></span>
                        <p class="font-mono text-[10px] tracking-[0.18em] text-technical-400 uppercase">{{ $item['tag'] }}</p>
                        <h3 class="mt-3 text-lg font-semibold text-white">{{ $item['title'] }}</h3>
                        <p class="mt-2 text-sm leading-6 text-slate-400">{{ $item['text'] }}</p>
                    </div>
                @endforeach

                <div class="sm:col-span-2 rounded-xl border border-white/10 bg-navy-950/60 p-6">
                    <p class="technical-label">Cobertura nacional</p>
                    <div class="mt-4 flex flex-wrap gap-2">
                        @foreach(['Norte', 'Nordeste', 'Centro-Oeste', 'Sudeste', 'Sul'] as $region)
                            <span class="rounded-sm border border-white/10 bg-white/5 px-2.5 py-1.5 text-xs text-slate-300">{{ $region }}</span>
                        @endforeach
                    </div>
                    <p class="mt-4 text-sm leading-6 text-slate-500">Mobilização remota e equipes de campo em 18 estados, com gestão centralizada de cronogramas e evidências.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="portfolio" class="mx-auto max-w-7xl scroll-mt-24 px-6 py-20 lg:px-8 lg:py-24">
        <div class="flex flex-col justify-between gap-6 sm:flex-row sm:items-end">
            <x-site.section-heading
                eyebrow="Portfólio de atuação"
                title="Casos que comprovam nossa execução"
                description="Projetos de campo conduzidos com método, segurança e visibilidade para todas as partes envolvidas."
            />
            <a href="{{ route('projects.index') }}" class="shrink-0 text-sm font-semibold text-technical-400 transition hover:text-technical-300">
                Explorar portfólio →
            </a>
        </div>

        <div class="mt-12 grid gap-5 md:grid-cols-2 lg:grid-cols-3">
            @forelse($featuredProjects->take(3) as $project)
                <x-site.project-card :project="$project" class="reveal" />
            @empty
                <p class="text-sm text-slate-400">Novos casos serão publicados em breve.</p>
            @endforelse
        </div>
    </section>

    <section class="border-y border-white/5 bg-steel-800/30">
        <div class="mx-auto max-w-7xl px-6 py-20 lg:px-8">
            <x-site.section-heading
                eyebrow="Como executamos"
                title="Método de campo previsível e auditável"
                description="Um processo único, do alinhamento inicial ao encerramento com evidências."
                align="center"
            />

            <div class="mt-12 grid gap-4 md:grid-cols-2 lg:grid-cols-4">
                @foreach([
                    ['step' => '01', 'title' => 'Mobilização', 'text' => 'Alinhamento de escopo, análise de riscos, documentação e liberação de acessos.'],
                    ['step' => '02', 'title' => 'Execução', 'text' => 'Atuação em campo com procedimentos EHS, checklists e registro contínuo.'],
                    ['step' => '03', 'title' => 'Validação', 'text' => 'Conferência técnica, tratativa de pendências e validação com o cliente.'],
                    ['step' => '04', 'title' => 'Entrega', 'text' => 'Relatório fotográfico, as-built e encerramento com rastreabilidade completa.'],
                ] as $item)
                    <div class="reveal rounded-xl border border-white/10 bg-navy-900/60 p-6">
                        <span class="font-mono text-xs font-semibold tracking-[0.2em] text-technical-400">{{ $item['step'] }}</span>
                        <h3 class="mt-4 text-base font-semibold text-white">{{ $item['title'] }}</h3>
                        <p class="mt-2 text-sm leading-6 text-slate-400">{{ $item['text'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <x-site.cta />
</x-layouts.site>
