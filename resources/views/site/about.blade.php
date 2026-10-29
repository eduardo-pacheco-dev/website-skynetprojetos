@php
    $settings = $siteSettings ?? [];
    $aboutTitle = $settings['about_title'] ?? 'Engenharia de telecomunicações com disciplina de campo';
    $aboutText = $settings['about_text'] ?? 'A SkyNet Projetos atua em engenharia de telecomunicações e infraestrutura de alta performance, apoiando operadoras, torre companies e provedores em vistorias, implantações, swap e auditorias de conformidade em todo o Brasil.';
@endphp

<x-layouts.site title="Sobre" :description="$aboutText">
    <section class="relative overflow-hidden border-b border-white/5">
        <div class="absolute inset-0 bg-grid opacity-50 [mask-image:radial-gradient(ellipse_at_top,black,transparent_75%)]"></div>
        <div class="pointer-events-none absolute -top-24 left-1/4 h-72 w-72 rounded-full bg-technical-500/10 blur-3xl"></div>
        <div class="relative mx-auto max-w-7xl px-6 py-20 lg:px-8 lg:py-24">
            <x-site.section-heading eyebrow="Sobre a SkyNet" :title="$aboutTitle" />
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-6 py-20 lg:px-8">
        <div class="grid gap-12 lg:grid-cols-[1fr_360px]">
            <div>
                <p class="text-lg leading-8 text-slate-300">{{ $aboutText }}</p>
                <p class="mt-5 text-base leading-8 text-slate-400">
                    Nossa operação combina planejamento técnico, equipes de campo preparadas e gestão rigorosa de evidências. O resultado é uma execução previsível, segura e auditável, com visibilidade para o cliente em cada etapa.
                </p>

                <div class="mt-10 grid gap-4 sm:grid-cols-3">
                    @foreach([
                        ['value' => number_format((int) ($settings['stat_projects'] ?? 1200), 0, ',', '.').'+', 'label' => 'Sites vistoriados'],
                        ['value' => number_format((int) ($settings['stat_clients'] ?? 350), 0, ',', '.').'+', 'label' => 'ERBs implantadas'],
                        ['value' => $settings['stat_years'] ?? '18', 'label' => 'Estados atendidos'],
                    ] as $stat)
                        <div class="rounded-xl border border-white/10 bg-navy-900/60 p-6">
                            <p class="text-3xl font-bold text-white">{{ $stat['value'] }}</p>
                            <p class="mt-2 text-xs tracking-wide text-slate-500 uppercase">{{ $stat['label'] }}</p>
                        </div>
                    @endforeach
                </div>

                <h2 class="mt-14 text-2xl font-bold text-white">Nossos valores</h2>
                <div class="mt-6 grid gap-4 sm:grid-cols-2">
                    @foreach([
                        ['title' => 'Segurança', 'text' => 'Nenhuma atividade começa sem análise de risco, permissão e procedimento EHS adequado.'],
                        ['title' => 'Conformidade', 'text' => 'Aderência a normas, guias FAM e requisitos técnicos das operadoras em cada entrega.'],
                        ['title' => 'Precisão', 'text' => 'Dados de campo confiáveis, validação técnica e documentação rastreável.'],
                        ['title' => 'Agilidade', 'text' => 'Mobilização rápida e gestão ativa de cronogramas para operações críticas.'],
                    ] as $value)
                        <div class="rounded-xl border border-white/10 bg-navy-900/60 p-5">
                            <div class="flex items-center gap-3">
                                <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-technical-500/10 text-technical-400">
                                    <svg viewBox="0 0 20 20" fill="none" class="h-4 w-4" aria-hidden="true">
                                        <path d="m4 10.5 4 4 8-9" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </span>
                                <h3 class="font-semibold text-white">{{ $value['title'] }}</h3>
                            </div>
                            <p class="mt-3 text-sm leading-6 text-slate-400">{{ $value['text'] }}</p>
                        </div>
                    @endforeach
                </div>

                <div class="mt-10 rounded-xl border border-compliance-500/20 bg-compliance-500/5 p-6">
                    <p class="text-xs font-semibold tracking-[0.16em] text-compliance-400 uppercase">Cultura de segurança</p>
                    <p class="mt-3 text-sm leading-6 text-slate-400">
                        Trabalhamos com cultura de zero incidente, liberação formal de atividades, uso correto de EPIs e reporte imediato de desvios. Segurança e qualidade caminham juntas em cada site.
                    </p>
                </div>
            </div>

            <aside class="space-y-5">
                <div class="rounded-xl border border-technical-500/25 bg-navy-900 p-6">
                    <h2 class="text-lg font-semibold text-white">Vamos conversar?</h2>
                    <p class="mt-3 text-sm leading-6 text-slate-400">Conte seu desafio de infraestrutura e receba um plano claro de próximos passos.</p>
                    <a href="{{ route('contact.create') }}" class="mt-5 inline-flex w-full items-center justify-center rounded-lg bg-technical-500 px-5 py-3 text-sm font-bold text-navy-950 transition hover:bg-technical-400">
                        Entrar em contato
                    </a>
                </div>

                <div class="rounded-xl border border-white/10 bg-navy-900/60 p-6">
                    <h2 class="text-xs font-semibold tracking-[0.16em] text-white uppercase">Onde atuamos</h2>
                    <p class="mt-3 text-sm leading-6 text-slate-400">{{ $settings['address'] ?? 'Atendimento nacional — Brasil' }}</p>
                    <div class="mt-4 flex flex-wrap gap-2">
                        @foreach(['Norte', 'Nordeste', 'Centro-Oeste', 'Sudeste', 'Sul'] as $region)
                            <span class="rounded-sm border border-white/10 bg-white/5 px-2.5 py-1 text-[11px] text-slate-400">{{ $region }}</span>
                        @endforeach
                    </div>
                </div>

                <div class="rounded-xl border border-white/10 bg-navy-900/60 p-6">
                    <h2 class="text-xs font-semibold tracking-[0.16em] text-white uppercase">Aderência</h2>
                    <div class="mt-4 flex flex-wrap gap-2">
                        @foreach(['EHS', 'FAM', 'NR-10', 'NR-35', '5G NR'] as $badge)
                            <span class="rounded-sm border border-white/10 bg-white/5 px-2.5 py-1 font-mono text-[10px] tracking-wider text-slate-400">{{ $badge }}</span>
                        @endforeach
                    </div>
                </div>
            </aside>
        </div>
    </section>

    <x-site.cta />
</x-layouts.site>
