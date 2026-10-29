@php
    $settings = $siteSettings ?? [];
    $whatsapp = preg_replace('/\D+/', '', $settings['whatsapp'] ?? '');
    $contactItems = [
        ['label' => 'E-mail comercial', 'value' => $settings['email'] ?? null, 'href' => filled($settings['email'] ?? null) ? 'mailto:'.$settings['email'] : null],
        ['label' => 'Telefone', 'value' => $settings['phone'] ?? null, 'href' => filled($settings['phone'] ?? null) ? 'tel:'.preg_replace('/\D+/', '', $settings['phone']) : null],
        ['label' => 'WhatsApp', 'value' => filled($whatsapp) ? $settings['phone'] : null, 'href' => filled($whatsapp) ? 'https://wa.me/'.$whatsapp : null],
        ['label' => 'Atuação', 'value' => $settings['address'] ?? 'Cobertura nacional', 'href' => null],
    ];
    $serviceOptions = [
        'Vistoria técnica / Site Survey',
        'Implantação de ERB',
        'Projeto de Swap',
        'Auditoria EHS e Qualidade',
        'Manutenção / O&M',
        'Outro escopo técnico',
    ];
@endphp

<x-layouts.site
    title="Solicitar orçamento"
    description="Solicite vistoria técnica, implantação de ERB, swap ou auditoria de conformidade para sua operação de telecomunicações."
>
    <section class="relative overflow-hidden border-b border-white/5">
        <div class="absolute inset-0 bg-grid opacity-50 [mask-image:radial-gradient(ellipse_at_top,black,transparent_75%)]"></div>
        <div class="pointer-events-none absolute -top-24 right-1/3 h-72 w-72 rounded-full bg-technical-500/10 blur-3xl"></div>
        <div class="relative mx-auto max-w-7xl px-6 py-20 lg:px-8 lg:py-24">
            <x-site.section-heading
                eyebrow="Contato técnico"
                title="Solicite uma vistoria ou orçamento"
                description="Informe o tipo de serviço, a localidade e o prazo. Nossa engenharia analisa a demanda e retorna com um plano objetivo."
            />

            <div class="mt-8 flex flex-wrap gap-x-7 gap-y-3 text-xs text-slate-500">
                <span class="flex items-center gap-2"><span class="h-1.5 w-1.5 rounded-full bg-compliance-500"></span> Resposta em até 1 dia útil</span>
                <span class="flex items-center gap-2"><span class="h-1.5 w-1.5 rounded-full bg-compliance-500"></span> Atendimento B2B nacional</span>
                <span class="flex items-center gap-2"><span class="h-1.5 w-1.5 rounded-full bg-compliance-500"></span> Escopo técnico confidencial</span>
            </div>
        </div>
    </section>

    <section class="mx-auto grid max-w-7xl gap-12 px-6 py-20 lg:grid-cols-[380px_1fr] lg:px-8">
        <aside class="space-y-5">
            <div class="rounded-xl border border-white/10 bg-navy-900/60 p-6">
                <h2 class="text-xs font-semibold tracking-[0.16em] text-white uppercase">Canais corporativos</h2>
                <dl class="mt-5 space-y-5">
                    @foreach($contactItems as $item)
                        @if(filled($item['value']))
                            <div>
                                <dt class="text-[10px] font-medium tracking-[0.14em] text-slate-500 uppercase">{{ $item['label'] }}</dt>
                                <dd class="mt-1 text-sm text-slate-300">
                                    @if($item['href'])
                                        <a href="{{ $item['href'] }}" @if(str_starts_with($item['href'], 'http')) target="_blank" rel="noopener noreferrer" @endif class="transition hover:text-technical-400">{{ $item['value'] }}</a>
                                    @else
                                        {{ $item['value'] }}
                                    @endif
                                </dd>
                            </div>
                        @endif
                    @endforeach
                </dl>
            </div>

            <div class="rounded-xl border border-technical-500/25 bg-navy-900 p-6">
                <h2 class="text-lg font-semibold text-white">Atendimento emergencial</h2>
                <p class="mt-3 text-sm leading-6 text-slate-400">Para incidentes em sites críticos, acione nossa equipe pelo WhatsApp comercial com o identificador do site e o resumo da ocorrência.</p>
                @if(filled($whatsapp))
                    <a href="https://wa.me/{{ $whatsapp }}?text={{ rawurlencode('Olá, preciso de atendimento emergencial em um site.') }}" target="_blank" rel="noopener noreferrer" class="mt-5 inline-flex w-full items-center justify-center rounded-lg border border-white/15 bg-white/5 px-5 py-3 text-sm font-semibold text-white transition hover:bg-white/10">
                        Acionar WhatsApp
                    </a>
                @endif
            </div>

            <div class="rounded-xl border border-white/10 bg-navy-900/60 p-6">
                <h2 class="text-xs font-semibold tracking-[0.16em] text-white uppercase">Como funciona</h2>
                <ol class="mt-4 space-y-3">
                    @foreach([
                        'Analisamos o escopo e a localidade.',
                        'Validamos premissas com o time técnico.',
                        'Enviamos proposta e plano de mobilização.',
                    ] as $index => $step)
                        <li class="flex gap-3 text-sm leading-6 text-slate-400">
                            <span class="font-mono text-[11px] font-semibold text-technical-400">0{{ $index + 1 }}</span>
                            {{ $step }}
                        </li>
                    @endforeach
                </ol>
            </div>
        </aside>

        <div>
            @if(session('status'))
                <div class="mb-6 flex items-start gap-3 rounded-xl border border-compliance-500/30 bg-compliance-500/10 p-4 text-sm text-compliance-400" role="status">
                    <svg viewBox="0 0 20 20" fill="none" class="mt-0.5 h-5 w-5 shrink-0" aria-hidden="true">
                        <path d="m4 10.5 4 4 8-9" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    {{ session('status') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-6 rounded-xl border border-rose-400/30 bg-rose-400/10 p-4 text-sm text-rose-200" role="alert">
                    <p class="font-semibold">Revise os campos abaixo:</p>
                    <ul class="mt-2 list-inside list-disc space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('contact.store') }}" method="POST" class="rounded-2xl border border-white/10 bg-navy-900/60 p-6 sm:p-8">
                @csrf
                <div class="hidden" aria-hidden="true">
                    <label for="website">Website</label>
                    <input type="text" id="website" name="website" tabindex="-1" autocomplete="off">
                </div>

                <div class="mb-6 border-b border-white/10 pb-5">
                    <p class="technical-label">Briefing técnico</p>
                    <h2 class="mt-2 text-xl font-semibold text-white">Dados da solicitação</h2>
                </div>

                <div class="grid gap-5 sm:grid-cols-2">
                    <div>
                        <label for="name" class="mb-2 block text-sm font-medium text-slate-200">Nome <span class="text-technical-400">*</span></label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required autocomplete="name"
                               @class([
                                   'w-full rounded-lg border bg-navy-950 px-4 py-3 text-sm text-white placeholder-slate-600 outline-none transition focus:border-technical-500/60 focus:ring-2 focus:ring-technical-500/20',
                                   'border-rose-400/50' => $errors->has('name'),
                                   'border-white/10' => ! $errors->has('name'),
                               ])
                               placeholder="Seu nome">
                        @error('name') <p class="mt-1.5 text-xs text-rose-300">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="company" class="mb-2 block text-sm font-medium text-slate-200">Empresa</label>
                        <input type="text" id="company" name="company" value="{{ old('company') }}" autocomplete="organization"
                               class="w-full rounded-lg border border-white/10 bg-navy-950 px-4 py-3 text-sm text-white placeholder-slate-600 outline-none transition focus:border-technical-500/60 focus:ring-2 focus:ring-technical-500/20"
                               placeholder="Operadora, torre company ou integrador">
                        @error('company') <p class="mt-1.5 text-xs text-rose-300">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="email" class="mb-2 block text-sm font-medium text-slate-200">E-mail corporativo <span class="text-technical-400">*</span></label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="email"
                               @class([
                                   'w-full rounded-lg border bg-navy-950 px-4 py-3 text-sm text-white placeholder-slate-600 outline-none transition focus:border-technical-500/60 focus:ring-2 focus:ring-technical-500/20',
                                   'border-rose-400/50' => $errors->has('email'),
                                   'border-white/10' => ! $errors->has('email'),
                               ])
                               placeholder="voce@empresa.com.br">
                        @error('email') <p class="mt-1.5 text-xs text-rose-300">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="phone" class="mb-2 block text-sm font-medium text-slate-200">Telefone / WhatsApp</label>
                        <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" autocomplete="tel"
                               class="w-full rounded-lg border border-white/10 bg-navy-950 px-4 py-3 text-sm text-white placeholder-slate-600 outline-none transition focus:border-technical-500/60 focus:ring-2 focus:ring-technical-500/20"
                               placeholder="(11) 99999-0000">
                        @error('phone') <p class="mt-1.5 text-xs text-rose-300">{{ $message }}</p> @enderror
                    </div>

                    <div class="sm:col-span-2">
                        <label for="service_interest" class="mb-2 block text-sm font-medium text-slate-200">Serviço de interesse <span class="text-technical-400">*</span></label>
                        <select id="service_interest" name="service_interest" required
                                @class([
                                    'w-full rounded-lg border bg-navy-950 px-4 py-3 text-sm text-white outline-none transition focus:border-technical-500/60 focus:ring-2 focus:ring-technical-500/20',
                                    'border-rose-400/50' => $errors->has('service_interest'),
                                    'border-white/10' => ! $errors->has('service_interest'),
                                ])>
                            <option value="" class="bg-navy-950">Selecione o tipo de serviço</option>
                            @foreach($serviceOptions as $option)
                                <option value="{{ $option }}" @selected(old('service_interest') === $option) class="bg-navy-950">{{ $option }}</option>
                            @endforeach
                        </select>
                        @error('service_interest') <p class="mt-1.5 text-xs text-rose-300">{{ $message }}</p> @enderror
                    </div>

                    <div class="sm:col-span-2">
                        <label for="message" class="mb-2 block text-sm font-medium text-slate-200">Descrição da demanda <span class="text-technical-400">*</span></label>
                        <textarea id="message" name="message" rows="6" required
                                  @class([
                                      'w-full resize-y rounded-lg border bg-navy-950 px-4 py-3 text-sm text-white placeholder-slate-600 outline-none transition focus:border-technical-500/60 focus:ring-2 focus:ring-technical-500/20',
                                      'border-rose-400/50' => $errors->has('message'),
                                      'border-white/10' => ! $errors->has('message'),
                                  ])
                                  placeholder="Descreva o escopo, a quantidade de sites, a região e o prazo desejado.">{{ old('message') }}</textarea>
                        @error('message') <p class="mt-1.5 text-xs text-rose-300">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="mt-7 flex flex-col items-start justify-between gap-4 border-t border-white/10 pt-6 sm:flex-row sm:items-center">
                    <p class="max-w-sm text-xs leading-5 text-slate-500">Seus dados são utilizados exclusivamente para análise e retorno da solicitação técnica.</p>
                    <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-lg bg-technical-500 px-6 py-3.5 text-sm font-bold text-navy-950 transition hover:bg-technical-400">
                        Enviar solicitação
                        <svg viewBox="0 0 20 20" fill="none" class="h-4 w-4" aria-hidden="true">
                            <path d="M3 10 17 4l-4 13-3.5-5L3 10Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </section>
</x-layouts.site>
