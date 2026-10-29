@php
    $settings = $siteSettings ?? [];
    $heroTitle = $settings['hero_title'] ?? 'Transformamos ideias em software que gera resultados';
    $heroSubtitle = $settings['hero_subtitle'] ?? 'Desenvolvemos sites, sistemas e aplicações web sob medida, com foco em performance, segurança e experiência do usuário.';
    $stats = [
        ['value' => $settings['stat_projects'] ?? '80', 'suffix' => '+', 'label' => 'Projetos entregues'],
        ['value' => $settings['stat_clients'] ?? '40', 'suffix' => '+', 'label' => 'Clientes atendidos'],
        ['value' => $settings['stat_years'] ?? '10', 'suffix' => ' anos', 'label' => 'De experiência'],
    ];
@endphp

<x-layouts.site :description="$heroSubtitle">
    <section class="relative overflow-hidden">
        <div class="absolute inset-0 bg-grid opacity-40 [mask-image:radial-gradient(ellipse_at_top,black,transparent_75%)]"></div>
        <div class="pointer-events-none absolute -top-32 left-1/4 h-96 w-96 rounded-full bg-cyan-500/20 blur-3xl"></div>
        <div class="pointer-events-none absolute top-20 right-0 h-96 w-96 rounded-full bg-violet-500/15 blur-3xl"></div>

        <div class="relative mx-auto grid max-w-7xl items-center gap-16 px-6 py-20 lg:grid-cols-2 lg:px-8 lg:py-28">
            <div class="reveal">
                <span class="inline-flex items-center gap-2 rounded-full border border-cyan-400/20 bg-cyan-400/5 px-3 py-1.5 text-xs font-semibold tracking-wide text-cyan-300">
                    <span class="relative flex h-2 w-2">
                        <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-cyan-400 opacity-60"></span>
                        <span class="relative inline-flex h-2 w-2 rounded-full bg-cyan-400"></span>
                    </span>
                    Software house · soluções sob medida
                </span>

                <h1 class="mt-6 text-4xl font-bold tracking-tight text-white sm:text-5xl lg:text-6xl">
                    {{ $heroTitle }}
                </h1>

                <p class="mt-6 max-w-xl text-lg leading-8 text-slate-400">
                    {{ $heroSubtitle }}
                </p>

                <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                    <a href="{{ route('contact.create') }}" class="inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-cyan-400 to-sky-500 px-6 py-3.5 text-sm font-semibold text-slate-950 shadow-lg shadow-cyan-500/25 transition hover:brightness-110">
                        Começar um projeto
                        <svg viewBox="0 0 20 20" fill="none" class="h-4 w-4" aria-hidden="true">
                            <path d="M4 10h12m-4-4 4 4-4 4" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                    <a href="{{ route('projects.index') }}" class="inline-flex items-center justify-center rounded-xl border border-white/15 bg-white/5 px-6 py-3.5 text-sm font-semibold text-white transition hover:bg-white/10">
                        Conhecer o portfólio
                    </a>
                </div>

                <dl class="mt-12 grid max-w-lg grid-cols-3 gap-6">
                    @foreach($stats as $stat)
                        <div>
                            <dt class="text-3xl font-bold text-white">{{ $stat['value'] }}<span class="text-cyan-300">{{ $stat['suffix'] }}</span></dt>
                            <dd class="mt-1 text-xs leading-5 text-slate-500">{{ $stat['label'] }}</dd>
                        </div>
                    @endforeach
                </dl>
            </div>

            <div class="reveal relative hidden lg:block">
                <div class="absolute -inset-8 rounded-[2rem] bg-gradient-to-tr from-cyan-500/20 via-sky-500/5 to-violet-500/20 blur-3xl"></div>
                <div class="relative overflow-hidden rounded-3xl border border-white/10 bg-[#081120]/90 shadow-2xl shadow-black/40">
                    <div class="flex items-center gap-2 border-b border-white/5 px-5 py-4">
                        <span class="h-2.5 w-2.5 rounded-full bg-rose-400/70"></span>
                        <span class="h-2.5 w-2.5 rounded-full bg-amber-400/70"></span>
                        <span class="h-2.5 w-2.5 rounded-full bg-emerald-400/70"></span>
                        <span class="ml-3 font-mono text-xs text-slate-500">skynet/projetos</span>
                    </div>
                    <pre class="overflow-x-auto p-6 font-mono text-[13px] leading-7 text-slate-400"><code><span class="text-violet-300">namespace</span> SkyNet\Projetos;

<span class="text-violet-300">class</span> <span class="text-cyan-300">Projeto</span> <span class="text-violet-300">extends</span> Solucao
{
    <span class="text-violet-300">public function</span> <span class="text-sky-300">entregar</span>(): Resultado
    {
        <span class="text-violet-300">return</span> <span class="text-cyan-300">Sofisticacao</span>::<span class="text-sky-300">maxima</span>()
            -&gt;<span class="text-sky-300">com</span>(<span class="text-amber-300">'performance'</span>)
            -&gt;<span class="text-sky-300">com</span>(<span class="text-amber-300">'seguranca'</span>)
            -&gt;<span class="text-sky-300">para</span>(<span class="text-emerald-300">cliente</span>: <span class="text-amber-300">'você'</span>);
    }
}</code></pre>
                    <div class="grid grid-cols-3 gap-px border-t border-white/5 bg-white/5">
                        <div class="bg-[#081120] px-5 py-4 text-center">
                            <p class="text-lg font-bold text-white">99,9%</p>
                            <p class="mt-1 text-[10px] tracking-wide text-slate-500 uppercase">Uptime</p>
                        </div>
                        <div class="bg-[#081120] px-5 py-4 text-center">
                            <p class="text-lg font-bold text-white">100%</p>
                            <p class="mt-1 text-[10px] tracking-wide text-slate-500 uppercase">Código próprio</p>
                        </div>
                        <div class="bg-[#081120] px-5 py-4 text-center">
                            <p class="text-lg font-bold text-white">24/7</p>
                            <p class="mt-1 text-[10px] tracking-wide text-slate-500 uppercase">Monitoramento</p>
                        </div>
                    </div>
                </div>

                <div class="absolute -bottom-8 -left-8 rounded-2xl border border-cyan-400/20 bg-[#081120]/95 px-5 py-4 shadow-xl">
                    <p class="text-xs text-slate-400">Deploy concluído</p>
                    <p class="mt-1 flex items-center gap-2 text-sm font-semibold text-emerald-300">
                        <span class="h-2 w-2 rounded-full bg-emerald-400"></span>
                        em produção há 2 min
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-6 py-20 lg:px-8">
        <div class="flex flex-col justify-between gap-6 sm:flex-row sm:items-end">
            <x-site.section-heading
                eyebrow="O que fazemos"
                title="Soluções digitais de ponta a ponta"
                description="Do primeiro rascunho à operação em produção: estratégia, desenvolvimento e evolução contínua."
            />
            <a href="{{ route('services.index') }}" class="shrink-0 text-sm font-semibold text-cyan-300 transition hover:text-cyan-200">
                Ver todos os serviços →
            </a>
        </div>

        <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($services as $service)
                <x-site.service-card :service="$service" class="reveal" />
            @endforeach
        </div>
    </section>

    <section class="border-y border-white/5 bg-white/[0.015]">
        <div class="mx-auto max-w-7xl px-6 py-20 lg:px-8">
            <div class="flex flex-col justify-between gap-6 sm:flex-row sm:items-end">
                <x-site.section-heading
                    eyebrow="Portfólio"
                    title="Projetos em destaque"
                    description="Alguns dos produtos que ajudamos a construir e evoluir."
                />
                <a href="{{ route('projects.index') }}" class="shrink-0 text-sm font-semibold text-cyan-300 transition hover:text-cyan-200">
                    Ver todos os projetos →
                </a>
            </div>

            <div class="mt-12 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @forelse($featuredProjects as $project)
                    <x-site.project-card :project="$project" class="reveal" />
                @empty
                    <p class="text-sm text-slate-400">Novos projetos em breve.</p>
                @endforelse
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-6 py-20 lg:px-8">
        <x-site.section-heading
            eyebrow="Como trabalhamos"
            title="Um processo claro, do início ao lançamento"
            description="Metodologia enxuta, comunicação próxima e entregas incrementais para você acompanhar cada etapa."
            align="center"
        />

        <div class="mt-14 grid gap-6 md:grid-cols-2 lg:grid-cols-4">
            @foreach([
                ['step' => '01', 'title' => 'Descoberta', 'text' => 'Entendemos o negócio, o público e os objetivos antes de escrever a primeira linha de código.'],
                ['step' => '02', 'title' => 'Planejamento', 'text' => 'Definimos escopo, arquitetura e prioridades em um plano de execução realista.'],
                ['step' => '03', 'title' => 'Desenvolvimento', 'text' => 'Entregas frequentes, testes automatizados e revisões contínuas com você.'],
                ['step' => '04', 'title' => 'Evolução', 'text' => 'Publicação, monitoramento e melhorias contínuas para o produto crescer.'],
            ] as $item)
                <div class="reveal relative rounded-2xl border border-white/10 bg-white/[0.03] p-6">
                    <span class="text-xs font-bold tracking-[0.2em] text-cyan-300">{{ $item['step'] }}</span>
                    <h3 class="mt-4 text-lg font-semibold text-white">{{ $item['title'] }}</h3>
                    <p class="mt-3 text-sm leading-6 text-slate-400">{{ $item['text'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-6 pb-10 lg:px-8">
        <div class="rounded-3xl border border-white/10 bg-white/[0.02] px-6 py-10">
            <p class="text-center text-xs font-semibold tracking-[0.2em] text-slate-500 uppercase">Tecnologias que dominamos</p>
            <div class="mt-6 flex flex-wrap items-center justify-center gap-3">
                @foreach(['Laravel', 'PHP 8', 'Livewire', 'Tailwind CSS', 'Vue.js', 'React', 'MySQL', 'PostgreSQL', 'Redis', 'Docker', 'AWS', 'Filament'] as $technology)
                    <span class="rounded-lg border border-white/10 bg-white/[0.03] px-3 py-1.5 text-xs font-medium text-slate-300">{{ $technology }}</span>
                @endforeach
            </div>
        </div>
    </section>

    <x-site.cta />
</x-layouts.site>
