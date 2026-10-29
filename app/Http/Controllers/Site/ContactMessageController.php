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
        $data = $request->safe()->only([
            'name',
            'company',
            'email',
            'phone',
            'service_interest',
            'message',
        ]);

        ContactMessage::create([
            ...$data,
            'subject' => $data['service_interest'],
            'ip_address' => $request->ip(),
        ]);

        return back()->with('status', 'Solicitação enviada com sucesso! Nossa equipe técnica entrará em contato em até um dia útil.');
    }
}
