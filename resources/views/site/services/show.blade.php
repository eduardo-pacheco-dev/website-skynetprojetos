@php($settings = $siteSettings ?? [])

<x-layouts.site :title="$service->title" :description="$service->summary">
    <section class="border-b border-stone-200">
        <div class="mx-auto max-w-6xl px-4 py-16 md:px-8 md:py-24">
            <nav class="flex flex-wrap items-center gap-2 text-xs tracking-wide text-stone-900/60" aria-label="Trilha de navegação">
                <a href="{{ route('home') }}" class="transition-colors hover:text-stone-900">Início</a>
                <span aria-hidden="true">/</span>
                <a href="{{ route('services.index') }}" class="transition-colors hover:text-stone-900">Serviços</a>
                <span aria-hidden="true">/</span>
                <span class="text-stone-900/60">{{ $service->title }}</span>
            </nav>

            <div class="mt-10 flex flex-col gap-6 sm:flex-row sm:items-start">
                <div class="flex h-14 w-14 shrink-0 items-center justify-center border border-stone-300 text-stone-900">
                    <x-site.service-icon :name="$service->icon" class="h-7 w-7" />
                </div>
                <div class="max-w-3xl">
                    <p class="text-xs font-medium tracking-widest text-stone-900/60 uppercase">Serviço de engenharia</p>
                    <h1 class="mt-3 text-4xl leading-tight font-light tracking-tight text-balance text-stone-900 md:text-5xl">{{ $service->title }}</h1>
                    <p class="mt-5 max-w-[60ch] text-base leading-relaxed text-stone-900/60 md:text-lg">{{ $service->summary }}</p>
                </div>
            </div>
        </div>
    </section>

    <section class="border-b border-stone-200">
        <div class="mx-auto grid max-w-6xl grid-cols-12 gap-8 px-4 py-16 md:px-8 md:py-24">
            <article class="col-span-12 lg:col-span-8">
                <h2 class="text-2xl leading-snug font-light tracking-tight text-stone-900">Escopo de atuação</h2>
                <div class="mt-5 max-w-[60ch] space-y-5 text-base leading-relaxed text-pretty text-stone-900/60">
                    @if($service->description)
                        <p>{!! nl2br(e($service->description)) !!}</p>
                    @else
                        <p>{{ $service->summary }}</p>
                    @endif
                </div>

                <div class="mt-12 grid grid-cols-1 gap-px border border-stone-200 bg-stone-200 sm:grid-cols-2">
                    <div class="bg-stone-50 p-6 md:p-8">
                        <h3 class="text-xs font-medium tracking-widest text-stone-900/60 uppercase">Atividades típicas</h3>
                        <ul class="mt-4 space-y-2.5">
                            @foreach([
                                'Planejamento e mobilização de campo',
                                'Execução conforme procedimento do cliente',
                                'Registro fotográfico e coleta de evidências',
                                'Medições, testes e validação técnica',
                                'Tratativa e acompanhamento de pendências',
                                'Emissão de relatório e as-built',
                            ] as $activity)
                                <li class="flex items-start gap-2.5 text-sm leading-relaxed text-stone-900/60">
                                    <span class="mt-2 h-1 w-1 shrink-0 bg-accent"></span>
                                    {{ $activity }}
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="bg-stone-50 p-6 md:p-8">
                        <h3 class="text-xs font-medium tracking-widest text-stone-900/60 uppercase">Entregáveis</h3>
                        <ul class="mt-4 space-y-2.5">
                            @foreach([
                                'Relatório técnico fotográfico',
                                'Checklist de conformidade',
                                'Matriz de pendências e riscos',
                                'Documentação as-built',
                                'Base de dados e evidências digitais',
                                'Recomendações técnicas',
                            ] as $deliverable)
                                <li class="flex items-start gap-2.5 text-sm leading-relaxed text-stone-900/60">
                                    <span class="mt-2 h-1 w-1 shrink-0 bg-accent"></span>
                                    {{ $deliverable }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="mt-8 border-l-2 border-accent bg-stone-100 p-6">
                    <h3 class="text-xs font-medium tracking-widest text-accent uppercase">Segurança e conformidade</h3>
                    <p class="mt-3 max-w-[60ch] text-sm leading-relaxed text-stone-900/60">
                        Execução alinhada a EHS, guias FAM, NR-10, NR-35 e requisitos técnicos de operadoras. Toda atividade é precedida de análise de risco e liberação formal de trabalho.
                    </p>
                </div>
            </article>

            <aside class="col-span-12 space-y-4 lg:col-span-4">
                <div class="border border-stone-200 border-t-2 border-t-accent bg-stone-100 p-6">
                    <h2 class="text-lg font-normal text-stone-900">Solicite uma avaliação técnica</h2>
                    <p class="mt-3 text-sm leading-relaxed text-stone-900/60">Envie o escopo, a localidade e o prazo. Retornamos com uma proposta objetiva.</p>
                    <a href="{{ route('contact.create') }}" class="mt-5 inline-flex min-h-[44px] w-full items-center justify-center bg-accent px-5 py-3 text-sm font-medium tracking-wide text-white transition-colors hover:bg-accent/90">
                        Solicitar orçamento
                    </a>
                    @if(filled($settings['whatsapp'] ?? null))
                        <a href="https://wa.me/{{ preg_replace('/\D+/', '', $settings['whatsapp']) }}" target="_blank" rel="noopener noreferrer" class="mt-2 inline-flex min-h-[44px] w-full items-center justify-center border border-stone-300 px-5 py-3 text-sm font-medium tracking-wide text-stone-900 transition-colors hover:border-stone-900">
                            Falar no WhatsApp
                        </a>
                    @endif
                </div>

                <div class="border border-stone-200 bg-stone-50 p-6">
                    <h2 class="text-xs font-medium tracking-widest text-stone-900/60 uppercase">Aderência técnica</h2>
                    <div class="mt-4 flex flex-wrap gap-2">
                        @foreach(['EHS', 'FAM', 'NR-10', 'NR-35', '4G/5G'] as $badge)
                            <span class="border border-stone-300 px-2.5 py-1 font-mono text-[10px] tracking-widest text-stone-900/60">{{ $badge }}</span>
                        @endforeach
                    </div>
                </div>

                @if($otherServices->isNotEmpty())
                    <div class="border border-stone-200 bg-stone-50 p-6">
                        <h2 class="text-xs font-medium tracking-widest text-stone-900/60 uppercase">Outros serviços</h2>
                        <ul class="mt-4 border-t border-stone-200">
                            @foreach($otherServices as $otherService)
                                <li>
                                    <a href="{{ route('services.show', $otherService) }}" class="group flex min-h-[44px] items-center justify-between gap-3 border-b border-stone-200 text-sm text-stone-900/60 transition-colors hover:text-stone-900">
                                        {{ $otherService->title }}
                                        <svg viewBox="0 0 20 20" fill="none" class="h-4 w-4 shrink-0 transition-transform duration-200 group-hover:translate-x-1" aria-hidden="true">
                                            <path d="M4 10h12m-4-4 4 4-4 4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </aside>
        </div>
    </section>
</x-layouts.site>
