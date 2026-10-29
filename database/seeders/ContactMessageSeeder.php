<?php

namespace Database\Seeders;

use App\Models\ContactMessage;
use Illuminate\Database\Seeder;

class ContactMessageSeeder extends Seeder
{
    /**
     * Seed a few contact messages for the admin inbox.
     */
    public function run(): void
    {
        ContactMessage::factory()
            ->count(3)
            ->sequence(
                ['name' => 'Mariana Costa', 'email' => 'mariana@example.com', 'subject' => 'Orçamento para sistema interno', 'read_at' => null],
                ['name' => 'Rafael Almeida', 'email' => 'rafael@example.com', 'subject' => 'Integração com ERP', 'read_at' => now()],
                ['name' => 'Juliana Prado', 'email' => 'juliana@example.com', 'subject' => 'Site institucional', 'read_at' => null],
            )
            ->create();
    }
}
