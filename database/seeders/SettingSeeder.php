<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Seed the site settings.
     */
    public function run(): void
    {
        $settings = [
            'site_name' => 'Skynet Projetos e Consultoria',
            'tagline' => 'Rollout Documental & Qualidade para Redes 4G/5G',
            'hero_title' => 'Rollout Documental & Qualidade para Redes 4G/5G',
            'hero_subtitle' => 'Proposta técnica e operacional de excelência em engenharia de telecomunicações para a BST Networks.',
            'about_title' => 'Engenharia de telecomunicações com disciplina de campo',
            'about_text' => 'A Skynet Projetos e Consultoria atua em rollout documental, qualidade com DEC, engenharia de rádio frequência e vistorias técnicas para redes 4G/5G.',
            'email' => 'eduardo@skynetprojetos.com.br',
            'phone' => '+55 (91) 98438-7990',
            'whatsapp' => '5591984387990',
            'address' => 'Atendimento nacional — Brasil',
            'linkedin_url' => 'https://www.linkedin.com/',
            'github_url' => 'https://github.com/',
            'instagram_url' => 'https://www.instagram.com/',
            'stat_projects' => '1200',
            'stat_clients' => '350',
            'stat_years' => '18',
            'ga_measurement_id' => '',
            'construction_enabled' => '1',
            'construction_title' => 'Nosso novo site está em construção.',
            'construction_message' => 'Estamos preparando uma nova experiência digital para apresentar nossas soluções em engenharia de telecomunicações, rollout documental e qualidade.',
        ];

        Setting::setMany($settings);
    }
}
