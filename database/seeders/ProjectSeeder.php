<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Seed the telecom infrastructure portfolio.
     */
    public function run(): void
    {
        $projects = [
            [
                'title' => 'Implantação ERB Greenfield 5G — Cluster Norte',
                'slug' => 'implantacao-erb-greenfield-5g',
                'client' => 'Operadora Tier 1',
                'summary' => 'Implantação e comissionamento de ERB Greenfield 5G com infraestrutura completa, energia e transmissão.',
                'description' => 'Conduzimos a implantação de uma nova ERB Greenfield para expansão de cobertura 5G em região de alta demanda. O escopo envolveu mobilização de equipe, montagem de infraestrutura, instalação de equipamentos RAN, energia, transmissão e comissionamento assistido.'."\n\n".'A entrega foi concluída dentro do prazo, com zero incidente de segurança, relatório fotográfico completo e as-built validado pela operadora.',
                'technologies' => ['5G NR', 'Greenfield', 'Comissionamento', 'EHS'],
                'is_featured' => true,
                'is_active' => true,
                'completed_at' => '2026-08-20',
                'sort_order' => 1,
            ],
            [
                'title' => 'Swap de Rede RAN 4G/5G em 120 Sites',
                'slug' => 'swap-ran-4g-5g',
                'client' => 'Operadora Nacional',
                'summary' => 'Modernização de rede RAN em 120 sites com janelas controladas, rollback e acompanhamento de KPIs.',
                'description' => 'Coordenamos o swap de equipamentos RAN em 120 sites distribuídos em três estados. O projeto incluiu planejamento por cluster, gestão de dependências, janelas de manutenção noturnas e critérios de rollback para reduzir risco operacional.'."\n\n".'A operação foi executada com acompanhamento diário de KPIs, validação pós-swap e consolidação de evidências para aceite técnico, mantendo a indisponibilidade dentro dos limites acordados.',
                'technologies' => ['Swap RAN', '4G/5G', 'Rollback', 'KPI'],
                'is_featured' => true,
                'is_active' => true,
                'completed_at' => '2026-05-12',
                'sort_order' => 2,
            ],
            [
                'title' => 'Auditoria EHS e Qualidade em 480 Sites',
                'slug' => 'auditoria-ehs-qualidade',
                'client' => 'Torre Company',
                'summary' => 'Auditoria técnica e de segurança em 480 sites com diagnóstico por severidade e plano de ação.',
                'description' => 'Executamos auditorias de EHS e qualidade em 480 sites de infraestrutura, cobrindo condições de acesso, estruturas, instalações elétricas, aterramento, sinalização e conformidade documental.'."\n\n".'Os desvios foram classificados por severidade e consolidados em um plano de ação priorizado, com evidências objetivas e acompanhamento de correções junto às equipes responsáveis.',
                'technologies' => ['Auditoria EHS', 'FAM', 'Qualidade', 'As-built'],
                'is_featured' => true,
                'is_active' => true,
                'completed_at' => '2025-11-30',
                'sort_order' => 3,
            ],
            [
                'title' => 'Site Survey e Viabilidade para Expansão 5G',
                'slug' => 'site-survey-expansao-5g',
                'client' => 'Provedor Regional',
                'summary' => 'Levantamento de 60 candidatos a site com análise de viabilidade técnica, civil, elétrica e de transmissão.',
                'description' => 'Realizamos site surveys em 60 candidatos para expansão de rede 5G, avaliando condições de infraestrutura, acesso, energia, transmissão e restrições construtivas. Cada site recebeu relatório fotográfico e parecer de viabilidade.'."\n\n".'A análise permitiu priorizar os sites com melhor relação custo-benefício e reduzir retrabalho na etapa de projeto executivo.',
                'technologies' => ['Site Survey', 'Viabilidade', '5G', 'Relatório técnico'],
                'is_featured' => false,
                'is_active' => true,
                'completed_at' => '2025-09-18',
                'sort_order' => 4,
            ],
            [
                'title' => 'Regularização e As-Built de Infraestrutura',
                'slug' => 'regularizacao-as-built',
                'client' => 'Operadora Regional',
                'summary' => 'Recomposição documental de 85 sites com atualização de as-built e inventário de ativos.',
                'description' => 'Organizamos o dossiê técnico de 85 sites, atualizando as-built, memoriais, inventário de ativos e evidências de conformidade. O trabalho incluiu visita de campo para validação das informações e padronização dos documentos.'."\n\n".'O acervo final foi entregue em formato digital rastreável, facilitando auditorias, manutenções e futuras expansões.',
                'technologies' => ['As-built', 'Documentação', 'Inventário', 'Auditoria'],
                'is_featured' => false,
                'is_active' => true,
                'completed_at' => '2025-06-25',
                'sort_order' => 5,
            ],
            [
                'title' => 'Manutenção Preventiva de ERBs — Contrato O&M',
                'slug' => 'manutencao-preventiva-erbs',
                'client' => 'Torre Company',
                'summary' => 'Contrato de O&M preventivo em 90 ERBs com rotinas programadas e atendimento a emergências.',
                'description' => 'Assumimos o contrato de manutenção preventiva de 90 ERBs, com rotinas periódicas de inspeção, testes de sistemas de energia, verificação de alarmes e conservação de infraestrutura.'."\n\n".'O modelo incluiu atendimento a emergências com SLA definido, registro digital das intervenções e reporte mensal de indicadores de disponibilidade.',
                'technologies' => ['O&M', 'Preventiva', 'SLA', 'Energia'],
                'is_featured' => false,
                'is_active' => true,
                'completed_at' => '2025-03-10',
                'sort_order' => 6,
            ],
        ];

        foreach ($projects as $project) {
            Project::updateOrCreate(
                ['slug' => $project['slug']],
                $project,
            );
        }
    }
}
