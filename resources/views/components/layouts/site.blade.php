@props(['title' => null, 'description' => null])

@php
    $settings = $siteSettings ?? [];
    $siteName = $settings['site_name'] ?? config('app.name');
    $tagline = $settings['tagline'] ?? 'Engenharia de Telecomunicações e Infraestrutura de Alta Performance';
    $pageDescription = $description ?? $tagline;
    $pageTitle = $title ? $title.' — '.$siteName : $siteName.' — '.$tagline;
    $gaMeasurementId = filled($settings['ga_measurement_id'] ?? null) ? $settings['ga_measurement_id'] : null;
    $navigation = [
        ['label' => 'Início', 'href' => route('home'), 'active' => 'home'],
        ['label' => 'Serviços', 'href' => route('services.index'), 'active' => 'services.*'],
        ['label' => 'Diferenciais', 'href' => route('home').'#diferenciais', 'active' => null],
        ['label' => 'Atuação', 'href' => route('home').'#atuacao', 'active' => null],
        ['label' => 'Portfólio', 'href' => route('projects.index'), 'active' => 'projects.*'],
        ['label' => 'Contato', 'href' => route('contact.create'), 'active' => 'contact.*'],
    ];
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $pageTitle }}</title>
    <meta name="description" content="{{ $pageDescription }}">
    <link rel="canonical" href="{{ url()->current() }}">
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">

    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{ $siteName }}">
    <meta property="og:title" content="{{ $pageTitle }}">
    <meta property="og:description" content="{{ $pageDescription }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta name="twitter:card" content="summary_large_image">

    <meta name="theme-color" content="#050d16">

    @fonts
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @if($gaMeasurementId)
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ $gaMeasurementId }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', '{{ $gaMeasurementId }}');
        </script>
    @endif

    @php
        $structuredData = array_filter([
            '@context' => 'https://schema.org',
            '@type' => 'ProfessionalService',
            'name' => $siteName,
            'url' => route('home'),
            'description' => $pageDescription,
            'telephone' => $settings['phone'] ?? null,
            'email' => $settings['email'] ?? null,
            'areaServed' => 'BR',
            'sameAs' => array_values(array_filter([
                $settings['linkedin_url'] ?? null,
                $settings['instagram_url'] ?? null,
            ])),
            'knowsAbout' => [
                'Engenharia de telecomunicações',
                'Implantação de ERBs',
                'Site Survey',
                'Swap de rede RAN',
                'Auditoria EHS',
            ],
        ]);
    @endphp
    <script type="application/ld+json">{!! json_encode($structuredData, JSON_UNESCAPED_UNICODE) !!}</script>
</head>
<body class="min-h-screen bg-navy-950 font-sans text-slate-300">
    <a href="#conteudo" class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 focus:z-[60] focus:rounded-lg focus:bg-technical-500 focus:px-4 focus:py-2 focus:text-sm focus:font-semibold focus:text-navy-950">
        Ir para o conteúdo
    </a>

    <div class="hidden border-b border-white/5 bg-navy-950 lg:block">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-2 text-[11px] tracking-wide lg:px-8">
            <p class="flex items-center gap-2 text-slate-500">
                <span class="h-1.5 w-1.5 rounded-full bg-compliance-500"></span>
                <span class="uppercase">Engenharia de Telecomunicações · Cobertura Nacional</span>
            </p>
            <div class="flex items-center gap-6">
                <span class="flex items-center gap-2 text-slate-500">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5" class="h-3.5 w-3.5" aria-hidden="true">
                        <path d="M4 5.5 6 3l2.5 2.5-1.3 2a11 11 0 0 0 5.3 5.3l2-1.3L17 14l-2.5 2c-5.8-.3-10.2-4.7-10.5-10.5Z" stroke-linejoin="round"/>
                    </svg>
                    {{ $settings['phone'] ?? '+55 (11) 99999-0000' }}
                </span>
                <span class="text-white/10">|</span>
                <span class="flex items-center gap-2 text-slate-500 uppercase">EHS · FAM · 5G NR</span>
            </div>
        </div>
    </div>

    <header class="sticky top-0 z-50 border-b border-white/10 bg-navy-950/95 backdrop-blur-md">
        <nav class="mx-auto flex max-w-7xl items-center justify-between gap-6 px-6 py-4 lg:px-8" aria-label="Navegação principal">
            <x-site.logo :href="route('home')" />

            <div class="hidden items-center gap-7 xl:flex">
                @foreach($navigation as $item)
                    <a href="{{ $item['href'] }}"
                       @class([
                           'relative py-1 text-[13px] font-medium transition',
                           'text-technical-400' => $item['active'] && request()->routeIs($item['active']),
                           'text-slate-300 hover:text-white' => ! $item['active'] || ! request()->routeIs($item['active']),
                       ])
                       @if($item['active'] && request()->routeIs($item['active'])) aria-current="page" @endif>
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </div>

            <div class="hidden items-center gap-3 xl:flex">
                <a href="tel:{{ preg_replace('/\D+/', '', $settings['phone'] ?? '') }}" class="flex h-10 w-10 items-center justify-center rounded-lg border border-white/10 text-slate-400 transition hover:border-technical-500/40 hover:text-technical-400" aria-label="Ligar">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5" class="h-4 w-4" aria-hidden="true">
                        <path d="M4 5.5 6 3l2.5 2.5-1.3 2a11 11 0 0 0 5.3 5.3l2-1.3L17 14l-2.5 2c-5.8-.3-10.2-4.7-10.5-10.5Z" stroke-linejoin="round"/>
                    </svg>
                </a>
                <a href="{{ route('contact.create') }}" class="inline-flex items-center gap-2 rounded-lg bg-technical-500 px-5 py-2.5 text-[13px] font-bold text-navy-950 transition hover:bg-technical-400">
                    Solicitar orçamento
                    <svg viewBox="0 0 20 20" fill="none" class="h-4 w-4" aria-hidden="true">
                        <path d="M4 10h12m-4-4 4 4-4 4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </div>

            <details class="relative xl:hidden">
                <summary class="flex cursor-pointer list-none items-center justify-center rounded-lg border border-white/15 p-2.5 text-slate-200 [&::-webkit-details-marker]:hidden" aria-label="Abrir menu">
                    <svg viewBox="0 0 24 24" fill="none" class="h-6 w-6" aria-hidden="true">
                        <path d="M4 7h16M4 12h16M4 17h16" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                    </svg>
                </summary>
                <div class="absolute right-0 mt-3 w-72 overflow-hidden rounded-xl border border-white/10 bg-navy-900 p-2 shadow-2xl shadow-black/50">
                    @foreach($navigation as $item)
                        <a href="{{ $item['href'] }}"
                           @class([
                               'block rounded-lg px-4 py-2.5 text-sm font-medium transition',
                               'bg-technical-500/10 text-technical-400' => $item['active'] && request()->routeIs($item['active']),
                               'text-slate-300 hover:bg-white/5 hover:text-white' => ! $item['active'] || ! request()->routeIs($item['active']),
                           ])>
                            {{ $item['label'] }}
                        </a>
                    @endforeach
                    <div class="mt-2 border-t border-white/10 pt-2">
                        <a href="{{ route('contact.create') }}" class="block rounded-lg bg-technical-500 px-4 py-3 text-center text-sm font-bold text-navy-950">
                            Solicitar orçamento / vistoria
                        </a>
                    </div>
                </div>
            </details>
        </nav>
    </header>

    <main id="conteudo">
        {{ $slot }}
    </main>

    <footer class="border-t border-white/10 bg-navy-950">
        <div class="mx-auto grid max-w-7xl gap-12 px-6 py-16 sm:grid-cols-2 lg:grid-cols-4 lg:px-8">
            <div class="sm:col-span-2 lg:col-span-1">
                <x-site.logo :href="route('home')" />
                <p class="mt-6 max-w-xs text-sm leading-6 text-slate-400">
                    Engenharia de telecomunicações com atuação nacional em vistorias, implantação de ERBs, swap e auditorias de conformidade.
                </p>
                <div class="mt-6 flex items-center gap-2 text-[10px] font-semibold tracking-[0.18em] text-compliance-400 uppercase">
                    <span class="h-1.5 w-1.5 rounded-full bg-compliance-500"></span>
                    Conformidade EHS · FAM
                </div>
            </div>

            <div>
                <h2 class="text-sm font-semibold text-white">Navegação</h2>
                <ul class="mt-5 space-y-3">
                    @foreach($navigation as $item)
                        <li>
                            <a href="{{ $item['href'] }}" class="text-sm text-slate-400 transition hover:text-technical-400">{{ $item['label'] }}</a>
                        </li>
                    @endforeach
                    <li>
                        <a href="{{ route('about') }}" class="text-sm text-slate-400 transition hover:text-technical-400">Sobre a empresa</a>
                    </li>
                </ul>
            </div>

            <div>
                <h2 class="text-sm font-semibold text-white">Soluções</h2>
                <ul class="mt-5 space-y-3 text-sm text-slate-400">
                    @foreach($footerServices ?? [] as $footerService)
                        <li>
                            <a href="{{ route('services.show', $footerService) }}" class="transition hover:text-technical-400">{{ $footerService->title }}</a>
                        </li>
                    @endforeach
                    <li><a href="{{ route('services.index') }}" class="font-medium text-technical-400 transition hover:text-technical-300">Ver todos os serviços</a></li>
                </ul>
            </div>

            <div>
                <h2 class="text-sm font-semibold text-white">Contato corporativo</h2>
                <ul class="mt-5 space-y-3 text-sm text-slate-400">
                    @if(filled($settings['email'] ?? null))
                        <li>
                            <a href="mailto:{{ $settings['email'] }}" class="transition hover:text-technical-400">{{ $settings['email'] }}</a>
                        </li>
                    @endif
                    @if(filled($settings['phone'] ?? null))
                        <li>
                            <a href="tel:{{ preg_replace('/\D+/', '', $settings['phone']) }}" class="transition hover:text-technical-400">{{ $settings['phone'] }}</a>
                        </li>
                    @endif
                    @if(filled($settings['whatsapp'] ?? null))
                        <li>
                            <a href="https://wa.me/{{ preg_replace('/\D+/', '', $settings['whatsapp']) }}" target="_blank" rel="noopener noreferrer" class="transition hover:text-technical-400">WhatsApp comercial</a>
                        </li>
                    @endif
                    @if(filled($settings['address'] ?? null))
                        <li>{{ $settings['address'] }}</li>
                    @endif
                </ul>

                <div class="mt-5 flex items-center gap-3">
                    @foreach([
                        'linkedin_url' => '<path fill="currentColor" d="M4.98 3.5A2.5 2.5 0 1 0 5 8.5a2.5 2.5 0 0 0 0-5ZM3 9h4v12H3V9Zm6 0h3.8v1.7h.05c.53-1 1.83-2.05 3.77-2.05C20.4 8.65 21 11 21 14.1V21h-4v-6.1c0-1.45-.03-3.3-2-3.3-2 0-2.3 1.56-2.3 3.2V21H9V9Z"/>',
                        'instagram_url' => '<rect x="3" y="3" width="18" height="18" rx="5" fill="none" stroke="currentColor" stroke-width="1.8"/><circle cx="12" cy="12" r="4" fill="none" stroke="currentColor" stroke-width="1.8"/><circle cx="17.2" cy="6.8" r="1.1" fill="currentColor"/>',
                        'github_url' => '<path fill="currentColor" d="M12 2a10 10 0 0 0-3.16 19.49c.5.09.68-.22.68-.48v-1.7c-2.78.6-3.37-1.34-3.37-1.34-.45-1.16-1.11-1.47-1.11-1.47-.91-.62.07-.61.07-.61 1 .07 1.53 1.03 1.53 1.03.9 1.53 2.35 1.09 2.92.83.09-.65.35-1.09.63-1.34-2.22-.25-4.56-1.11-4.56-4.94 0-1.09.39-1.98 1.03-2.68-.1-.25-.45-1.27.1-2.64 0 0 .84-.27 2.75 1.02a9.5 9.5 0 0 1 5 0c1.91-1.29 2.75-1.02 2.75-1.02.55 1.37.2 2.39.1 2.64.64.7 1.03 1.59 1.03 2.68 0 3.84-2.34 4.69-4.57 4.94.36.31.68.92.68 1.85v2.74c0 .27.18.58.69.48A10 10 0 0 0 12 2Z"/>',
                    ] as $key => $icon)
                        @if(filled($settings[$key] ?? null))
                            <a href="{{ $settings[$key] }}" target="_blank" rel="noopener noreferrer"
                               class="flex h-9 w-9 items-center justify-center rounded-lg border border-white/10 text-slate-400 transition hover:border-technical-500/40 hover:text-technical-400"
                               aria-label="{{ ['linkedin_url' => 'LinkedIn', 'instagram_url' => 'Instagram', 'github_url' => 'GitHub'][$key] }}">
                                <svg viewBox="0 0 24 24" class="h-4 w-4" aria-hidden="true">{!! $icon !!}</svg>
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>

        <div class="border-t border-white/5">
            <div class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-3 px-6 py-6 text-xs text-slate-500 sm:flex-row lg:px-8">
                <p>&copy; {{ now()->year }} {{ $siteName }}. Todos os direitos reservados.</p>
                <div class="flex items-center gap-5">
                    <span class="hidden sm:inline">Engenharia de Telecomunicações · Brasil</span>
                    <a href="{{ url('/admin') }}" class="transition hover:text-technical-400">Painel administrativo</a>
                </div>
            </div>
        </div>
    </footer>

    <x-site.quick-contact />
</body>
</html>
