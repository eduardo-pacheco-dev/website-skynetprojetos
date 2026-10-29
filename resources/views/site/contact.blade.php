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
    <section class="relative overflow-hidden border-b border-stone-200">
        <div class="absolute top-0 right-0 hidden pt-4 pr-8 text-[clamp(8rem,20vw,18rem)] leading-none font-light text-stone-900/[0.04] select-none lg:block" aria-hidden="true">05</div>
        <div class="relative mx-auto max-w-6xl px-4 py-16 md:px-8 md:py-24 lg:py-32">
            <x-site.section-heading
                eyebrow="Contato técnico"
                title="Solicite uma vistoria ou orçamento"
                description="Informe o tipo de serviço, a localidade e o prazo. Nossa engenharia analisa a demanda e retorna com um plano objetivo."
            />

            <div class="mt-8 flex flex-wrap gap-x-8 gap-y-3 border-t border-stone-200 pt-6 text-xs text-stone-900/60">
                @foreach(['Resposta em até 1 dia útil', 'Atendimento B2B nacional', 'Escopo técnico confidencial'] as $item)
                    <span class="flex items-center gap-2"><span class="h-1 w-1 bg-accent"></span>{{ $item }}</span>
                @endforeach
            </div>
        </div>
    </section>

    <section class="border-b border-stone-200">
        <div class="mx-auto grid max-w-6xl grid-cols-12 gap-8 px-4 py-16 md:px-8 md:py-24">
            <aside class="col-span-12 space-y-4 lg:col-span-4">
                <div class="border border-stone-200 bg-stone-100 p-6">
                    <h2 class="text-xs font-medium tracking-widest text-stone-900/60 uppercase">Canais corporativos</h2>
                    <dl class="mt-5 border-t border-stone-200">
                        @foreach($contactItems as $item)
                            @if(filled($item['value']))
                                <div class="border-b border-stone-200 py-3">
                                    <dt class="text-[10px] font-medium tracking-widest text-stone-900/60 uppercase">{{ $item['label'] }}</dt>
                                    <dd class="mt-1 text-sm text-stone-900/70">
                                        @if($item['href'])
                                            <a href="{{ $item['href'] }}" @if(str_starts_with($item['href'], 'http')) target="_blank" rel="noopener noreferrer" @endif class="transition-colors hover:text-accent">{{ $item['value'] }}</a>
                                        @else
                                            {{ $item['value'] }}
                                        @endif
                                    </dd>
                                </div>
                            @endif
                        @endforeach
                    </dl>
                </div>

                <div class="border border-stone-200 border-t-2 border-t-accent bg-stone-50 p-6">
                    <h2 class="text-lg font-normal text-stone-900">Atendimento emergencial</h2>
                    <p class="mt-3 text-sm leading-relaxed text-stone-900/60">Para incidentes em sites críticos, acione nossa equipe pelo WhatsApp comercial com o identificador do site e o resumo da ocorrência.</p>
                    @if(filled($whatsapp))
                        <a href="https://wa.me/{{ $whatsapp }}?text={{ rawurlencode('Olá, preciso de atendimento emergencial em um site.') }}" target="_blank" rel="noopener noreferrer" class="mt-5 inline-flex min-h-[44px] w-full items-center justify-center border border-stone-300 px-5 py-3 text-sm font-medium tracking-wide text-stone-900 transition-colors hover:border-stone-900">
                            Acionar WhatsApp
                        </a>
                    @endif
                </div>

                <div class="border border-stone-200 bg-stone-50 p-6">
                    <h2 class="text-xs font-medium tracking-widest text-stone-900/60 uppercase">Como funciona</h2>
                    <ol class="mt-4 border-t border-stone-200">
                        @foreach([
                            'Analisamos o escopo e a localidade.',
                            'Validamos premissas com o time técnico.',
                            'Enviamos proposta e plano de mobilização.',
                        ] as $index => $step)
                            <li class="flex gap-3 border-b border-stone-200 py-3 text-sm leading-relaxed text-stone-900/60">
                                <span class="font-mono text-[11px] font-medium text-accent tabular-nums">0{{ $index + 1 }}</span>
                                {{ $step }}
                            </li>
                        @endforeach
                    </ol>
                </div>
            </aside>

            <div class="col-span-12 lg:col-span-8">
                @if(session('status'))
                    <div class="mb-6 border-l-2 border-accent bg-accent/10 p-4 text-sm text-stone-900" role="status">
                        {{ session('status') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-6 border border-stone-300 bg-stone-100 p-4 text-sm text-stone-900" role="alert">
                        <p class="font-medium">Revise os campos abaixo:</p>
                        <ul class="mt-2 list-inside list-disc space-y-1 text-stone-900/60">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('contact.store') }}" method="POST" class="border border-stone-200 bg-stone-100 p-6 md:p-8">
                    @csrf
                    <div class="hidden" aria-hidden="true">
                        <label for="website">Website</label>
                        <input type="text" id="website" name="website" tabindex="-1" autocomplete="off">
                    </div>

                    <div class="border-b border-stone-200 pb-5">
                        <p class="text-xs font-medium tracking-widest text-stone-900/60 uppercase">Briefing técnico</p>
                        <h2 class="mt-2 text-xl font-normal text-stone-900">Dados da solicitação</h2>
                    </div>

                    <div class="mt-6 grid grid-cols-1 gap-5 sm:grid-cols-2">
                        <div class="flex flex-col gap-2">
                            <label for="name" class="text-xs font-medium tracking-widest text-stone-900/60 uppercase">Nome <span class="text-accent">*</span></label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required autocomplete="name"
                                   @class([
                                       'min-h-[44px] border bg-transparent px-4 py-3 text-base text-stone-900 outline-none transition-colors placeholder:text-stone-900/60 focus:border-stone-900',
                                       'border-accent' => $errors->has('name'),
                                       'border-stone-300' => ! $errors->has('name'),
                                   ])
                                   placeholder="Seu nome">
                            @error('name') <p class="text-xs text-accent">{{ $message }}</p> @enderror
                        </div>

                        <div class="flex flex-col gap-2">
                            <label for="company" class="text-xs font-medium tracking-widest text-stone-900/60 uppercase">Empresa</label>
                            <input type="text" id="company" name="company" value="{{ old('company') }}" autocomplete="organization"
                                   class="min-h-[44px] border border-stone-300 bg-transparent px-4 py-3 text-base text-stone-900 outline-none transition-colors placeholder:text-stone-900/60 focus:border-stone-900"
                                   placeholder="Operadora, torre company ou integrador">
                            @error('company') <p class="text-xs text-accent">{{ $message }}</p> @enderror
                        </div>

                        <div class="flex flex-col gap-2">
                            <label for="email" class="text-xs font-medium tracking-widest text-stone-900/60 uppercase">E-mail corporativo <span class="text-accent">*</span></label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="email"
                                   @class([
                                       'min-h-[44px] border bg-transparent px-4 py-3 text-base text-stone-900 outline-none transition-colors placeholder:text-stone-900/60 focus:border-stone-900',
                                       'border-accent' => $errors->has('email'),
                                       'border-stone-300' => ! $errors->has('email'),
                                   ])
                                   placeholder="voce@empresa.com.br">
                            @error('email') <p class="text-xs text-accent">{{ $message }}</p> @enderror
                        </div>

                        <div class="flex flex-col gap-2">
                            <label for="phone" class="text-xs font-medium tracking-widest text-stone-900/60 uppercase">Telefone / WhatsApp</label>
                            <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" autocomplete="tel"
                                   class="min-h-[44px] border border-stone-300 bg-transparent px-4 py-3 text-base text-stone-900 outline-none transition-colors placeholder:text-stone-900/60 focus:border-stone-900"
                                   placeholder="(11) 99999-0000">
                            @error('phone') <p class="text-xs text-accent">{{ $message }}</p> @enderror
                        </div>

                        <div class="flex flex-col gap-2 sm:col-span-2">
                            <label for="service_interest" class="text-xs font-medium tracking-widest text-stone-900/60 uppercase">Serviço de interesse <span class="text-accent">*</span></label>
                            <select id="service_interest" name="service_interest" required
                                    @class([
                                        'min-h-[44px] border bg-stone-50 px-4 py-3 text-base text-stone-900 outline-none transition-colors focus:border-stone-900',
                                        'border-accent' => $errors->has('service_interest'),
                                        'border-stone-300' => ! $errors->has('service_interest'),
                                    ])>
                                <option value="">Selecione o tipo de serviço</option>
                                @foreach($serviceOptions as $option)
                                    <option value="{{ $option }}" @selected(old('service_interest') === $option)>{{ $option }}</option>
                                @endforeach
                            </select>
                            @error('service_interest') <p class="text-xs text-accent">{{ $message }}</p> @enderror
                        </div>

                        <div class="flex flex-col gap-2 sm:col-span-2">
                            <label for="message" class="text-xs font-medium tracking-widest text-stone-900/60 uppercase">Descrição da demanda <span class="text-accent">*</span></label>
                            <textarea id="message" name="message" rows="6" required
                                      @class([
                                          'resize-y border bg-transparent px-4 py-3 text-base text-stone-900 outline-none transition-colors placeholder:text-stone-900/60 focus:border-stone-900',
                                          'border-accent' => $errors->has('message'),
                                          'border-stone-300' => ! $errors->has('message'),
                                      ])
                                      placeholder="Descreva o escopo, a quantidade de sites, a região e o prazo desejado.">{{ old('message') }}</textarea>
                            @error('message') <p class="text-xs text-accent">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="mt-7 flex flex-col items-start justify-between gap-4 border-t border-stone-200 pt-6 sm:flex-row sm:items-center">
                        <p class="max-w-[46ch] text-xs leading-relaxed text-stone-900/60">Seus dados são utilizados exclusivamente para análise e retorno da solicitação técnica.</p>
                        <button type="submit" class="inline-flex min-h-[44px] items-center justify-center gap-2 bg-accent px-6 py-3 text-sm font-medium tracking-wide text-white transition-colors hover:bg-accent/90">
                            Enviar solicitação
                            <svg viewBox="0 0 20 20" fill="none" class="h-4 w-4" aria-hidden="true">
                                <path d="M3 10 17 4l-4 13-3.5-5L3 10Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</x-layouts.site>
