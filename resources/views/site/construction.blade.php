@php
    $settings = $siteSettings ?? [];
    $siteName = $settings['site_name'] ?? 'Skynet Projetos e Consultoria';
    $email = $settings['email'] ?? 'eduardo@skynetprojetos.com.br';
    $phone = $settings['phone'] ?? '+55 (91) 98438-7990';
    $whatsapp = preg_replace('/\D+/', '', $settings['whatsapp'] ?? '5591984387990');
    $title = $settings['construction_title'] ?? 'Nosso novo site está em construção.';
    $message = $settings['construction_message'] ?? 'Estamos preparando uma nova experiência digital para apresentar nossas soluções em engenharia de telecomunicações, rollout documental e qualidade.';
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="color-scheme" content="light">
    <meta name="robots" content="noindex, nofollow">

    <title>{{ $siteName }} — Em construção</title>
    <meta name="description" content="O novo site da {{ $siteName }} está em construção. Fale com nossa equipe: {{ $email }}.">
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    <meta name="theme-color" content="#f8f9fa">

    @fonts
    @vite(['resources/css/app.css'])
</head>
<body class="min-h-screen bg-canvas font-sans text-ink">
    <a href="#conteudo" class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 focus:z-50 focus:bg-accent focus:px-4 focus:py-2 focus:text-sm focus:font-semibold focus:text-white">
        Ir para o conteúdo
    </a>

    <div class="h-1 w-full bg-accent"></div>

    <div class="flex min-h-[calc(100vh-4px)] flex-col">
        <header class="border-b border-ink/10">
            <div class="mx-auto flex w-full max-w-6xl items-center justify-between gap-6 px-4 py-4 md:px-8">
                <a href="{{ url('/') }}" class="flex min-h-[44px] flex-col justify-center leading-none">
                    <span class="text-base font-bold tracking-tight">Skynet</span>
                    <span class="mt-1.5 text-[9px] font-semibold tracking-[0.22em] text-ink/50 uppercase">Projetos e Consultoria</span>
                </a>

                <div class="hidden items-center gap-6 md:flex">
                    <a href="mailto:{{ $email }}" class="text-xs font-medium text-ink/60 transition-colors hover:text-accent">{{ $email }}</a>
                    <a href="tel:{{ preg_replace('/\D+/', '', $phone) }}" class="text-xs font-medium text-ink/60 transition-colors hover:text-accent">{{ $phone }}</a>
                </div>
            </div>
        </header>

        <main id="conteudo" class="flex-1">
            <section class="relative overflow-hidden border-b border-ink/10">
                <div class="pointer-events-none absolute top-0 right-0 hidden pt-2 pr-6 text-[clamp(8rem,20vw,18rem)] leading-none font-bold text-ink/[0.035] select-none lg:block" aria-hidden="true">
                    2026
                </div>

                <div class="relative mx-auto grid w-full max-w-6xl grid-cols-12 gap-10 px-4 py-16 md:px-8 md:py-24 lg:gap-16">
                    <div class="col-span-12 flex flex-col justify-center lg:col-span-7">
                        <p class="flex items-center gap-3 text-xs font-semibold tracking-[0.2em] text-accent uppercase">
                            <span class="h-1.5 w-1.5 bg-accent"></span>
                            Site em construção
                        </p>

                        <h1 class="mt-8 max-w-[18ch] text-4xl leading-[1.02] font-bold tracking-tight text-balance sm:text-5xl lg:text-6xl">
                            {{ $title }}
                        </h1>

                        <div class="mt-8 h-px w-12 bg-accent"></div>

                        <p class="mt-8 max-w-[56ch] text-base leading-relaxed text-pretty text-ink/60">
                            {{ $message }}
                        </p>

                        <div class="mt-10">
                            <p class="text-[10px] font-semibold tracking-[0.18em] text-ink/40 uppercase">Enquanto isso, fale com nossa equipe</p>
                            <div class="mt-4 flex flex-col gap-3 sm:flex-row">
                                <a href="mailto:{{ $email }}" class="inline-flex min-h-[48px] items-center justify-center gap-2 bg-accent px-6 py-3 text-sm font-semibold tracking-wide text-white transition-colors hover:bg-accent/90">
                                    Enviar e-mail
                                    <svg viewBox="0 0 20 20" fill="none" class="h-4 w-4" aria-hidden="true">
                                        <path d="M4 10h12m-4-4 4 4-4 4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </a>
                                @if(filled($whatsapp))
                                    <a href="https://wa.me/{{ $whatsapp }}?text={{ rawurlencode('Olá, gostaria de falar com a equipe da Skynet.') }}" target="_blank" rel="noopener noreferrer" class="inline-flex min-h-[48px] items-center justify-center border border-ink/20 px-6 py-3 text-sm font-semibold tracking-wide text-ink transition-colors hover:border-accent hover:text-accent">
                                        Chamar no WhatsApp
                                    </a>
                                @endif
                            </div>
                        </div>

                        <dl class="mt-12 grid grid-cols-1 gap-px border border-ink/10 bg-ink/10 sm:grid-cols-3">
                            <div class="bg-canvas p-4">
                                <dt class="text-[9px] font-semibold tracking-[0.16em] text-ink/40 uppercase">E-mail</dt>
                                <dd class="mt-1 text-xs font-medium break-all text-ink">{{ $email }}</dd>
                            </div>
                            <div class="bg-canvas p-4">
                                <dt class="text-[9px] font-semibold tracking-[0.16em] text-ink/40 uppercase">Telefone</dt>
                                <dd class="mt-1 text-xs font-medium text-ink">{{ $phone }}</dd>
                            </div>
                            <div class="bg-canvas p-4">
                                <dt class="text-[9px] font-semibold tracking-[0.16em] text-ink/40 uppercase">Atendimento</dt>
                                <dd class="mt-1 text-xs font-medium text-ink">Cobertura nacional</dd>
                            </div>
                        </dl>
                    </div>

                    <aside class="col-span-12 lg:col-span-5">
                        <div class="relative overflow-hidden border border-ink/10 bg-white p-6 text-ink md:p-8">
                            <div class="flex items-center justify-between gap-4 border-b border-ink/10 pb-4">
                                <span class="text-[10px] font-semibold tracking-[0.18em] text-ink/50 uppercase">Skynet Projetos e Consultoria</span>
                                <span class="flex items-center gap-2 text-[10px] font-semibold tracking-[0.14em] text-ink uppercase">
                                    <span class="h-1.5 w-1.5 bg-accent"></span>
                                    Em breve
                                </span>
                            </div>

                            <div class="relative mt-8 aspect-[5/4]">
                                <p class="sr-only">Mapa esquemático em vista superior de enlaces de rádio entre quatro sites de telecomunicações.</p>

                                <svg viewBox="0 0 400 320" class="absolute inset-0 h-full w-full" fill="none" aria-hidden="true">
                                    <g stroke="rgba(17,24,39,0.08)" stroke-width="1">
                                        <path d="M0 260h400M0 180h400M0 100h400M0 20h400"/>
                                        <path d="M80 0v320M180 0v320M280 0v320M380 0v320"/>
                                    </g>

                                    <g stroke="rgba(17,24,39,0.08)" stroke-width="1" fill="none">
                                        <path d="M-30 72C55 18 120 108 208 66S350 18 440 78"/>
                                        <path d="M-30 292C60 248 120 320 212 286S352 240 440 292"/>
                                        <path d="M-20 122C64 80 122 154 214 118S350 78 430 130"/>
                                    </g>

                                    <g stroke="#111827" stroke-linecap="round">
                                        <path d="M210 146 78 238" stroke-width="1.2" opacity=".55"/>
                                        <path d="M210 146 332 208" stroke="#c8102e" stroke-width="1.6"/>
                                        <path d="M210 146 298 70" stroke-width="1.2" opacity=".55"/>
                                    </g>

                                    <g stroke="#111827" stroke-width="5" stroke-linecap="round" opacity=".08">
                                        <path d="M210 146 332 208"/>
                                        <path d="M210 146 78 238"/>
                                        <path d="M210 146 298 70"/>
                                    </g>

                                    <g stroke="rgba(17,24,39,0.35)" stroke-width="1" stroke-dasharray="3 5">
                                        <path d="M92 226 196 136"/>
                                        <path d="M224 138 318 200"/>
                                        <path d="M220 132 288 80"/>
                                    </g>

                                    <g fill="#111827">
                                        <circle cx="78" cy="238" r="4.5"/>
                                        <circle cx="210" cy="146" r="5.5" fill="#c8102e"/>
                                        <circle cx="332" cy="208" r="4.5"/>
                                        <circle cx="298" cy="70" r="4.5"/>
                                    </g>
                                    <g stroke="rgba(17,24,39,0.45)" stroke-width="1">
                                        <circle cx="78" cy="238" r="11"/>
                                        <circle cx="78" cy="238" r="20" opacity=".35"/>
                                        <circle cx="210" cy="146" r="14"/>
                                        <circle cx="210" cy="146" r="26" opacity=".35"/>
                                        <circle cx="332" cy="208" r="11"/>
                                        <circle cx="332" cy="208" r="20" opacity=".35"/>
                                        <circle cx="298" cy="70" r="11"/>
                                        <circle cx="298" cy="70" r="20" opacity=".35"/>
                                    </g>

                                    <g stroke="#111827" stroke-width="1.4" stroke-linecap="round">
                                        <path d="M78 238l9-10M78 238l11-7"/>
                                        <path d="M210 146l-8-12M210 146l-12-8"/>
                                        <path d="M332 208l-11-8M332 208l-9-11"/>
                                        <path d="M298 70l9 10M298 70l11 7"/>
                                    </g>

                                    <g fill="rgba(17,24,39,0.45)" font-family="Montserrat, sans-serif" font-size="8" font-weight="600" letter-spacing="1">
                                        <text x="46" y="258">A</text>
                                        <text x="46" y="268" font-size="6" opacity=".65">SKY-01</text>
                                        <text x="220" y="128">B</text>
                                        <text x="220" y="138" font-size="6" opacity=".65">HUB</text>
                                        <text x="344" y="226">C</text>
                                        <text x="344" y="236" font-size="6" opacity=".65">SKY-03</text>
                                        <text x="310" y="56">D</text>
                                        <text x="310" y="66" font-size="6" opacity=".65">SKY-04</text>
                                    </g>

                                    <g fill="rgba(17,24,39,0.30)" font-family="Montserrat, sans-serif" font-size="6" font-weight="600" letter-spacing="1">
                                        <text x="122" y="206">ENLACE 01</text>
                                        <text x="262" y="178">ENLACE 02</text>
                                        <text x="240" y="108">ENLACE 03</text>
                                    </g>

                                    <g transform="translate(354 28)" stroke="rgba(17,24,39,0.45)" stroke-width="1">
                                        <circle r="13"/>
                                        <path d="M0-9V9M0-9l-3 5M0-9l3 5"/>
                                        <text x="0" y="-16" text-anchor="middle" fill="rgba(17,24,39,0.45)" stroke="none" font-family="Montserrat, sans-serif" font-size="7" font-weight="600">N</text>
                                    </g>
                                </svg>

                                <div class="absolute top-0 left-0 border border-ink/15 bg-white px-3 py-2">
                                    <p class="font-mono text-[9px] tracking-widest text-ink/50 uppercase">Vista superior</p>
                                    <p class="mt-1 text-xs font-semibold">Enlaces de rádio</p>
                                </div>
                                <div class="absolute right-0 bottom-0 border border-ink/15 bg-white px-3 py-2">
                                    <p class="font-mono text-[9px] tracking-widest text-ink/50 uppercase">Disciplinas</p>
                                    <p class="mt-1 text-xs font-semibold">RF · MW · DWDM</p>
                                </div>
                            </div>

                            <div class="mt-8 grid grid-cols-2 border-t border-ink/10 pt-4 text-xs">
                                <div>
                                    <p class="text-[9px] font-semibold tracking-[0.16em] text-ink/40 uppercase">Status</p>
                                    <p class="mt-1 font-medium">Em desenvolvimento</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-[9px] font-semibold tracking-[0.16em] text-ink/40 uppercase">Contato</p>
                                    <a href="mailto:{{ $email }}" class="mt-1 block font-medium transition-colors hover:text-accent">E-mail</a>
                                </div>
                            </div>
                        </div>
                    </aside>
                </div>
            </section>

            <section class="mx-auto w-full max-w-6xl px-4 py-16 md:px-8 md:py-20">
                <div class="flex flex-col justify-between gap-4 border-b border-ink/10 pb-6 sm:flex-row sm:items-end">
                    <div>
                        <p class="text-xs font-semibold tracking-[0.2em] text-accent uppercase">O que está por vir</p>
                        <h2 class="mt-3 text-2xl leading-tight font-bold tracking-tight text-ink md:text-3xl">A nova presença digital da Skynet</h2>
                    </div>
                    <p class="max-w-[38ch] text-sm leading-relaxed text-ink/50">Conteúdo técnico, portfólio e canais de atendimento para operadoras e tower companies.</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3">
                    @foreach([
                        ['number' => '01', 'title' => 'Engenharia', 'text' => 'Soluções em RF, microwave e transporte óptico.'],
                        ['number' => '02', 'title' => 'Rollout documental', 'text' => 'As-Built, evidências e rastreabilidade de ponta a ponta.'],
                        ['number' => '03', 'title' => 'Qualidade', 'text' => 'Governança técnica, auditoria e acompanhamento DEC.'],
                    ] as $item)
                        <div class="border-b border-ink/10 py-6 sm:border-r sm:px-5 sm:last:border-r-0">
                            <span class="font-mono text-xs font-semibold text-accent tabular-nums">{{ $item['number'] }}</span>
                            <h3 class="mt-4 text-base font-bold text-ink">{{ $item['title'] }}</h3>
                            <p class="mt-2 text-sm leading-relaxed text-ink/50">{{ $item['text'] }}</p>
                        </div>
                    @endforeach
                </div>
            </section>
        </main>

        <footer class="border-t border-ink/10">
            <div class="mx-auto flex w-full max-w-6xl flex-col gap-4 px-4 py-6 md:flex-row md:items-center md:justify-between md:px-8">
                <div class="flex flex-col gap-1">
                    <p class="text-sm font-bold tracking-tight">Skynet Projetos e Consultoria</p>
                    <p class="text-xs text-ink/40">CNPJ 68.340.372/0001-09 · Cobertura nacional</p>
                </div>
                <div class="flex flex-col gap-1 text-xs text-ink/50 md:items-end">
                    <a href="mailto:{{ $email }}" class="transition-colors hover:text-accent">{{ $email }}</a>
                    <a href="tel:{{ preg_replace('/\D+/', '', $phone) }}" class="transition-colors hover:text-accent">{{ $phone }}</a>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
