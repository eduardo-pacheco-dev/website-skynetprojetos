<?php

namespace App\Http\Controllers\Site;

use App\Http\Requests\StoreContactMessageRequest;
use App\Models\ContactMessage;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ContactMessageController
{
    public function create(): View
    {
        return view('site.contact');
    }

    public function store(StoreContactMessageRequest $request): RedirectResponse
    {
        ContactMessage::create([
            ...$request->safe()->except('website'),
            'ip_address' => $request->ip(),
        ]);

        return back()->with('status', 'Mensagem enviada com sucesso! Entraremos em contato em breve.');
    }
}
