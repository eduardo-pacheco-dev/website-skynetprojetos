@php
    $settings = $siteSettings ?? [];
    $aboutTitle = $settings['about_title'] ?? 'Engenharia de campo com segurança, conformidade e rastreabilidade';
    $aboutText = $settings['about_text'] ?? 'A SkyNet Projetos atua em engenharia de telecomunicações e infraestrutura de alta performance, apoiando operadoras, torre companies e provedores em vistorias, implantações, swap e auditorias de conformidade em todo o Brasil.';
@endphp

<x-layouts.site title="Sobre" :description="$aboutText">
    <section class="relative overflow-hidden border-b border-stone-200">
        <div class="absolute top-0 right-0 hidden pt-4 pr-8 text-[clamp(8rem,20vw,18rem)] leading-none font-light text-stone-900/[0.04] select-none lg:block" aria-hidden="true">04</div>
        <div class="relative mx-auto max-w-6xl px-4 py-16 md:px-8 md:py-24 lg:py-32">
            <x-site.section-heading eyebrow="Sobre a SkyNet" :title="$aboutTitle" />
        </div>
    </section>

    <section class="border-b border-stone-200">
        <div class="mx-auto grid max-w-6xl grid-cols-12 gap-8 px-4 py-16 md:px-8 md:py-24 lg:py-32">
            <div class="col-span-12 lg:col-span-8">
                <p class="max-w-[60ch] text-lg leading-relaxed text-pretty text-stone-900/70">{{ $aboutText }}</p>
                <p class="mt-5 max-w-[60ch] text-base leading-relaxed text-pretty text-stone-900/60">
                    Nossa operação combina planejamento técnico, equipes de campo preparadas e gestão rigorosa de evidências. O resultado é uma execução previsível, segura e auditável, com visibilidade para o cliente em cada etapa.
                </p>

                <div class="mt-12 grid grid-cols-3 gap-px border border-stone-200 bg-stone-200">
                    @foreach([
                        ['value' => number_format((int) ($settings['stat_projects'] ?? 1200), 0, ',', '.').'+', 'label' => 'Sites vistoriados'],
                        ['value' => number_format((int) ($settings['stat_clients'] ?? 350), 0, ',', '.').'+', 'label' => 'ERBs implantadas'],
                        ['value' => $settings['stat_years'] ?? '18', 'label' => 'Estados atendidos'],
                    ] as $stat)
                        <div class="bg-stone-50 p-4 md:p-6">
                            <p class="text-2xl font-light tracking-tight text-stone-900 tabular-nums md:text-3xl">{{ $stat['value'] }}</p>
                            <p class="mt-1 text-[10px] tracking-widest text-stone-900/60 uppercase">{{ $stat['label'] }}</p>
                        </div>
                    @endforeach
                </div>

                <h2 class="mt-16 text-2xl leading-snug font-light tracking-tight text-stone-900">Nossos valores</h2>
                <div class="mt-6 grid grid-cols-1 gap-px border border-stone-200 bg-stone-200 sm:grid-cols-2">
                    @foreach([
                        ['title' => 'Segurança', 'text' => 'Nenhuma atividade começa sem análise de risco, permissão e procedimento EHS adequado.'],
                        ['title' => 'Conformidade', 'text' => 'Aderência a normas, guias FAM e requisitos técnicos das operadoras em cada entrega.'],
                        ['title' => 'Precisão', 'text' => 'Dados de campo confiáveis, validação técnica e documentação rastreável.'],
                        ['title' => 'Agilidade', 'text' => 'Mobilização rápida e gestão ativa de cronogramas para operações críticas.'],
                    ] as $value)
                        <div class="bg-stone-50 p-6 md:p-8">
                            <h3 class="text-base font-medium text-stone-900">{{ $value['title'] }}</h3>
                            <p class="mt-2 max-w-[46ch] text-sm leading-relaxed text-stone-900/60">{{ $value['text'] }}</p>
                        </div>
                    @endforeach
                </div>

                <div class="mt-8 border-l-2 border-accent bg-stone-100 p-6">
                    <p class="text-xs font-medium tracking-widest text-accent uppercase">Cultura de segurança</p>
                    <p class="mt-3 max-w-[60ch] text-sm leading-relaxed text-stone-900/60">
                        Trabalhamos com cultura de zero incidente, liberação formal de atividades, uso correto de EPIs e reporte imediato de desvios. Segurança e qualidade caminham juntas em cada site.
                    </p>
                </div>
            </div>

            <aside class="col-span-12 space-y-4 lg:col-span-4">
                <div class="border border-stone-200 border-t-2 border-t-accent bg-stone-100 p-6">
                    <h2 class="text-lg font-normal text-stone-900">Vamos conversar?</h2>
                    <p class="mt-3 text-sm leading-relaxed text-stone-900/60">Conte seu desafio de infraestrutura e receba um plano claro de próximos passos.</p>
                    <a href="{{ route('contact.create') }}" class="mt-5 inline-flex min-h-[44px] w-full items-center justify-center bg-accent px-5 py-3 text-sm font-medium tracking-wide text-white transition-colors hover:bg-accent/90">
                        Entrar em contato
                    </a>
                </div>

                <div class="border border-stone-200 bg-stone-50 p-6">
                    <h2 class="text-xs font-medium tracking-widest text-stone-900/60 uppercase">Onde atuamos</h2>
                    <p class="mt-3 text-sm leading-relaxed text-stone-900/60">{{ $settings['address'] ?? 'Atendimento nacional — Brasil' }}</p>
                    <div class="mt-4 flex flex-wrap gap-2">
                        @foreach(['Norte', 'Nordeste', 'Centro-Oeste', 'Sudeste', 'Sul'] as $region)
                            <span class="border border-stone-300 px-2.5 py-1 text-[11px] text-stone-900/60">{{ $region }}</span>
                        @endforeach
                    </div>
                </div>

                <div class="border border-stone-200 bg-stone-50 p-6">
                    <h2 class="text-xs font-medium tracking-widest text-stone-900/60 uppercase">Aderência</h2>
                    <div class="mt-4 flex flex-wrap gap-2">
                        @foreach(['EHS', 'FAM', 'NR-10', 'NR-35', '5G NR'] as $badge)
                            <span class="border border-stone-300 px-2.5 py-1 font-mono text-[10px] tracking-widest text-stone-900/60">{{ $badge }}</span>
                        @endforeach
                    </div>
                </div>
            </aside>
        </div>
    </section>

    <x-site.cta />
</x-layouts.site>
