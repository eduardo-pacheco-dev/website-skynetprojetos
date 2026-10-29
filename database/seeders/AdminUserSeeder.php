<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Seed the administrator account.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@skynetprojetos.com.br'],
            [
                'name' => 'Administrador',
                'password' => 'password',
                'email_verified_at' => now(),
            ],
        );
    }
}
