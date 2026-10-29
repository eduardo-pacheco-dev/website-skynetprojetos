@php($settings = $siteSettings ?? [])

<x-layouts.site :title="$service->title" :description="$service->summary">
    <section class="relative overflow-hidden border-b border-white/5">
        <div class="absolute inset-0 bg-grid opacity-30 [mask-image:radial-gradient(ellipse_at_top,black,transparent_70%)]"></div>
        <div class="pointer-events-none absolute -top-24 right-1/4 h-72 w-72 rounded-full bg-cyan-500/15 blur-3xl"></div>
        <div class="relative mx-auto max-w-7xl px-6 py-16 lg:px-8 lg:py-20">
            <nav class="flex items-center gap-2 text-xs text-slate-500" aria-label="Trilha de navegação">
                <a href="{{ route('home') }}" class="transition hover:text-cyan-300">Início</a>
                <span>/</span>
                <a href="{{ route('services.index') }}" class="transition hover:text-cyan-300">Serviços</a>
                <span>/</span>
                <span class="text-slate-300">{{ $service->title }}</span>
            </nav>

            <div class="mt-8 flex flex-col gap-6 sm:flex-row sm:items-start">
                <div class="inline-flex h-16 w-16 shrink-0 items-center justify-center rounded-2xl border border-cyan-400/20 bg-cyan-400/10 text-cyan-300">
                    <x-site.service-icon :name="$service->icon" class="h-8 w-8" />
                </div>
                <div>
                    <h1 class="max-w-3xl text-4xl font-bold tracking-tight text-white sm:text-5xl">{{ $service->title }}</h1>
                    <p class="mt-4 max-w-3xl text-lg leading-8 text-slate-400">{{ $service->summary }}</p>
                </div>
            </div>
        </div>
    </section>

    <section class="mx-auto grid max-w-7xl gap-12 px-6 py-20 lg:grid-cols-[1fr_360px] lg:px-8">
        <article class="prose-invert max-w-none">
            <h2 class="text-2xl font-bold text-white">Como podemos ajudar</h2>
            <div class="mt-6 space-y-5 text-base leading-8 text-slate-400">
                @if($service->description)
                    <p>{!! nl2br(e($service->description)) !!}</p>
                @else
                    <p>{{ $service->summary }}</p>
                @endif
            </div>

            <div class="mt-12 rounded-2xl border border-white/10 bg-white/[0.03] p-6">
                <h3 class="text-lg font-semibold text-white">Nosso compromisso com cada projeto</h3>
                <ul class="mt-5 grid gap-3 sm:grid-cols-2">
                    @foreach([
                        'Comunicação transparente durante todo o processo',
                        'Entregas incrementais e prazos realistas',
                        'Código limpo, testado e documentado',
                        'Suporte próximo após o lançamento',
                    ] as $commitment)
                        <li class="flex items-start gap-2.5 text-sm text-slate-300">
                            <svg viewBox="0 0 20 20" fill="none" class="mt-0.5 h-4 w-4 shrink-0 text-cyan-300" aria-hidden="true">
                                <path d="m4 10.5 4 4 8-9" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            {{ $commitment }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </article>

        <aside class="space-y-6">
            <div class="rounded-2xl border border-cyan-400/20 bg-gradient-to-br from-cyan-500/10 to-violet-500/5 p-6">
                <h2 class="text-lg font-semibold text-white">Quer tirar esse projeto do papel?</h2>
                <p class="mt-3 text-sm leading-6 text-slate-300">Conte sua necessidade e receba uma proposta personalizada em poucos dias.</p>
                <a href="{{ route('contact.create') }}" class="mt-5 inline-flex w-full items-center justify-center rounded-xl bg-gradient-to-r from-cyan-400 to-sky-500 px-5 py-3 text-sm font-semibold text-slate-950 transition hover:brightness-110">
                    Solicitar orçamento
                </a>
                @if(filled($settings['whatsapp'] ?? null))
                    <a href="https://wa.me/{{ preg_replace('/\D+/', '', $settings['whatsapp']) }}" target="_blank" rel="noopener noreferrer" class="mt-3 inline-flex w-full items-center justify-center rounded-xl border border-white/15 bg-white/5 px-5 py-3 text-sm font-semibold text-white transition hover:bg-white/10">
                        Falar no WhatsApp
                    </a>
                @endif
            </div>

            @if($otherServices->isNotEmpty())
                <div class="rounded-2xl border border-white/10 bg-white/[0.02] p-6">
                    <h2 class="text-sm font-semibold tracking-wide text-white uppercase">Outros serviços</h2>
                    <ul class="mt-4 space-y-3">
                        @foreach($otherServices as $otherService)
                            <li>
                                <a href="{{ route('services.show', $otherService) }}" class="group flex items-center justify-between gap-3 text-sm text-slate-400 transition hover:text-cyan-300">
                                    {{ $otherService->title }}
                                    <svg viewBox="0 0 20 20" fill="none" class="h-4 w-4 shrink-0 transition group-hover:translate-x-1" aria-hidden="true">
                                        <path d="M4 10h12m-4-4 4 4-4 4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </aside>
    </section>
</x-layouts.site>
