<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Seed the portfolio projects.
     */
    public function run(): void
    {
        $projects = [
            [
                'title' => 'Portal do Cliente',
                'slug' => 'portal-do-cliente',
                'client' => 'Grupo Aurora',
                'summary' => 'Portal centralizado para acompanhamento de contratos, faturas e solicitações de atendimento.',
                'description' => 'Substituímos planilhas e e-mails por um portal completo, com autenticação, controle de permissões, histórico de solicitações e relatórios em tempo real. A solução reduziu em 60% o tempo de resposta do atendimento.',
                'technologies' => ['Laravel', 'Livewire', 'Tailwind CSS', 'MySQL'],
                'is_featured' => true,
                'completed_at' => '2026-03-15',
                'sort_order' => 1,
            ],
            [
                'title' => 'Plataforma de E-commerce',
                'slug' => 'plataforma-de-ecommerce',
                'client' => 'Casa Verde',
                'summary' => 'Loja virtual com catálogo integrado, checkout transparente e gestão de pedidos.',
                'description' => 'Desenvolvemos uma loja completa integrada ao ERP do cliente, com controle de estoque, cupons, cálculo de frete e painel administrativo. O projeto priorizou velocidade de carregamento e uma jornada de compra simples.',
                'technologies' => ['Laravel', 'Vue.js', 'Stripe', 'Redis'],
                'is_featured' => true,
                'project_url' => 'https://example.com/ecommerce',
                'completed_at' => '2025-11-20',
                'sort_order' => 2,
            ],
            [
                'title' => 'Dashboard Logístico',
                'slug' => 'dashboard-logistico',
                'client' => 'Rota Certa',
                'summary' => 'Painel operacional para acompanhamento de entregas, rotas e indicadores de desempenho.',
                'description' => 'Centralizamos dados de rastreamento e operação em um dashboard interativo, com mapas, filtros por período e alertas automáticos para atrasos. A diretoria passou a acompanhar os indicadores em tempo real.',
                'technologies' => ['Laravel', 'Chart.js', 'PostgreSQL', 'Docker'],
                'is_featured' => true,
                'completed_at' => '2025-08-10',
                'sort_order' => 3,
            ],
            [
                'title' => 'Aplicativo de Agendamentos',
                'slug' => 'aplicativo-de-agendamentos',
                'client' => 'Clínica Vitalis',
                'summary' => 'Aplicativo para agendamento de consultas, lembretes e histórico do paciente.',
                'description' => 'Criamos um aplicativo multiplataforma integrado à agenda da clínica, com notificações push, confirmação automática e área do paciente. O índice de faltas caiu 35% após o lançamento.',
                'technologies' => ['React Native', 'Laravel', 'Firebase'],
                'completed_at' => '2025-05-02',
                'sort_order' => 4,
            ],
            [
                'title' => 'Integração Fiscal',
                'slug' => 'integracao-fiscal',
                'client' => 'Norte Distribuidora',
                'summary' => 'Automação da emissão de notas fiscais integrada ao ERP e ao faturamento.',
                'description' => 'Construímos uma camada de integração entre o ERP e a API fiscal, com fila de processamento, reprocessamento automático e painel de acompanhamento. O fechamento mensal ficou três vezes mais rápido.',
                'technologies' => ['Laravel', 'Filament', 'Redis', 'AWS'],
                'completed_at' => '2024-12-18',
                'sort_order' => 5,
            ],
            [
                'title' => 'Website Institucional',
                'slug' => 'website-institucional',
                'client' => 'Estúdio Horizonte',
                'summary' => 'Website responsivo com portfólio, blog e painel administrativo para gestão de conteúdo.',
                'description' => 'Projetamos e desenvolvemos um site leve, otimizado para mecanismos de busca e fácil de atualizar. O painel administrativo permite publicar projetos e artigos sem apoio técnico.',
                'technologies' => ['Laravel', 'Filament', 'Tailwind CSS'],
                'completed_at' => '2024-09-30',
                'sort_order' => 6,
            ],
        ];

        foreach ($projects as $project) {
            Project::updateOrCreate(
                ['slug' => $project['slug']],
                [...$project, 'is_active' => true],
            );
        }
    }
}
