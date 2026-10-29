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
    <section class="relative overflow-hidden border-b border-stone-200">
        <div class="absolute top-0 right-0 hidden pt-4 pr-8 text-[clamp(10rem,24vw,22rem)] leading-none font-light text-stone-900/[0.04] select-none lg:block" aria-hidden="true">
            01
        </div>

        <div class="relative mx-auto grid max-w-6xl grid-cols-12 gap-8 px-4 py-16 md:px-8 md:py-24 lg:py-32">
            <div class="col-span-12 lg:col-span-7">
                <div class="flex items-center gap-3">
                    <span class="block h-px w-8 bg-accent"></span>
                    <span class="text-xs font-medium tracking-widest text-stone-900/60 uppercase">Engenharia de campo · Redes 4G/5G</span>
                </div>

                <h1 class="mt-8 max-w-[16ch] text-[clamp(2.4rem,6vw,4.6rem)] leading-[0.98] font-light tracking-tight text-balance text-stone-900">
                    @if($heroHighlight)
                        {{ $heroLead }} <span class="text-accent">em {{ $heroHighlight }}</span>
                    @else
                        {{ $heroTitle }}
                    @endif
                </h1>

                <p class="mt-8 max-w-[52ch] text-base leading-relaxed text-pretty text-stone-900/60 md:text-lg">
                    {{ $heroSubtitle }}
                </p>

                <div class="mt-10 flex flex-col gap-3 sm:flex-row">
                    <a href="{{ route('contact.create') }}" class="inline-flex min-h-[44px] items-center justify-center gap-2 bg-accent px-6 py-3 text-sm font-medium tracking-wide text-white transition-colors hover:bg-accent/90">
                        Fale com um especialista
                        <svg viewBox="0 0 20 20" fill="none" class="h-4 w-4" aria-hidden="true">
                            <path d="M4 10h12m-4-4 4 4-4 4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                    <a href="{{ route('services.index') }}" class="inline-flex min-h-[44px] items-center justify-center border border-stone-300 px-6 py-3 text-sm font-medium tracking-wide text-stone-900 transition-colors hover:border-stone-900">
                        Nossos serviços
                    </a>
                </div>

                <div class="mt-10 flex flex-wrap gap-x-6 gap-y-3 border-t border-stone-200 pt-6 text-xs text-stone-900/60">
                    @foreach(['Vistorias em todo o Brasil', 'ERBs Greenfield e Rooftop', 'Auditorias EHS/FAM'] as $item)
                        <span class="flex items-center gap-2">
                            <span class="h-1 w-1 bg-accent"></span>
                            {{ $item }}
                        </span>
                    @endforeach
                </div>

                <dl class="mt-10 grid grid-cols-3 border-t border-stone-900/20">
                    @foreach($stats as $stat)
                        <div class="border-r border-stone-200 py-5 pr-4 last:border-r-0">
                            <dt class="text-2xl font-light tracking-tight text-stone-900 tabular-nums md:text-3xl">{{ $stat['value'] }}<span class="text-accent">{{ $stat['suffix'] }}</span></dt>
                            <dd class="mt-1 text-[10px] leading-4 tracking-widest text-stone-900/60 uppercase">{{ $stat['label'] }}</dd>
                        </div>
                    @endforeach
                </dl>
            </div>

            <div class="col-span-12 lg:col-span-5">
                <figure class="border border-stone-200 bg-stone-100">
                    <div class="flex items-center justify-between border-b border-stone-200 px-4 py-3">
                        <span class="font-mono text-[10px] tracking-widest text-stone-900/60 uppercase">Fig. 01 — Campo</span>
                        <span class="flex items-center gap-2 text-[10px] font-medium tracking-widest text-stone-900/60 uppercase">
                            <span class="h-1.5 w-1.5 bg-accent"></span>
                            Operacional
                        </span>
                    </div>

                    <div class="relative aspect-[4/5] overflow-hidden sm:aspect-[5/4] lg:aspect-[4/5]">
                        <div class="absolute inset-0 swiss-grid opacity-70"></div>

                        <svg viewBox="0 0 400 480" class="absolute inset-0 h-full w-full" fill="none" aria-hidden="true">
                            <g stroke="rgba(28,25,23,0.18)" stroke-width="1">
                                <path d="M0 400h400M0 300h400M0 200h400M0 100h400"/>
                                <path d="M80 0v480M180 0v480M280 0v480"/>
                            </g>
                            <g stroke="#78716c" stroke-width="1.4">
                                <path d="M200 420V220M170 420h60M183 380h34M189 340h22M194 300h12"/>
                                <circle cx="200" cy="205" r="6" fill="#1c1917" stroke="none"/>
                            </g>
                            <g stroke="#c8102e" stroke-linecap="round">
                                <path d="M200 184a28 28 0 0 0 0 42" stroke-width="2"/>
                                <path d="M200 184a28 28 0 0 1 0 42" stroke-width="2"/>
                                <path d="M200 164a52 52 0 0 0 0 82" stroke-width="1.5" opacity=".6"/>
                                <path d="M200 164a52 52 0 0 1 0 82" stroke-width="1.5" opacity=".6"/>
                                <path d="M200 144a80 80 0 0 0 0 122" stroke-width="1" opacity=".3"/>
                                <path d="M200 144a80 80 0 0 1 0 122" stroke-width="1" opacity=".3"/>
                            </g>
                            <g fill="#1c1917" opacity=".35">
                                <circle cx="96" cy="164" r="3"/>
                                <circle cx="310" cy="260" r="3"/>
                                <circle cx="122" cy="330" r="2.5"/>
                            </g>
                        </svg>

                        <div class="absolute top-4 left-4 border border-stone-300 bg-stone-50/90 px-3 py-2">
                            <p class="font-mono text-[9px] tracking-widest text-stone-900/60 uppercase">Tecnologia</p>
                            <p class="mt-1 text-xs font-medium text-stone-900">5G NR · 4G LTE</p>
                        </div>

                        <div class="absolute top-4 right-4 border border-stone-300 bg-stone-50/90 px-3 py-2">
                            <p class="font-mono text-[9px] tracking-widest text-stone-900/60 uppercase">Conformidade</p>
                            <p class="mt-1 text-xs font-medium text-stone-900">EHS · FAM</p>
                        </div>

                        <div class="absolute right-4 bottom-4 left-4 border-t border-stone-300 pt-3">
                            <div class="flex items-end justify-between gap-4">
                                <p class="text-xs leading-relaxed text-stone-900/60">Relatório técnico emitido em campo.</p>
                                <p class="font-mono text-[10px] tracking-widest text-accent uppercase">OK</p>
                            </div>
                        </div>
                    </div>

                    <figcaption class="grid grid-cols-3 border-t border-stone-200 text-center">
                        @foreach([
                            ['value' => '99,9%', 'label' => 'SLA operacional'],
                            ['value' => '24/7', 'label' => 'Suporte O&M'],
                            ['value' => '100%', 'label' => 'As-built digital'],
                        ] as $metric)
                            <div class="border-r border-stone-200 px-2 py-4 last:border-r-0">
                                <p class="text-sm font-medium text-stone-900 tabular-nums">{{ $metric['value'] }}</p>
                                <p class="mt-1 text-[9px] tracking-widest text-stone-900/60 uppercase">{{ $metric['label'] }}</p>
                            </div>
                        @endforeach
                    </figcaption>
                </figure>
            </div>
        </div>
    </section>

    <section class="border-b border-stone-200 bg-stone-100">
        <div class="mx-auto flex max-w-6xl flex-col gap-5 px-4 py-6 md:flex-row md:items-center md:justify-between md:px-8">
            <p class="text-xs font-medium tracking-widest text-stone-900/60 uppercase">Atendemos</p>
            <div class="flex flex-wrap gap-x-8 gap-y-2 text-[11px] font-medium tracking-widest text-stone-900/60 uppercase">
                <span>Operadoras Tier 1</span>
                <span>Torre companies</span>
                <span>Provedores regionais</span>
                <span>Integradores</span>
                <span>Infraestrutura crítica</span>
            </div>
        </div>
    </section>

    <section id="servicos" class="scroll-mt-24 border-b border-stone-200">
        <div class="mx-auto max-w-6xl px-4 py-16 md:px-8 md:py-24 lg:py-32">
            <div class="flex flex-col justify-between gap-6 md:flex-row md:items-end">
                <x-site.section-heading
                    eyebrow="Pilares de atuação"
                    title="Engenharia de campo do levantamento à entrega"
                    description="Executamos o ciclo completo de infraestrutura de telecomunicações com segurança, rastreabilidade e conformidade técnica."
                />
                <a href="{{ route('services.index') }}" class="inline-flex min-h-[44px] shrink-0 items-center text-sm font-medium text-stone-900 transition-colors hover:text-accent">
                    Ver todos os serviços →
                </a>
            </div>

            <div class="mt-12 grid grid-cols-1 gap-4 md:grid-cols-2 md:gap-8">
                @foreach($services->take(4) as $service)
                    <x-site.service-card :service="$service" :index="$loop->iteration" class="reveal" />
                @endforeach
            </div>
        </div>
    </section>

    <section id="diferenciais" class="scroll-mt-24 border-b border-stone-200 bg-stone-100">
        <div class="mx-auto grid max-w-6xl grid-cols-12 gap-8 px-4 py-16 md:px-8 md:py-24 lg:py-32">
            <div class="col-span-12 lg:col-span-5">
                <x-site.section-heading
                    eyebrow="Por que a SkyNet"
                    title="Precisão técnica que sustenta a operação"
                    description="Processos auditáveis, equipes certificadas e disciplina de campo para operações que não podem parar."
                />

                <div class="mt-8 border-l-2 border-accent bg-stone-50 p-5">
                    <p class="text-xs font-medium tracking-widest text-accent uppercase">Conformidade como padrão</p>
                    <p class="mt-2 max-w-[46ch] text-sm leading-relaxed text-stone-900/60">
                        Atuação alinhada a EHS, guias FAM, NR-10, NR-35 e requisitos técnicos de grandes operadoras.
                    </p>
                </div>

                <div class="mt-6 flex flex-wrap gap-2">
                    @foreach(['EHS', 'FAM', 'NR-10', 'NR-35', '5G NR'] as $badge)
                        <span class="border border-stone-300 px-2.5 py-1 font-mono text-[10px] tracking-widest text-stone-900/60">{{ $badge }}</span>
                    @endforeach
                </div>
            </div>

            <div class="col-span-12 grid grid-cols-1 gap-px border border-stone-200 bg-stone-200 sm:grid-cols-2 lg:col-span-7">
                @foreach([
                    ['icon' => 'survey', 'title' => 'Mobilização ágil', 'text' => 'Equipes próprias e parceiros homologados para atender cronogramas críticos em todo o território nacional.'],
                    ['icon' => 'audit', 'title' => 'Conformidade rigorosa', 'text' => 'Checklists, evidências fotográficas e validação técnica alinhados aos padrões das operadoras.'],
                    ['icon' => 'docs', 'title' => 'Relatórios em tempo real', 'text' => 'Dados de campo digitalizados, rastreabilidade e entrega de as-built com agilidade.'],
                    ['icon' => 'maintenance', 'title' => 'Engenharia qualificada', 'text' => 'Engenheiros e técnicos experientes em RAN, transmissão, energia e infraestrutura de sites.'],
                ] as $item)
                    <div class="reveal bg-stone-50 p-6 md:p-8">
                        <div class="flex h-10 w-10 items-center justify-center border border-stone-300 text-stone-900">
                            <x-site.service-icon :name="$item['icon']" class="h-5 w-5" />
                        </div>
                        <h3 class="mt-6 text-base font-medium text-stone-900">{{ $item['title'] }}</h3>
                        <p class="mt-2 max-w-[46ch] text-sm leading-relaxed text-stone-900/60">{{ $item['text'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section id="atuacao" class="scroll-mt-24 border-b border-stone-200">
        <div class="mx-auto grid max-w-6xl grid-cols-12 gap-8 px-4 py-16 md:px-8 md:py-24 lg:py-32">
            <div class="col-span-12 lg:col-span-6">
                <x-site.section-heading
                    eyebrow="Área de atuação"
                    title="Soluções para operadoras e infraestrutura de redes 4G/5G"
                    description="Apoiamos operadoras, torre companies e integradores em expansão, modernização e sustentação de redes em ambientes de alta criticidade."
                />

                <ul class="mt-8 border-t border-stone-200">
                    @foreach([
                        'Expansão e densificação de redes 4G e 5G',
                        'Implantação e comissionamento de ERBs Greenfield e Rooftop',
                        'Swap de equipamentos RAN com plano de rollback',
                        'Auditorias EHS, qualidade e aderência a procedimentos',
                        'Regularização, documentação técnica e as-built',
                        'O&M preventivo, corretivo e atendimento a emergências',
                    ] as $item)
                        <li class="flex items-start gap-3 border-b border-stone-200 py-3 text-sm leading-relaxed text-stone-900/70">
                            <span class="mt-2 h-1 w-1 shrink-0 bg-accent"></span>
                            {{ $item }}
                        </li>
                    @endforeach
                </ul>

                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="{{ route('contact.create') }}" class="inline-flex min-h-[44px] items-center gap-2 bg-accent px-5 py-3 text-sm font-medium tracking-wide text-white transition-colors hover:bg-accent/90">
                        Solicitar proposta B2B
                    </a>
                    <a href="{{ route('projects.index') }}" class="inline-flex min-h-[44px] items-center gap-2 border border-stone-300 px-5 py-3 text-sm font-medium tracking-wide text-stone-900 transition-colors hover:border-stone-900">
                        Ver casos de atuação
                    </a>
                </div>
            </div>

            <div class="col-span-12 lg:col-span-6">
                <div class="grid grid-cols-1 gap-px border border-stone-200 bg-stone-200 sm:grid-cols-2">
                    @foreach([
                        ['tag' => 'Expansão', 'title' => 'Rollout 4G/5G', 'text' => 'Planejamento de campo, instalação e comissionamento com foco em prazo e qualidade.'],
                        ['tag' => 'Modernização', 'title' => 'Swap RAN', 'text' => 'Substituição tecnológica com janelas controladas e mínimo de indisponibilidade.'],
                        ['tag' => 'Qualidade', 'title' => 'Auditoria técnica', 'text' => 'Diagnóstico de conformidade, EHS e aderência às especificações da operadora.'],
                        ['tag' => 'Operação', 'title' => 'O&M e emergências', 'text' => 'Sustentação de sites, manutenção preventiva e resposta rápida a incidentes.'],
                    ] as $item)
                        <div class="bg-stone-50 p-6 md:p-8">
                            <p class="font-mono text-[10px] tracking-widest text-accent uppercase">{{ $item['tag'] }}</p>
                            <h3 class="mt-4 text-lg font-normal text-stone-900">{{ $item['title'] }}</h3>
                            <p class="mt-2 max-w-[44ch] text-sm leading-relaxed text-stone-900/60">{{ $item['text'] }}</p>
                        </div>
                    @endforeach
                </div>

                <div class="mt-4 border border-stone-200 bg-stone-100 p-6">
                    <p class="text-xs font-medium tracking-widest text-stone-900/60 uppercase">Cobertura nacional</p>
                    <div class="mt-4 flex flex-wrap gap-2">
                        @foreach(['Norte', 'Nordeste', 'Centro-Oeste', 'Sudeste', 'Sul'] as $region)
                            <span class="border border-stone-300 px-2.5 py-1.5 text-xs text-stone-900/60">{{ $region }}</span>
                        @endforeach
                    </div>
                    <p class="mt-4 max-w-[52ch] text-sm leading-relaxed text-stone-900/60">Mobilização remota e equipes de campo em 18 estados, com gestão centralizada de cronogramas e evidências.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="portfolio" class="scroll-mt-24 border-b border-stone-200 bg-stone-100">
        <div class="mx-auto max-w-6xl px-4 py-16 md:px-8 md:py-24 lg:py-32">
            <div class="flex flex-col justify-between gap-6 md:flex-row md:items-end">
                <x-site.section-heading
                    eyebrow="Portfólio de atuação"
                    title="Casos que comprovam nossa execução"
                    description="Projetos de campo conduzidos com método, segurança e visibilidade para todas as partes envolvidas."
                />
                <a href="{{ route('projects.index') }}" class="inline-flex min-h-[44px] shrink-0 items-center text-sm font-medium text-stone-900 transition-colors hover:text-accent">
                    Explorar portfólio →
                </a>
            </div>

            <div class="mt-12 grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3 md:gap-8">
                @forelse($featuredProjects->take(3) as $project)
                    <x-site.project-card :project="$project" class="reveal" />
                @empty
                    <p class="text-sm text-stone-900/60">Novos casos serão publicados em breve.</p>
                @endforelse
            </div>
        </div>
    </section>

    <section class="border-b border-stone-200">
        <div class="mx-auto max-w-6xl px-4 py-16 md:px-8 md:py-24">
            <x-site.section-heading
                eyebrow="Como executamos"
                title="Método de campo previsível e auditável"
                description="Um processo único, do alinhamento inicial ao encerramento com evidências."
                align="center"
            />

            <div class="mt-12 grid grid-cols-1 border-t border-stone-200 sm:grid-cols-2 lg:grid-cols-4">
                @foreach([
                    ['step' => '01', 'title' => 'Mobilização', 'text' => 'Alinhamento de escopo, análise de riscos, documentação e liberação de acessos.'],
                    ['step' => '02', 'title' => 'Execução', 'text' => 'Atuação em campo com procedimentos EHS, checklists e registro contínuo.'],
                    ['step' => '03', 'title' => 'Validação', 'text' => 'Conferência técnica, tratativa de pendências e validação com o cliente.'],
                    ['step' => '04', 'title' => 'Entrega', 'text' => 'Relatório fotográfico, as-built e encerramento com rastreabilidade completa.'],
                ] as $item)
                    <div class="reveal border-b border-stone-200 py-6 sm:border-r sm:px-6 sm:last:border-r-0 lg:border-b-0">
                        <span class="font-mono text-xs font-medium tracking-widest text-accent tabular-nums">{{ $item['step'] }}</span>
                        <h3 class="mt-4 text-base font-medium text-stone-900">{{ $item['title'] }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-stone-900/60">{{ $item['text'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <x-site.cta />
</x-layouts.site>
