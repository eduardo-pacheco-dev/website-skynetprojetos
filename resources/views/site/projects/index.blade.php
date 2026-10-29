@php($settings = $siteSettings ?? [])

<x-layouts.site
    title="Projetos"
    description="Conheça os projetos de websites, sistemas e aplicações desenvolvidos pela SkyNet Projetos."
>
    <section class="relative overflow-hidden border-b border-white/5">
        <div class="absolute inset-0 bg-grid opacity-30 [mask-image:radial-gradient(ellipse_at_top,black,transparent_70%)]"></div>
        <div class="pointer-events-none absolute -top-24 right-1/4 h-72 w-72 rounded-full bg-violet-500/15 blur-3xl"></div>
        <div class="relative mx-auto max-w-7xl px-6 py-20 lg:px-8">
            <x-site.section-heading
                eyebrow="Portfólio"
                title="Projetos que geram resultado"
                description="Uma seleção de produtos digitais construídos em parceria com nossos clientes."
            />
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-6 py-20 lg:px-8">
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @forelse($projects as $project)
                <x-site.project-card :project="$project" class="reveal" />
            @empty
                <div class="col-span-full rounded-2xl border border-white/10 bg-white/[0.03] p-10 text-center">
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

    <x-site.cta :title="'Seu próximo projeto pode ser o próximo da lista'" :description="'Vamos construir juntos uma solução que faça diferença para o seu negócio.'" />
</x-layouts.site>
