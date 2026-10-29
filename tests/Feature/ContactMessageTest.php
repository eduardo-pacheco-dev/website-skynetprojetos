<?php

namespace Tests\Feature;

use App\Models\ContactMessage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactMessageTest extends TestCase
{
    use RefreshDatabase;

    public function test_visitors_can_send_a_contact_message(): void
    {
        $response = $this->from(route('contact.create'))->post(route('contact.store'), [
            'name' => 'Maria Silva',
            'company' => 'Aurora Telecom',
            'email' => 'maria@example.com',
            'phone' => '(11) 99999-0000',
            'service_interest' => 'Vistoria técnica / Site Survey',
            'message' => 'Gostaria de um orçamento para vistoria em 20 sites.',
        ]);

        $response
            ->assertRedirect(route('contact.create'))
            ->assertSessionHas('status');

        $this->assertDatabaseHas('contact_messages', [
            'name' => 'Maria Silva',
            'company' => 'Aurora Telecom',
            'email' => 'maria@example.com',
            'service_interest' => 'Vistoria técnica / Site Survey',
            'subject' => 'Vistoria técnica / Site Survey',
        ]);
    }

    public function test_contact_message_requires_valid_data(): void
    {
        $this->from(route('contact.create'))
            ->post(route('contact.store'), [
                'name' => '',
                'email' => 'not-an-email',
                'message' => 'curta',
            ])
            ->assertRedirect(route('contact.create'))
            ->assertSessionHasErrors(['name', 'email', 'service_interest', 'message']);

        $this->assertDatabaseCount('contact_messages', 0);
    }

    public function test_honeypot_field_blocks_spam(): void
    {
        $this->from(route('contact.create'))
            ->post(route('contact.store'), [
                'name' => 'Spam Bot',
                'email' => 'spam@example.com',
                'service_interest' => 'Vistoria técnica / Site Survey',
                'message' => 'Mensagem automática de spam.',
                'website' => 'https://spam.example.com',
            ])
            ->assertSessionHasErrors('website');

        $this->assertDatabaseCount('contact_messages', 0);
    }

    public function test_admin_can_mark_message_as_read(): void
    {
        $message = ContactMessage::factory()->create();

        $message->markAsRead();

        $this->assertNotNull($message->fresh()->read_at);
    }
}
