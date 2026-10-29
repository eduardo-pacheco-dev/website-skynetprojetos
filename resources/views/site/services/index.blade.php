@php($settings = $siteSettings ?? [])

<x-layouts.site
    title="Serviços"
    description="Conheça os serviços de desenvolvimento web, sistemas sob medida, integrações, aplicativos e consultoria da SkyNet Projetos."
>
    <section class="relative overflow-hidden border-b border-white/5">
        <div class="absolute inset-0 bg-grid opacity-30 [mask-image:radial-gradient(ellipse_at_top,black,transparent_70%)]"></div>
        <div class="pointer-events-none absolute -top-24 left-1/3 h-72 w-72 rounded-full bg-cyan-500/15 blur-3xl"></div>
        <div class="relative mx-auto max-w-7xl px-6 py-20 lg:px-8">
            <x-site.section-heading
                eyebrow="Serviços"
                title="Tecnologia que acompanha o ritmo do seu negócio"
                description="Soluções completas para criar, integrar e evoluir produtos digitais com qualidade e previsibilidade."
            />
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-6 py-20 lg:px-8">
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @forelse($services as $service)
                <x-site.service-card :service="$service" class="reveal" />
            @empty
                <p class="text-sm text-slate-400">Nenhum serviço publicado no momento.</p>
            @endforelse
        </div>
    </section>

    <section class="border-y border-white/5 bg-white/[0.015]">
        <div class="mx-auto max-w-7xl px-6 py-20 lg:px-8">
            <x-site.section-heading
                eyebrow="Diferenciais"
                title="Por que trabalhar com a SkyNet?"
                align="center"
            />
            <div class="mt-12 grid gap-6 md:grid-cols-3">
                @foreach([
                    ['title' => 'Time sênior', 'text' => 'Profissionais experientes envolvidos diretamente no projeto, sem intermediários.', 'icon' => 'chart'],
                    ['title' => 'Código de qualidade', 'text' => 'Padrões claros, testes automatizados e documentação para facilitar a evolução.', 'icon' => 'code'],
                    ['title' => 'Parceria de longo prazo', 'text' => 'Acompanhamos o produto depois do lançamento, com suporte e melhorias contínuas.', 'icon' => 'shield'],
                ] as $item)
                    <div class="reveal rounded-2xl border border-white/10 bg-white/[0.03] p-6">
                        <div class="inline-flex h-11 w-11 items-center justify-center rounded-xl border border-cyan-400/20 bg-cyan-400/10 text-cyan-300">
                            <x-site.service-icon :name="$item['icon']" />
                        </div>
                        <h3 class="mt-5 text-lg font-semibold text-white">{{ $item['title'] }}</h3>
                        <p class="mt-3 text-sm leading-6 text-slate-400">{{ $item['text'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <x-site.cta :title="'Precisa de uma solução específica?'" :description="'Vamos conversar sobre o seu desafio e desenhar o caminho mais eficiente.'" />
</x-layouts.site>
