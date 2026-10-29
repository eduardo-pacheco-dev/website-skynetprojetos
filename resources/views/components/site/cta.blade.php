@props([
    'title' => 'Sua operação precisa de precisão técnica.',
    'description' => 'Fale com nossa equipe de engenharia e receba uma avaliação técnica para vistoria, implantação ou auditoria.',
])

<section class="mx-auto max-w-7xl px-6 py-20 lg:px-8">
    <div class="relative overflow-hidden rounded-2xl border border-technical-500/25 bg-navy-900 px-6 py-14 sm:px-14">
        <div class="absolute inset-0 bg-blueprint opacity-30"></div>
        <div class="pointer-events-none absolute -top-32 right-0 h-80 w-80 rounded-full bg-technical-500/10 blur-3xl"></div>
        <div class="relative grid items-center gap-10 lg:grid-cols-[1fr_auto]">
            <div>
                <p class="technical-label">Engenharia de campo</p>
                <h2 class="mt-4 max-w-2xl text-3xl font-bold tracking-tight text-white sm:text-4xl">{{ $title }}</h2>
                <p class="mt-4 max-w-2xl text-base leading-7 text-slate-400">{{ $description }}</p>
            </div>
            <div class="flex flex-col gap-3 sm:flex-row lg:flex-col">
                <a href="{{ route('contact.create') }}" class="inline-flex items-center justify-center rounded-lg bg-technical-500 px-6 py-3.5 text-sm font-semibold text-navy-950 transition hover:bg-technical-400">
                    Solicitar orçamento
                </a>
                <a href="{{ route('services.index') }}" class="inline-flex items-center justify-center rounded-lg border border-white/20 bg-white/5 px-6 py-3.5 text-sm font-semibold text-white transition hover:bg-white/10">
                    Conhecer serviços
                </a>
            </div>
        </div>
    </div>
</section>
