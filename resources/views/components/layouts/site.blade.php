@props(['title' => null, 'description' => null])

@php
    $settings = $siteSettings ?? [];
    $siteName = $settings['site_name'] ?? config('app.name');
    $tagline = $settings['tagline'] ?? 'Tecnologia sob medida para o seu negócio';
    $pageDescription = $description ?? $tagline;
    $pageTitle = $title ? $title.' — '.$siteName : $siteName.' — '.$tagline;
    $gaMeasurementId = filled($settings['ga_measurement_id'] ?? null) ? $settings['ga_measurement_id'] : null;
    $navigation = [
        ['label' => 'Início', 'route' => 'home', 'active' => 'home'],
        ['label' => 'Serviços', 'route' => 'services.index', 'active' => 'services.*'],
        ['label' => 'Projetos', 'route' => 'projects.index', 'active' => 'projects.*'],
        ['label' => 'Sobre', 'route' => 'about', 'active' => 'about'],
        ['label' => 'Contato', 'route' => 'contact.create', 'active' => 'contact.*'],
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

    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{ $siteName }}">
    <meta property="og:title" content="{{ $pageTitle }}">
    <meta property="og:description" content="{{ $pageDescription }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta name="twitter:card" content="summary_large_image">

    <meta name="theme-color" content="#04070f">

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
</head>
<body class="min-h-screen bg-[#04070f] font-sans text-slate-300">
    <a href="#conteudo" class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 focus:z-50 focus:rounded-lg focus:bg-cyan-400 focus:px-4 focus:py-2 focus:text-sm focus:font-semibold focus:text-slate-950">
        Ir para o conteúdo
    </a>

    <header class="sticky top-0 z-40 border-b border-white/5 bg-[#04070f]/80 backdrop-blur-xl">
        <nav class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4 lg:px-8" aria-label="Navegação principal">
            <x-site.logo :href="route('home')" />

            <div class="hidden items-center gap-8 md:flex">
                @foreach($navigation as $item)
                    <a href="{{ route($item['route']) }}"
                       @class([
                           'text-sm font-medium transition',
                           'text-cyan-300' => request()->routeIs($item['active']),
                           'text-slate-400 hover:text-white' => ! request()->routeIs($item['active']),
                       ])
                       @if(request()->routeIs($item['active'])) aria-current="page" @endif>
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </div>

            <div class="hidden md:block">
                <a href="{{ route('contact.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-cyan-400 to-sky-500 px-4 py-2.5 text-sm font-semibold text-slate-950 shadow-lg shadow-cyan-500/20 transition hover:brightness-110">
                    Fale conosco
                </a>
            </div>

            <details class="relative md:hidden">
                <summary class="flex cursor-pointer list-none items-center justify-center rounded-lg border border-white/10 p-2 text-slate-300 [&::-webkit-details-marker]:hidden" aria-label="Abrir menu">
                    <svg viewBox="0 0 24 24" fill="none" class="h-6 w-6" aria-hidden="true">
                        <path d="M4 7h16M4 12h16M4 17h16" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                    </svg>
                </summary>
                <div class="absolute right-0 mt-3 w-64 overflow-hidden rounded-2xl border border-white/10 bg-[#081120] p-2 shadow-2xl">
                    @foreach($navigation as $item)
                        <a href="{{ route($item['route']) }}"
                           @class([
                               'block rounded-lg px-4 py-2.5 text-sm font-medium transition',
                               'bg-cyan-400/10 text-cyan-300' => request()->routeIs($item['active']),
                               'text-slate-300 hover:bg-white/5 hover:text-white' => ! request()->routeIs($item['active']),
                           ])>
                            {{ $item['label'] }}
                        </a>
                    @endforeach
                    <a href="{{ route('contact.create') }}" class="mt-2 block rounded-lg bg-gradient-to-r from-cyan-400 to-sky-500 px-4 py-2.5 text-center text-sm font-semibold text-slate-950">
                        Fale conosco
                    </a>
                </div>
            </details>
        </nav>
    </header>

    <main id="conteudo">
        {{ $slot }}
    </main>

    <footer class="border-t border-white/5 bg-[#03060c]">
        <div class="mx-auto grid max-w-7xl gap-12 px-6 py-16 sm:grid-cols-2 lg:grid-cols-4 lg:px-8">
            <div class="sm:col-span-2 lg:col-span-1">
                <x-site.logo :href="route('home')" />
                <p class="mt-5 max-w-xs text-sm leading-6 text-slate-400">
                    {{ $settings['about_text'] ?? $tagline }}
                </p>
            </div>

            <div>
                <h3 class="text-sm font-semibold text-white">Navegação</h3>
                <ul class="mt-4 space-y-3">
                    @foreach($navigation as $item)
                        <li>
                            <a href="{{ route($item['route']) }}" class="text-sm text-slate-400 transition hover:text-cyan-300">{{ $item['label'] }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div>
                <h3 class="text-sm font-semibold text-white">Contato</h3>
                <ul class="mt-4 space-y-3 text-sm text-slate-400">
                    @if(filled($settings['email'] ?? null))
                        <li><a href="mailto:{{ $settings['email'] }}" class="transition hover:text-cyan-300">{{ $settings['email'] }}</a></li>
                    @endif
                    @if(filled($settings['phone'] ?? null))
                        <li><a href="tel:{{ preg_replace('/\D+/', '', $settings['phone']) }}" class="transition hover:text-cyan-300">{{ $settings['phone'] }}</a></li>
                    @endif
                    @if(filled($settings['address'] ?? null))
                        <li>{{ $settings['address'] }}</li>
                    @endif
                </ul>
            </div>

            <div>
                <h3 class="text-sm font-semibold text-white">Redes sociais</h3>
                <ul class="mt-4 space-y-3 text-sm text-slate-400">
                    @foreach(['linkedin_url' => 'LinkedIn', 'github_url' => 'GitHub', 'instagram_url' => 'Instagram'] as $key => $label)
                        @if(filled($settings[$key] ?? null))
                            <li>
                                <a href="{{ $settings[$key] }}" target="_blank" rel="noopener noreferrer" class="transition hover:text-cyan-300">{{ $label }}</a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="border-t border-white/5">
            <div class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-3 px-6 py-6 text-xs text-slate-500 sm:flex-row lg:px-8">
                <p>&copy; {{ now()->year }} {{ $siteName }}. Todos os direitos reservados.</p>
                <div class="flex items-center gap-4">
                    <a href="{{ route('contact.create') }}" class="transition hover:text-cyan-300">Orçamento</a>
                    <a href="{{ url('/admin') }}" class="transition hover:text-cyan-300">Painel administrativo</a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
