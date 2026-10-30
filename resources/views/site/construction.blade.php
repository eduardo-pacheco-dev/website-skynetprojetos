@php
    $settings = $siteSettings ?? [];
    $siteName = $settings['site_name'] ?? 'Skynet Projetos e Consultoria';
    $email = $settings['email'] ?? 'contato@skynetprojetos.com.br';
    $phone = $settings['phone'] ?? null;
    $whatsapp = preg_replace('/\D+/', '', $settings['whatsapp'] ?? '');
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
    <meta name="description" content="O novo site da {{ $siteName }} está em construção.">
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    <meta name="theme-color" content="#f8f9fa">

    @fonts
    @vite(['resources/css/app.css'])
</head>
<body class="min-h-screen bg-canvas font-sans text-ink">
    <div class="h-1 w-full bg-accent"></div>

    <div class="flex min-h-[calc(100vh-4px)] flex-col">
        <header class="border-b border-ink/10">
            <div class="mx-auto flex w-full max-w-6xl items-center justify-between gap-6 px-4 py-5 md:px-8">
                <a href="{{ url('/') }}" class="flex min-h-[44px] flex-col justify-center leading-none">
                    <span class="text-base font-bold tracking-tight">Skynet</span>
                    <span class="mt-1.5 text-[9px] font-semibold tracking-[0.22em] text-ink/50 uppercase">Projetos e Consultoria</span>
                </a>
                <p class="flex items-center gap-2 text-[10px] font-semibold tracking-[0.18em] text-ink/40 uppercase">
                    <span class="h-1.5 w-1.5 bg-accent"></span>
                    Em construção
                </p>
            </div>
        </header>

        <main class="flex flex-1 items-center">
            <div class="mx-auto w-full max-w-6xl px-4 py-20 md:px-8 md:py-28">
                <div class="grid grid-cols-12 gap-8">
                    <div class="col-span-12 md:col-span-8">
                        <p class="text-xs font-semibold tracking-[0.2em] text-accent uppercase">Skynet Projetos e Consultoria</p>

                        <h1 class="mt-6 max-w-[18ch] text-4xl leading-[1.02] font-bold tracking-tight text-balance sm:text-5xl lg:text-6xl">
                            {{ $title }}
                        </h1>

                        <div class="mt-8 h-px w-12 bg-accent"></div>

                        <p class="mt-8 max-w-[58ch] text-base leading-relaxed text-pretty text-ink/60">
                            {{ $message }}
                        </p>

                        <div class="mt-10 flex flex-wrap items-center gap-x-6 gap-y-3">
                            <a href="mailto:{{ $email }}" class="inline-flex min-h-[44px] items-center gap-2 text-sm font-semibold text-accent underline-offset-4 transition-colors hover:underline">
                                Falar com a equipe
                                <span aria-hidden="true">→</span>
                            </a>
                            @if(filled($whatsapp))
                                <a href="https://wa.me/{{ $whatsapp }}" target="_blank" rel="noopener noreferrer" class="inline-flex min-h-[44px] items-center text-sm font-medium text-ink/60 transition-colors hover:text-ink">
                                    WhatsApp
                                </a>
                            @endif
                        </div>
                    </div>

                    <aside class="col-span-12 md:col-span-4 md:border-l md:border-ink/10 md:pl-8">
                        <dl class="space-y-5">
                            <div>
                                <dt class="text-[10px] font-semibold tracking-[0.16em] text-ink/40 uppercase">Status</dt>
                                <dd class="mt-1 text-sm font-medium">Em desenvolvimento</dd>
                            </div>
                            <div>
                                <dt class="text-[10px] font-semibold tracking-[0.16em] text-ink/40 uppercase">Contato</dt>
                                <dd class="mt-1 text-sm text-ink/60">
                                    <a href="mailto:{{ $email }}" class="transition-colors hover:text-accent">{{ $email }}</a>
                                    @if(filled($phone))
                                        <br>
                                        <a href="tel:{{ preg_replace('/\D+/', '', $phone) }}" class="transition-colors hover:text-accent">{{ $phone }}</a>
                                    @endif
                                </dd>
                            </div>
                            <div>
                                <dt class="text-[10px] font-semibold tracking-[0.16em] text-ink/40 uppercase">Atuação</dt>
                                <dd class="mt-1 text-sm text-ink/60">Cobertura nacional</dd>
                            </div>
                        </dl>
                    </aside>
                </div>
            </div>
        </main>

        <footer class="border-t border-ink/10">
            <div class="mx-auto flex w-full max-w-6xl flex-col gap-2 px-4 py-6 text-xs text-ink/40 sm:flex-row sm:items-center sm:justify-between md:px-8">
                <p>&copy; {{ now()->year }} {{ $siteName }}</p>
                <p>CNPJ 68.340.372/0001-09</p>
            </div>
        </footer>
    </div>
</body>
</html>
