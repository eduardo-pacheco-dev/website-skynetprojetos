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
            'site_name' => 'SkyNet Projetos',
            'tagline' => 'Tecnologia sob medida para o seu negócio',
            'hero_title' => 'Transformamos ideias em software que gera resultados',
            'hero_subtitle' => 'Desenvolvemos sites, sistemas e aplicações web sob medida, com foco em performance, segurança e experiência do usuário.',
            'about_title' => 'Tecnologia com propósito, do planejamento ao lançamento',
            'about_text' => 'A SkyNet Projetos é uma software house focada em criar soluções digitais que resolvem problemas reais. Unimos estratégia, design e engenharia para entregar produtos robustos, escaláveis e fáceis de manter.',
            'email' => 'contato@skynetprojetos.com.br',
            'phone' => '+55 (11) 99999-0000',
            'whatsapp' => '5511999990000',
            'address' => 'São Paulo, SP — Brasil',
            'linkedin_url' => 'https://www.linkedin.com/',
            'github_url' => 'https://github.com/',
            'instagram_url' => 'https://www.instagram.com/',
            'stat_projects' => '80',
            'stat_clients' => '40',
            'stat_years' => '10',
            'ga_measurement_id' => '',
        ];

        Setting::setMany($settings);
    }
}
