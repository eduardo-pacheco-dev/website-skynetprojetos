@php
    $settings = $siteSettings ?? [];
    $aboutTitle = $settings['about_title'] ?? 'Tecnologia com propósito, do planejamento ao lançamento';
    $aboutText = $settings['about_text'] ?? 'A SkyNet Projetos é uma software house focada em criar soluções digitais que resolvem problemas reais.';
@endphp

<x-layouts.site title="Sobre" :description="$aboutText">
    <section class="relative overflow-hidden border-b border-white/5">
        <div class="absolute inset-0 bg-grid opacity-30 [mask-image:radial-gradient(ellipse_at_top,black,transparent_70%)]"></div>
        <div class="pointer-events-none absolute -top-24 left-1/4 h-72 w-72 rounded-full bg-cyan-500/15 blur-3xl"></div>
        <div class="relative mx-auto max-w-7xl px-6 py-20 lg:px-8">
            <x-site.section-heading eyebrow="Sobre nós" :title="$aboutTitle" />
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-6 py-20 lg:px-8">
        <div class="grid gap-12 lg:grid-cols-[1fr_360px]">
            <div>
                <p class="text-lg leading-8 text-slate-300">{{ $aboutText }}</p>

                <div class="mt-10 grid gap-6 sm:grid-cols-3">
                    @foreach([
                        ['value' => ($settings['stat_projects'] ?? '80').'+', 'label' => 'Projetos entregues'],
                        ['value' => ($settings['stat_clients'] ?? '40').'+', 'label' => 'Clientes atendidos'],
                        ['value' => ($settings['stat_years'] ?? '10'), 'label' => 'Anos de experiência'],
                    ] as $stat)
                        <div class="rounded-2xl border border-white/10 bg-white/[0.03] p-6">
                            <p class="text-3xl font-bold text-white">{{ $stat['value'] }}</p>
                            <p class="mt-2 text-sm text-slate-400">{{ $stat['label'] }}</p>
                        </div>
                    @endforeach
                </div>

                <h2 class="mt-14 text-2xl font-bold text-white">Nossos valores</h2>
                <div class="mt-6 space-y-4">
                    @foreach([
                        ['title' => 'Clareza', 'text' => 'Comunicação direta, escopo transparente e decisões explicadas em linguagem simples.'],
                        ['title' => 'Qualidade', 'text' => 'Código limpo, testes e revisão constante para entregar produtos que duram.'],
                        ['title' => 'Parceria', 'text' => 'Enxergamos cada cliente como parceiro de longo prazo, não como um projeto isolado.'],
                    ] as $value)
                        <div class="flex gap-4 rounded-2xl border border-white/10 bg-white/[0.02] p-5">
                            <span class="mt-1 flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-cyan-400/10 text-cyan-300">
                                <svg viewBox="0 0 20 20" fill="none" class="h-4 w-4" aria-hidden="true">
                                    <path d="m4 10.5 4 4 8-9" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                            <div>
                                <h3 class="font-semibold text-white">{{ $value['title'] }}</h3>
                                <p class="mt-1.5 text-sm leading-6 text-slate-400">{{ $value['text'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <aside class="space-y-6">
                <div class="rounded-2xl border border-cyan-400/20 bg-gradient-to-br from-cyan-500/10 to-violet-500/5 p-6">
                    <h2 class="text-lg font-semibold text-white">Vamos conversar?</h2>
                    <p class="mt-3 text-sm leading-6 text-slate-300">Conte sua ideia ou desafio. Respondemos com um plano claro de próximos passos.</p>
                    <a href="{{ route('contact.create') }}" class="mt-5 inline-flex w-full items-center justify-center rounded-xl bg-gradient-to-r from-cyan-400 to-sky-500 px-5 py-3 text-sm font-semibold text-slate-950 transition hover:brightness-110">
                        Entrar em contato
                    </a>
                </div>

                <div class="rounded-2xl border border-white/10 bg-white/[0.02] p-6">
                    <h2 class="text-sm font-semibold tracking-wide text-white uppercase">Onde estamos</h2>
                    <p class="mt-3 text-sm leading-6 text-slate-400">{{ $settings['address'] ?? 'São Paulo, SP — Brasil' }}</p>
                    <p class="mt-4 text-sm leading-6 text-slate-400">Atendemos clientes de todo o Brasil, com trabalho remoto e reuniões online.</p>
                </div>
            </aside>
        </div>
    </section>

    <x-site.cta />
</x-layouts.site>
