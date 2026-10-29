@php($settings = $siteSettings ?? [])

<x-layouts.site
    title="Serviços"
    description="Vistorias técnicas, implantação de ERBs, projetos de swap, auditorias EHS e manutenção de infraestrutura de telecomunicações."
>
    <section class="relative overflow-hidden border-b border-stone-200">
        <div class="absolute top-0 right-0 hidden pt-4 pr-8 text-[clamp(8rem,20vw,18rem)] leading-none font-light text-stone-900/[0.04] select-none lg:block" aria-hidden="true">02</div>
        <div class="relative mx-auto max-w-6xl px-4 py-16 md:px-8 md:py-24 lg:py-32">
            <x-site.section-heading
                eyebrow="Serviços"
                title="Engenharia de telecomunicações de ponta a ponta"
                description="Do site survey à entrega do as-built, executamos serviços críticos com segurança, conformidade e rastreabilidade."
            />

            <div class="mt-8 flex flex-wrap gap-x-8 gap-y-3 border-t border-stone-200 pt-6 text-xs text-stone-900/60">
                @foreach(['Cobertura nacional', 'Equipes certificadas', 'Procedimentos EHS', 'Relatórios digitais'] as $item)
                    <span class="flex items-center gap-2"><span class="h-1 w-1 bg-accent"></span>{{ $item }}</span>
                @endforeach
            </div>
        </div>
    </section>

    <section class="border-b border-stone-200">
        <div class="mx-auto max-w-6xl px-4 py-16 md:px-8 md:py-24 lg:py-32">
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3 md:gap-8">
                @forelse($services as $service)
                    <x-site.service-card :service="$service" :index="$loop->iteration" class="reveal" />
                @empty
                    <p class="text-sm text-stone-900/60">Nenhum serviço publicado no momento.</p>
                @endforelse
            </div>
        </div>
    </section>

    <section class="border-b border-stone-200 bg-stone-100">
        <div class="mx-auto grid max-w-6xl grid-cols-12 gap-8 px-4 py-16 md:px-8 md:py-24">
            <div class="col-span-12 lg:col-span-5">
                <x-site.section-heading
                    eyebrow="Compromisso técnico"
                    title="Conformidade não é diferencial. É requisito."
                    description="Cada atividade é conduzida com análise de risco, procedimentos de segurança e evidências que sustentam a auditoria."
                />
            </div>
            <div class="col-span-12 grid grid-cols-1 gap-px border border-stone-200 bg-stone-200 sm:grid-cols-2 lg:col-span-7">
                @foreach([
                    ['title' => 'Segurança em campo', 'text' => 'APR, permissões de trabalho e cumprimento integral de EHS e NRs aplicáveis.'],
                    ['title' => 'Qualidade verificável', 'text' => 'Checklists técnicos, inspeções e validação de evidências antes da entrega.'],
                    ['title' => 'Rastreabilidade', 'text' => 'Registro digital de atividades, fotos, medições e histórico por site.'],
                    ['title' => 'Prazos previsíveis', 'text' => 'Planejamento de mobilização e gestão ativa de cronograma e pendências.'],
                ] as $item)
                    <div class="bg-stone-50 p-6 md:p-8">
                        <h3 class="text-base font-medium text-stone-900">{{ $item['title'] }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-stone-900/60">{{ $item['text'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <x-site.cta :title="'Precisa de apoio técnico em campo?'" :description="'Conte o escopo, a região e o prazo. Nossa equipe avalia a demanda e retorna com o plano de execução.'" />
</x-layouts.site>
