@php($settings = $siteSettings ?? [])

<x-layouts.site
    title="Portfólio de atuação"
    description="Casos de implantação de ERBs, swap de rede, vistorias técnicas e auditorias de conformidade em infraestrutura de telecomunicações."
>
    <section class="relative overflow-hidden border-b border-stone-200">
        <div class="absolute top-0 right-0 hidden pt-4 pr-8 text-[clamp(8rem,20vw,18rem)] leading-none font-light text-stone-900/[0.04] select-none lg:block" aria-hidden="true">03</div>
        <div class="relative mx-auto max-w-6xl px-4 py-16 md:px-8 md:py-24 lg:py-32">
            <x-site.section-heading
                eyebrow="Portfólio"
                title="Casos reais de engenharia e infraestrutura"
                description="Projetos conduzidos em ambientes de alta criticidade, com foco em segurança, prazo e conformidade técnica."
            />

            <div class="mt-12 grid grid-cols-2 gap-px border border-stone-200 bg-stone-200 sm:grid-cols-4">
                @foreach([
                    ['value' => '1.200+', 'label' => 'Sites vistoriados'],
                    ['value' => '350+', 'label' => 'ERBs implantadas'],
                    ['value' => '18', 'label' => 'Estados atendidos'],
                    ['value' => '99,9%', 'label' => 'SLA operacional'],
                ] as $stat)
                    <div class="bg-stone-50 p-4 md:p-6">
                        <p class="text-xl font-light tracking-tight text-stone-900 tabular-nums md:text-2xl">{{ $stat['value'] }}</p>
                        <p class="mt-1 text-[10px] tracking-widest text-stone-900/60 uppercase">{{ $stat['label'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="border-b border-stone-200">
        <div class="mx-auto max-w-6xl px-4 py-16 md:px-8 md:py-24 lg:py-32">
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3 md:gap-8">
                @forelse($projects as $project)
                    <x-site.project-card :project="$project" class="reveal" />
                @empty
                    <div class="col-span-full border border-stone-200 bg-stone-100 p-10 text-center">
                        <p class="text-sm text-stone-900/60">Nenhum projeto publicado no momento.</p>
                    </div>
                @endforelse
            </div>

            @if($projects->hasPages())
                <div class="mt-12">
                    {{ $projects->links() }}
                </div>
            @endif
        </div>
    </section>

    <x-site.cta :title="'Sua operação pode ser o próximo case'" :description="'Fale com nossa engenharia e estruture a execução do seu projeto de campo.'" />
</x-layouts.site>
