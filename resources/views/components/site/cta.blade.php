@props([
    'title' => 'Sua operação precisa de precisão técnica.',
    'description' => 'Fale com nossa equipe de engenharia e receba uma avaliação técnica para vistoria, implantação ou auditoria.',
])

<section class="border-t border-stone-200 bg-stone-100">
    <div class="mx-auto max-w-6xl px-4 py-16 md:px-8 md:py-24">
        <div class="grid grid-cols-12 gap-8">
            <div class="col-span-12 lg:col-span-8">
                <p class="flex items-center gap-3 text-xs font-medium tracking-widest text-stone-900/60 uppercase">
                    <span class="block h-px w-6 bg-accent"></span>
                    Engenharia de campo
                </p>
                <h2 class="mt-5 max-w-2xl text-3xl leading-tight font-light tracking-tight text-balance text-stone-900 md:text-5xl">{{ $title }}</h2>
                <p class="mt-5 max-w-[60ch] text-base leading-relaxed text-stone-900/60">{{ $description }}</p>
            </div>
            <div class="col-span-12 flex flex-col gap-3 sm:flex-row lg:col-span-4 lg:flex-col lg:justify-end">
                <a href="{{ route('contact.create') }}" class="inline-flex min-h-[44px] items-center justify-center bg-accent px-6 py-3 text-sm font-medium tracking-wide text-white transition-colors hover:bg-accent/90">
                    Solicitar orçamento
                </a>
                <a href="{{ route('services.index') }}" class="inline-flex min-h-[44px] items-center justify-center border border-stone-300 px-6 py-3 text-sm font-medium tracking-wide text-stone-900 transition-colors hover:border-stone-900">
                    Conhecer serviços
                </a>
            </div>
        </div>
    </div>
</section>
