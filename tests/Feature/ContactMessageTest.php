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
            'email' => 'maria@example.com',
            'phone' => '(11) 99999-0000',
            'subject' => 'Novo sistema',
            'message' => 'Gostaria de um orçamento para um sistema interno.',
        ]);

        $response
            ->assertRedirect(route('contact.create'))
            ->assertSessionHas('status');

        $this->assertDatabaseHas('contact_messages', [
            'name' => 'Maria Silva',
            'email' => 'maria@example.com',
            'subject' => 'Novo sistema',
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
            ->assertSessionHasErrors(['name', 'email', 'subject', 'message']);

        $this->assertDatabaseCount('contact_messages', 0);
    }

    public function test_honeypot_field_blocks_spam(): void
    {
        $this->from(route('contact.create'))
            ->post(route('contact.store'), [
                'name' => 'Spam Bot',
                'email' => 'spam@example.com',
                'subject' => 'Spam',
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
