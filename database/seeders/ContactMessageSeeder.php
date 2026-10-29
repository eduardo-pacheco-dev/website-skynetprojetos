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
                [
                    'name' => 'Mariana Costa',
                    'company' => 'Aurora Telecom',
                    'email' => 'mariana@example.com',
                    'service_interest' => 'Vistoria técnica / Site Survey',
                    'subject' => 'Vistoria técnica / Site Survey',
                    'read_at' => null,
                ],
                [
                    'name' => 'Rafael Almeida',
                    'company' => 'Norte Towers',
                    'email' => 'rafael@example.com',
                    'service_interest' => 'Projeto de Swap',
                    'subject' => 'Projeto de Swap',
                    'read_at' => now(),
                ],
                [
                    'name' => 'Juliana Prado',
                    'company' => 'Conecta Regional',
                    'email' => 'juliana@example.com',
                    'service_interest' => 'Implantação de ERB',
                    'subject' => 'Implantação de ERB',
                    'read_at' => null,
                ],
            )
            ->create();
    }
}
