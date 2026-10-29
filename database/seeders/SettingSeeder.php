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
            'tagline' => 'Engenharia de Telecomunicações e Infraestrutura de Alta Performance',
            'hero_title' => 'Excelência e precisão em infraestrutura e engenharia de telecomunicações',
            'hero_subtitle' => 'Vistorias técnicas, implantação de ERBs, projetos de swap e auditorias de conformidade para operadoras, torre companies e provedores em todo o Brasil.',
            'about_title' => 'Engenharia de campo com segurança, conformidade e rastreabilidade',
            'about_text' => 'A SkyNet Projetos atua em engenharia de telecomunicações e infraestrutura de alta performance, apoiando operadoras, torre companies e provedores em vistorias, implantações, swap e auditorias de conformidade em todo o Brasil.',
            'email' => 'contato@skynetprojetos.com.br',
            'phone' => '+55 (11) 99999-0000',
            'whatsapp' => '5511999990000',
            'address' => 'Atendimento nacional — Brasil',
            'linkedin_url' => 'https://www.linkedin.com/',
            'github_url' => 'https://github.com/',
            'instagram_url' => 'https://www.instagram.com/',
            'stat_projects' => '1200',
            'stat_clients' => '350',
            'stat_years' => '18',
            'ga_measurement_id' => '',
        ];

        Setting::setMany($settings);
    }
}
