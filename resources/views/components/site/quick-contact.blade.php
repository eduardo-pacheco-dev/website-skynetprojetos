@php
    $settings = $siteSettings ?? [];
    $whatsapp = preg_replace('/\D+/', '', $settings['whatsapp'] ?? '');
    $email = $settings['email'] ?? null;
@endphp

@if(filled($whatsapp) || filled($email))
    <div class="fixed right-4 bottom-4 z-50 flex flex-col gap-2 md:right-8 md:bottom-8" aria-label="Contato rápido">
        @if(filled($whatsapp))
            <a href="https://wa.me/{{ $whatsapp }}?text={{ rawurlencode('Olá, gostaria de solicitar uma vistoria ou orçamento técnico.') }}"
               target="_blank"
               rel="noopener noreferrer"
               class="group relative flex h-12 w-12 items-center justify-center border border-accent bg-accent text-white transition-colors hover:bg-stone-900 hover:border-stone-900"
               aria-label="Falar no WhatsApp">
                <span class="pointer-events-none absolute right-full mr-3 hidden whitespace-nowrap border border-stone-200 bg-stone-50 px-3 py-2 text-xs font-medium tracking-wide text-stone-900 opacity-0 transition-opacity group-hover:opacity-100 sm:block">
                    WhatsApp
                </span>
                <svg viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5" aria-hidden="true">
                    <path d="M17.47 14.38c-.3-.15-1.76-.87-2.03-.97-.27-.1-.47-.15-.67.15-.2.3-.77.97-.94 1.17-.17.2-.35.22-.65.07-.3-.15-1.25-.46-2.38-1.47-.88-.79-1.48-1.76-1.65-2.06-.17-.3-.02-.46.13-.61.13-.13.3-.35.45-.52.15-.17.2-.3.3-.5.1-.2.05-.37-.02-.52-.08-.15-.67-1.6-.92-2.2-.24-.58-.49-.5-.67-.51h-.57c-.2 0-.52.07-.79.37-.27.3-1.04 1.02-1.04 2.48 0 1.47 1.06 2.88 1.21 3.08.15.2 2.09 3.2 5.07 4.49.71.3 1.26.49 1.69.63.71.23 1.36.2 1.87.12.57-.09 1.76-.72 2.01-1.42.25-.7.25-1.29.17-1.42-.07-.13-.27-.2-.57-.35Z"/>
                    <path d="M12.04 2C6.58 2 2.13 6.45 2.13 11.91c0 1.75.46 3.46 1.32 4.96L2 22l5.25-1.38a9.87 9.87 0 0 0 4.78 1.22h.01c5.46 0 9.91-4.45 9.91-9.91S17.5 2 12.04 2Zm0 18.15h-.01a8.2 8.2 0 0 1-4.19-1.15l-.3-.18-3.11.82.83-3.04-.2-.31a8.18 8.18 0 0 1-1.25-4.38c0-4.54 3.7-8.24 8.24-8.24 2.2 0 4.27.86 5.82 2.42a8.18 8.18 0 0 1 2.42 5.83c0 4.54-3.7 8.23-8.25 8.23Z"/>
                </svg>
            </a>
        @endif

        @if(filled($email))
            <a href="mailto:{{ $email }}?subject={{ rawurlencode('Solicitação de vistoria / orçamento técnico') }}"
               class="group relative flex h-12 w-12 items-center justify-center border border-stone-900 bg-stone-900 text-white transition-colors hover:bg-accent hover:border-accent"
               aria-label="Enviar e-mail">
                <span class="pointer-events-none absolute right-full mr-3 hidden whitespace-nowrap border border-stone-200 bg-stone-50 px-3 py-2 text-xs font-medium tracking-wide text-stone-900 opacity-0 transition-opacity group-hover:opacity-100 sm:block">
                    E-mail
                </span>
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5" aria-hidden="true">
                    <rect x="3" y="5" width="18" height="14" rx="0"/>
                    <path d="m3.5 7 8.5 6 8.5-6" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
        @endif
    </div>
@endif
