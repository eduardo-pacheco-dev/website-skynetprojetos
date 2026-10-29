@props(['title' => 'Pronto para tirar sua ideia do papel?', 'description' => 'Conte o que você precisa e receba uma proposta personalizada.'])

<section class="mx-auto max-w-7xl px-6 py-20 lg:px-8">
    <div class="relative overflow-hidden rounded-3xl border border-cyan-400/20 bg-gradient-to-br from-cyan-500/10 via-sky-500/5 to-violet-500/10 px-6 py-14 text-center sm:px-16">
        <div class="pointer-events-none absolute -top-24 left-1/2 h-64 w-64 -translate-x-1/2 rounded-full bg-cyan-400/20 blur-3xl"></div>
        <h2 class="relative text-3xl font-bold tracking-tight text-white sm:text-4xl">{{ $title }}</h2>
        <p class="relative mx-auto mt-4 max-w-2xl text-base leading-7 text-slate-300">{{ $description }}</p>
        <div class="relative mt-8 flex flex-col items-center justify-center gap-3 sm:flex-row">
            <a href="{{ route('contact.create') }}" class="inline-flex items-center justify-center rounded-xl bg-gradient-to-r from-cyan-400 to-sky-500 px-6 py-3 text-sm font-semibold text-slate-950 shadow-lg shadow-cyan-500/20 transition hover:brightness-110">
                Solicitar orçamento
            </a>
            <a href="{{ route('projects.index') }}" class="inline-flex items-center justify-center rounded-xl border border-white/15 bg-white/5 px-6 py-3 text-sm font-semibold text-white transition hover:bg-white/10">
                Ver projetos
            </a>
        </div>
    </div>
</section>
