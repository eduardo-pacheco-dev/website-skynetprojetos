@php
    $settings = $siteSettings ?? [];
    $siteName = $settings['site_name'] ?? 'Skynet Projetos e Consultoria';
    $email = $settings['email'] ?? 'contato@skynetprojetos.com.br';
    $phone = $settings['phone'] ?? null;
    $whatsapp = preg_replace('/\D+/', '', $settings['whatsapp'] ?? '');
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="color-scheme" content="light">
    <meta name="robots" content="noindex, nofollow">

    <title>{{ $siteName }} — Site em construção</title>
    <meta name="description" content="O novo site institucional da Skynet Projetos e Consultoria está em desenvolvimento.">
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    <meta name="theme-color" content="#f8f9fa">

    @fonts
    @vite(['resources/css/app.css'])
</head>
<body class="min-h-screen bg-canvas font-sans text-ink">
    <div class="flex min-h-screen flex-col">
        <header class="border-b border-ink/10">
            <div class="mx-auto flex w-full max-w-6xl items-center justify-between gap-6 px-4 py-5 md:px-8">
                <a href="{{ route('home') }}" class="flex min-h-[44px] flex-col justify-center leading-none">
                    <span class="text-base font-bold tracking-tight">Skynet</span>
                    <span class="mt-1.5 text-[9px] font-semibold tracking-[0.22em] text-ink/50 uppercase">Projetos e Consultoria</span>
                </a>
                <p class="hidden items-center gap-2 text-[10px] font-semibold tracking-[0.18em] text-ink/40 uppercase sm:flex">
                    <span class="h-1.5 w-1.5 bg-accent"></span>
                    Engenharia de Telecomunicações
                </p>
            </div>
        </header>

        <main class="flex flex-1 items-center">
            <div class="mx-auto w-full max-w-6xl px-4 py-16 md:px-8 md:py-24">
                <div class="grid grid-cols-12 gap-10 lg:gap-16">
                    <div class="col-span-12 lg:col-span-8">
                        <p class="flex items-center gap-3 text-xs font-semibold tracking-[0.2em] text-accent uppercase">
                            <span class="h-px w-8 bg-accent"></span>
                            Site em construção
                        </p>

                        <h1 class="mt-8 max-w-[13ch] text-5xl leading-[0.95] font-bold tracking-tight text-balance sm:text-6xl lg:text-7xl">
                            Estamos preparando <span class="text-accent">algo novo.</span>
                        </h1>

                        <p class="mt-8 max-w-[58ch] text-base leading-relaxed text-pretty text-ink/60 md:text-lg">
                            O novo site institucional da {{ $siteName }} está em desenvolvimento. Em breve, você encontrará aqui nossas soluções em engenharia de telecomunicações, rollout documental, qualidade e vistorias técnicas.
                        </p>

                        <div class="mt-10 flex flex-col gap-3 sm:flex-row">
                            <a href="mailto:{{ $email }}" class="inline-flex min-h-[48px] items-center justify-center gap-2 bg-accent px-6 py-3 text-sm font-semibold tracking-wide text-white transition-colors hover:bg-accent/90">
                                Falar com a equipe
                                <svg viewBox="0 0 20 20" fill="none" class="h-4 w-4" aria-hidden="true">
                                    <path d="M4 10h12m-4-4 4 4-4 4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </a>
                            @if(filled($whatsapp))
                                <a href="https://wa.me/{{ $whatsapp }}" target="_blank" rel="noopener noreferrer" class="inline-flex min-h-[48px] items-center justify-center border border-ink/20 px-6 py-3 text-sm font-semibold tracking-wide text-ink transition-colors hover:border-accent hover:text-accent">
                                    WhatsApp comercial
                                </a>
                            @endif
                        </div>

                        <dl class="mt-14 grid grid-cols-1 border-t border-ink/10 sm:grid-cols-3">
                            @foreach([
                                ['title' => 'Engenharia', 'text' => 'RF, microwave e transporte óptico.'],
                                ['title' => 'Rollout documental', 'text' => 'As-Built, evidências e rastreabilidade.'],
                                ['title' => 'Qualidade', 'text' => 'Governança técnica e DEC.'],
                            ] as $item)
                                <div class="border-b border-ink/10 py-5 sm:border-r sm:px-5 sm:last:border-r-0">
                                    <dt class="text-sm font-semibold text-ink">{{ $item['title'] }}</dt>
                                    <dd class="mt-1 text-sm leading-relaxed text-ink/50">{{ $item['text'] }}</dd>
                                </div>
                            @endforeach
                        </dl>
                    </div>

                    <aside class="col-span-12 lg:col-span-4">
                        <div class="border border-ink/10 bg-white">
                            <div class="flex items-center justify-between border-b border-ink/10 px-5 py-4">
                                <span class="text-[10px] font-semibold tracking-[0.18em] text-ink/40 uppercase">Status</span>
                                <span class="flex items-center gap-2 text-[10px] font-semibold tracking-[0.14em] text-accent uppercase">
                                    <span class="h-1.5 w-1.5 bg-accent"></span>
                                    Em desenvolvimento
                                </span>
                            </div>

                            <div class="relative aspect-square overflow-hidden bg-canvas">
                                <div class="absolute inset-0 grid-paper opacity-70"></div>
                                <div class="absolute top-6 left-6 h-10 w-10 bg-accent"></div>
                                <div class="absolute right-6 bottom-6 text-right">
                                    <p class="font-mono text-[10px] tracking-[0.18em] text-ink/40 uppercase">Skynet · 2026</p>
                                    <p class="mt-1 text-2xl font-bold tracking-tight text-ink">Em breve</p>
                                </div>
                                <svg viewBox="0 0 320 320" class="absolute inset-0 h-full w-full" fill="none" aria-hidden="true">
                                    <path d="M0 240 80 160l60 40 70-90 110 70" stroke="rgba(17,24,39,0.16)" stroke-width="1.2"/>
                                    <path d="M0 272 90 192l55 32 80-72 95 58" stroke="rgba(17,24,39,0.08)" stroke-width="1"/>
                                    <circle cx="210" cy="110" r="3" fill="#c8102e"/>
                                    <circle cx="210" cy="110" r="14" stroke="rgba(200,16,46,0.35)"/>
                                    <circle cx="210" cy="110" r="26" stroke="rgba(200,16,46,0.15)"/>
                                </svg>
                            </div>

                            <div class="border-t border-ink/10 px-5 py-4">
                                <p class="text-[10px] font-semibold tracking-[0.16em] text-ink/40 uppercase">Contato</p>
                                <a href="mailto:{{ $email }}" class="mt-1 block text-sm font-medium text-ink transition-colors hover:text-accent">{{ $email }}</a>
                                @if(filled($phone))
                                    <a href="tel:{{ preg_replace('/\D+/', '', $phone) }}" class="mt-1 block text-sm text-ink/60 transition-colors hover:text-accent">{{ $phone }}</a>
                                @endif
                            </div>
                        </div>

                        <p class="mt-4 text-xs leading-relaxed text-ink/40">
                            CNPJ 68.340.372/0001-09<br>
                            Atendimento em todo o território nacional.
                        </p>
                    </aside>
                </div>
            </div>
        </main>

        <footer class="border-t border-ink/10">
            <div class="mx-auto flex w-full max-w-6xl flex-col gap-2 px-4 py-6 text-xs text-ink/40 sm:flex-row sm:items-center sm:justify-between md:px-8">
                <p>&copy; {{ now()->year }} {{ $siteName }}. Todos os direitos reservados.</p>
                <p class="flex items-center gap-2">
                    <span class="hidden h-1 w-1 bg-accent sm:block"></span>
                    Engenharia de Telecomunicações · Rollout Documental · Qualidade
                </p>
            </div>
        </footer>
    </div>
</body>
</html>
