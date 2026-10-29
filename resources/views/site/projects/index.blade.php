@php($settings = $siteSettings ?? [])

<x-layouts.site
    title="Portfólio de atuação"
    description="Casos de implantação de ERBs, swap de rede, vistorias técnicas e auditorias de conformidade em infraestrutura de telecomunicações."
>
    <section class="relative overflow-hidden border-b border-white/5">
        <div class="absolute inset-0 bg-grid opacity-50 [mask-image:radial-gradient(ellipse_at_top,black,transparent_75%)]"></div>
        <div class="pointer-events-none absolute -top-24 right-1/4 h-72 w-72 rounded-full bg-technical-500/10 blur-3xl"></div>
        <div class="relative mx-auto max-w-7xl px-6 py-20 lg:px-8 lg:py-24">
            <x-site.section-heading
                eyebrow="Portfólio"
                title="Casos reais de engenharia e infraestrutura"
                description="Projetos conduzidos em ambientes de alta criticidade, com foco em segurança, prazo e conformidade técnica."
            />

            <div class="mt-10 grid max-w-3xl grid-cols-2 gap-4 sm:grid-cols-4">
                @foreach([
                    ['value' => '1.200+', 'label' => 'Sites vistoriados'],
                    ['value' => '350+', 'label' => 'ERBs implantadas'],
                    ['value' => '18', 'label' => 'Estados atendidos'],
                    ['value' => '99,9%', 'label' => 'SLA operacional'],
                ] as $stat)
                    <div class="border-l border-technical-500/30 pl-4">
                        <p class="text-xl font-bold text-white">{{ $stat['value'] }}</p>
                        <p class="mt-1 text-[10px] tracking-wide text-slate-500 uppercase">{{ $stat['label'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-6 py-20 lg:px-8">
        <div class="grid gap-5 md:grid-cols-2 lg:grid-cols-3">
            @forelse($projects as $project)
                <x-site.project-card :project="$project" class="reveal" />
            @empty
                <div class="col-span-full rounded-xl border border-white/10 bg-navy-900/60 p-10 text-center">
                    <p class="text-sm text-slate-400">Nenhum projeto publicado no momento.</p>
                </div>
            @endforelse
        </div>

        @if($projects->hasPages())
            <div class="mt-12">
                {{ $projects->links() }}
            </div>
        @endif
    </section>

    <x-site.cta :title="'Sua operação pode ser o próximo case'" :description="'Fale com nossa engenharia e estruture a execução do seu projeto de campo.'" />
</x-layouts.site>
