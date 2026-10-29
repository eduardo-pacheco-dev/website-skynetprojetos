@php($settings = $siteSettings ?? [])

<x-layouts.site
    title="Serviços"
    description="Vistorias técnicas, implantação de ERBs, projetos de swap, auditorias EHS e manutenção de infraestrutura de telecomunicações."
>
    <section class="relative overflow-hidden border-b border-white/5">
        <div class="absolute inset-0 bg-grid opacity-50 [mask-image:radial-gradient(ellipse_at_top,black,transparent_75%)]"></div>
        <div class="pointer-events-none absolute -top-24 left-1/3 h-72 w-72 rounded-full bg-technical-500/10 blur-3xl"></div>
        <div class="relative mx-auto max-w-7xl px-6 py-20 lg:px-8 lg:py-24">
            <x-site.section-heading
                eyebrow="Serviços"
                title="Engenharia de telecomunicações de ponta a ponta"
                description="Do site survey à entrega do as-built, executamos serviços críticos com segurança, conformidade e rastreabilidade."
            />

            <div class="mt-8 flex flex-wrap gap-x-7 gap-y-3 text-xs text-slate-500">
                @foreach(['Cobertura nacional', 'Equipes certificadas', 'Procedimentos EHS', 'Relatórios digitais'] as $item)
                    <span class="flex items-center gap-2">
                        <span class="h-1 w-1 rounded-full bg-compliance-500"></span>
                        {{ $item }}
                    </span>
                @endforeach
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-6 py-20 lg:px-8">
        <div class="grid gap-5 md:grid-cols-2 lg:grid-cols-3">
            @forelse($services as $service)
                <x-site.service-card :service="$service" :index="$loop->iteration" class="reveal" />
            @empty
                <p class="text-sm text-slate-400">Nenhum serviço publicado no momento.</p>
            @endforelse
        </div>
    </section>

    <section class="border-y border-white/5 bg-steel-800/30">
        <div class="mx-auto grid max-w-7xl gap-10 px-6 py-20 lg:grid-cols-2 lg:px-8">
            <x-site.section-heading
                eyebrow="Compromisso técnico"
                title="Conformidade não é diferencial. É requisito."
                description="Cada atividade é conduzida com análise de risco, procedimentos de segurança e evidências que sustentam a auditoria."
            />
            <div class="grid gap-4 sm:grid-cols-2">
                @foreach([
                    ['title' => 'Segurança em campo', 'text' => 'APR, permissões de trabalho e cumprimento integral de EHS e NRs aplicáveis.'],
                    ['title' => 'Qualidade verificável', 'text' => 'Checklists técnicos, inspeções e validação de evidências antes da entrega.'],
                    ['title' => 'Rastreabilidade', 'text' => 'Registro digital de atividades, fotos, medições e histórico por site.'],
                    ['title' => 'Prazos previsíveis', 'text' => 'Planejamento de mobilização e gestão ativa de cronograma e pendências.'],
                ] as $item)
                    <div class="rounded-xl border border-white/10 bg-navy-900/60 p-5">
                        <h3 class="text-sm font-semibold text-white">{{ $item['title'] }}</h3>
                        <p class="mt-2 text-sm leading-6 text-slate-400">{{ $item['text'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <x-site.cta :title="'Precisa de apoio técnico em campo?'" :description="'Conte o escopo, a região e o prazo. Nossa equipe avalia a demanda e retorna com o plano de execução.'" />
</x-layouts.site>
