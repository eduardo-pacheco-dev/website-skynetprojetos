@php
    $settings = $siteSettings ?? [];
    $whatsapp = preg_replace('/\D+/', '', $settings['whatsapp'] ?? '');
    $contactItems = [
        ['label' => 'E-mail', 'value' => $settings['email'] ?? null, 'href' => filled($settings['email'] ?? null) ? 'mailto:'.$settings['email'] : null],
        ['label' => 'Telefone', 'value' => $settings['phone'] ?? null, 'href' => filled($settings['phone'] ?? null) ? 'tel:'.preg_replace('/\D+/', '', $settings['phone']) : null],
        ['label' => 'WhatsApp', 'value' => filled($whatsapp) ? $settings['phone'] : null, 'href' => filled($whatsapp) ? 'https://wa.me/'.$whatsapp : null],
        ['label' => 'Localização', 'value' => $settings['address'] ?? null, 'href' => null],
    ];
@endphp

<x-layouts.site
    title="Contato"
    description="Fale com a SkyNet Projetos e solicite um orçamento para seu site, sistema ou aplicativo."
>
    <section class="relative overflow-hidden border-b border-white/5">
        <div class="absolute inset-0 bg-grid opacity-30 [mask-image:radial-gradient(ellipse_at_top,black,transparent_70%)]"></div>
        <div class="pointer-events-none absolute -top-24 right-1/3 h-72 w-72 rounded-full bg-cyan-500/15 blur-3xl"></div>
        <div class="relative mx-auto max-w-7xl px-6 py-20 lg:px-8">
            <x-site.section-heading
                eyebrow="Contato"
                title="Vamos construir algo juntos?"
                description="Preencha o formulário e conte um pouco sobre o seu projeto. Respondemos em até um dia útil."
            />
        </div>
    </section>

    <section class="mx-auto grid max-w-7xl gap-12 px-6 py-20 lg:grid-cols-[380px_1fr] lg:px-8">
        <aside class="space-y-6">
            <div class="rounded-2xl border border-white/10 bg-white/[0.03] p-6">
                <h2 class="text-sm font-semibold tracking-wide text-white uppercase">Canais de atendimento</h2>
                <dl class="mt-5 space-y-5">
                    @foreach($contactItems as $item)
                        @if(filled($item['value']))
                            <div>
                                <dt class="text-xs font-medium tracking-wide text-slate-500 uppercase">{{ $item['label'] }}</dt>
                                <dd class="mt-1 text-sm text-slate-300">
                                    @if($item['href'])
                                        <a href="{{ $item['href'] }}" @if(str_starts_with($item['href'], 'http')) target="_blank" rel="noopener noreferrer" @endif class="transition hover:text-cyan-300">{{ $item['value'] }}</a>
                                    @else
                                        {{ $item['value'] }}
                                    @endif
                                </dd>
                            </div>
                        @endif
                    @endforeach
                </dl>
            </div>

            <div class="rounded-2xl border border-cyan-400/20 bg-gradient-to-br from-cyan-500/10 to-violet-500/5 p-6">
                <h2 class="text-lg font-semibold text-white">Prefere conversar?</h2>
                <p class="mt-3 text-sm leading-6 text-slate-300">Agende uma call de 30 minutos para entender seu desafio e mapear possibilidades.</p>
                @if(filled($whatsapp))
                    <a href="https://wa.me/{{ $whatsapp }}" target="_blank" rel="noopener noreferrer" class="mt-5 inline-flex w-full items-center justify-center rounded-xl border border-white/15 bg-white/5 px-5 py-3 text-sm font-semibold text-white transition hover:bg-white/10">
                        Chamar no WhatsApp
                    </a>
                @endif
            </div>
        </aside>

        <div>
            @if(session('status'))
                <div class="mb-6 flex items-start gap-3 rounded-2xl border border-emerald-400/30 bg-emerald-400/10 p-4 text-sm text-emerald-200" role="status">
                    <svg viewBox="0 0 20 20" fill="none" class="mt-0.5 h-5 w-5 shrink-0" aria-hidden="true">
                        <path d="m4 10.5 4 4 8-9" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    {{ session('status') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-6 rounded-2xl border border-rose-400/30 bg-rose-400/10 p-4 text-sm text-rose-200" role="alert">
                    <p class="font-semibold">Revise os campos abaixo:</p>
                    <ul class="mt-2 list-inside list-disc space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('contact.store') }}" method="POST" class="rounded-3xl border border-white/10 bg-white/[0.03] p-6 sm:p-8">
                @csrf
                <div class="hidden" aria-hidden="true">
                    <label for="website">Website</label>
                    <input type="text" id="website" name="website" tabindex="-1" autocomplete="off">
                </div>

                <div class="grid gap-5 sm:grid-cols-2">
                    <div>
                        <label for="name" class="mb-2 block text-sm font-medium text-slate-200">Nome <span class="text-cyan-300">*</span></label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required autocomplete="name"
                               @class([
                                   'w-full rounded-xl border bg-[#081120] px-4 py-3 text-sm text-white placeholder-slate-500 outline-none transition focus:border-cyan-400/60 focus:ring-2 focus:ring-cyan-400/20',
                                   'border-rose-400/50' => $errors->has('name'),
                                   'border-white/10' => ! $errors->has('name'),
                               ])
                               placeholder="Seu nome completo">
                        @error('name') <p class="mt-1.5 text-xs text-rose-300">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="email" class="mb-2 block text-sm font-medium text-slate-200">E-mail <span class="text-cyan-300">*</span></label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="email"
                               @class([
                                   'w-full rounded-xl border bg-[#081120] px-4 py-3 text-sm text-white placeholder-slate-500 outline-none transition focus:border-cyan-400/60 focus:ring-2 focus:ring-cyan-400/20',
                                   'border-rose-400/50' => $errors->has('email'),
                                   'border-white/10' => ! $errors->has('email'),
                               ])
                               placeholder="voce@empresa.com">
                        @error('email') <p class="mt-1.5 text-xs text-rose-300">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="phone" class="mb-2 block text-sm font-medium text-slate-200">Telefone</label>
                        <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" autocomplete="tel"
                               class="w-full rounded-xl border border-white/10 bg-[#081120] px-4 py-3 text-sm text-white placeholder-slate-500 outline-none transition focus:border-cyan-400/60 focus:ring-2 focus:ring-cyan-400/20"
                               placeholder="(11) 99999-0000">
                        @error('phone') <p class="mt-1.5 text-xs text-rose-300">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="subject" class="mb-2 block text-sm font-medium text-slate-200">Assunto <span class="text-cyan-300">*</span></label>
                        <input type="text" id="subject" name="subject" value="{{ old('subject') }}" required
                               @class([
                                   'w-full rounded-xl border bg-[#081120] px-4 py-3 text-sm text-white placeholder-slate-500 outline-none transition focus:border-cyan-400/60 focus:ring-2 focus:ring-cyan-400/20',
                                   'border-rose-400/50' => $errors->has('subject'),
                                   'border-white/10' => ! $errors->has('subject'),
                               ])
                               placeholder="Como podemos ajudar?">
                        @error('subject') <p class="mt-1.5 text-xs text-rose-300">{{ $message }}</p> @enderror
                    </div>

                    <div class="sm:col-span-2">
                        <label for="message" class="mb-2 block text-sm font-medium text-slate-200">Mensagem <span class="text-cyan-300">*</span></label>
                        <textarea id="message" name="message" rows="6" required
                                  @class([
                                      'w-full resize-y rounded-xl border bg-[#081120] px-4 py-3 text-sm text-white placeholder-slate-500 outline-none transition focus:border-cyan-400/60 focus:ring-2 focus:ring-cyan-400/20',
                                      'border-rose-400/50' => $errors->has('message'),
                                      'border-white/10' => ! $errors->has('message'),
                                  ])
                                  placeholder="Conte sobre o seu projeto, objetivos e prazos.">{{ old('message') }}</textarea>
                        @error('message') <p class="mt-1.5 text-xs text-rose-300">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="mt-6 flex flex-col items-start justify-between gap-4 sm:flex-row sm:items-center">
                    <p class="text-xs leading-5 text-slate-500">Seus dados são usados apenas para responder ao contato.</p>
                    <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-cyan-400 to-sky-500 px-6 py-3 text-sm font-semibold text-slate-950 shadow-lg shadow-cyan-500/20 transition hover:brightness-110">
                        Enviar mensagem
                        <svg viewBox="0 0 20 20" fill="none" class="h-4 w-4" aria-hidden="true">
                            <path d="M3 10 17 4l-4 13-3.5-5L3 10Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </section>
</x-layouts.site>
