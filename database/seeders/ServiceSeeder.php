<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Seed the services.
     */
    public function run(): void
    {
        $services = [
            [
                'title' => 'Desenvolvimento Web',
                'slug' => 'desenvolvimento-web',
                'icon' => 'code',
                'summary' => 'Sites institucionais, landing pages e aplicações web rápidas, acessíveis e prontas para crescer.',
                'description' => 'Criamos experiências digitais completas, do layout à publicação. Trabalhamos com Laravel, Livewire e Tailwind CSS para entregar aplicações seguras, performáticas e alinhadas à identidade da sua marca.',
                'sort_order' => 1,
            ],
            [
                'title' => 'Sistemas sob medida',
                'slug' => 'sistemas-sob-medida',
                'icon' => 'automation',
                'summary' => 'Automatize processos e centralize informações em um sistema feito para a realidade da sua empresa.',
                'description' => 'Analisamos seus fluxos de trabalho e construímos sistemas que eliminam retrabalho e dão visibilidade ao negócio. Painéis administrativos, relatórios, integrações e controle de acesso em um só lugar.',
                'sort_order' => 2,
            ],
            [
                'title' => 'APIs e integrações',
                'slug' => 'apis-e-integracoes',
                'icon' => 'cloud',
                'summary' => 'Conecte seus sistemas, ERPs e serviços externos com APIs seguras, documentadas e resilientes.',
                'description' => 'Projetamos APIs REST e integrações com serviços de pagamento, mensageria, CRM e ERPs. Documentação clara, testes automatizados e monitoramento para que tudo continue funcionando.',
                'sort_order' => 3,
            ],
            [
                'title' => 'Aplicativos mobile',
                'slug' => 'aplicativos-mobile',
                'icon' => 'mobile',
                'summary' => 'Leve sua solução para o bolso do cliente com aplicativos multiplataforma.',
                'description' => 'Desenvolvemos aplicativos para Android e iOS com foco em usabilidade e desempenho. Do protótipo à publicação nas lojas, cuidando também de notificações e integrações.',
                'sort_order' => 4,
            ],
            [
                'title' => 'Consultoria em tecnologia',
                'slug' => 'consultoria-em-tecnologia',
                'icon' => 'chart',
                'summary' => 'Diagnóstico técnico, arquitetura e apoio estratégico para decisões de tecnologia mais seguras.',
                'description' => 'Revisamos arquitetura, código e infraestrutura para identificar riscos e oportunidades. Ajudamos seu time a priorizar o que gera mais valor e a evoluir com consistência.',
                'sort_order' => 5,
            ],
            [
                'title' => 'Segurança e infraestrutura',
                'slug' => 'seguranca-e-infraestrutura',
                'icon' => 'shield',
                'summary' => 'Ambientes estáveis, monitorados e protegidos para sua aplicação crescer sem surpresas.',
                'description' => 'Configuramos servidores, deploy automatizado, backups e monitoramento. Aplicamos boas práticas de segurança para proteger dados e manter a operação disponível.',
                'sort_order' => 6,
            ],
        ];

        foreach ($services as $service) {
            Service::updateOrCreate(
                ['slug' => $service['slug']],
                [...$service, 'is_active' => true],
            );
        }
    }
}
