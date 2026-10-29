<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Seed the telecom engineering services.
     */
    public function run(): void
    {
        $services = [
            [
                'title' => 'Vistorias Técnicas (Site Surveys)',
                'slug' => 'vistorias-tecnicas',
                'icon' => 'survey',
                'summary' => 'Levantamento detalhado de campo, viabilidade técnica e relatórios precisos de infraestrutura para expansão e regularização de sites.',
                'description' => 'Executamos vistorias técnicas completas em sites de telecomunicações, avaliando infraestrutura civil, elétrica, transmissão, rádio e condições de segurança. O levantamento inclui medições, registros fotográficos, identificação de não conformidades e análise de viabilidade para implantação ou modernização.'."\n\n".'Cada vistoria gera um relatório estruturado com evidências, matriz de pendências e recomendações técnicas, permitindo decisões mais seguras sobre CAPEX, cronograma e priorização de intervenções.',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Implantação de ERBs',
                'slug' => 'implantacao-de-erbs',
                'icon' => 'tower',
                'summary' => 'Instalação, comissionamento e montagem completa de Estações Rádio Base em ambientes Greenfield e Rooftop.',
                'description' => 'Conduzimos a implantação de ERBs do recebimento do site à entrega operacional, incluindo montagem de infraestrutura, instalação de equipamentos, cabeamento, energia, transmissão e comissionamento. Atuamos em sites Greenfield e Rooftop com planejamento de mobilização, controle de materiais e gestão de segurança em campo.'."\n\n".'A execução segue procedimentos técnicos e requisitos das operadoras, com validação de qualidade, registro de evidências e entrega de as-built e documentação final.',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'Projetos de Swap',
                'slug' => 'projetos-de-swap',
                'icon' => 'swap',
                'summary' => 'Modernização e substituição tecnológica de equipamentos de rede com planejamento de rollback e mínima indisponibilidade.',
                'description' => 'Planejamos e executamos projetos de swap de equipamentos RAN e infraestrutura, coordenando janelas de manutenção, dependências e critérios de rollback. O objetivo é modernizar a rede com controle de risco e impacto mínimo na operação.'."\n\n".'O escopo inclui levantamento prévio, plano de execução por site, acompanhamento de KPIs, validação pós-swap e consolidação de evidências para aceite técnico.',
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'title' => 'Auditorias de Conformidade & Qualidade',
                'slug' => 'auditorias-de-conformidade',
                'icon' => 'audit',
                'summary' => 'Checagem rigorosa de padrões EHS, guias FAM e validação de instalações de redes sem fio e RAN.',
                'description' => 'Realizamos auditorias independentes de conformidade e qualidade em sites e projetos de telecomunicações. Avaliamos aderência a requisitos de EHS, guias FAM, normas aplicáveis e padrões técnicos das operadoras, com foco em segurança, integridade da instalação e qualidade documental.'."\n\n".'O resultado é um diagnóstico claro, classificado por severidade, com evidências objetivas e plano de ação para correção de desvios.',
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'title' => 'Manutenção e O&M',
                'slug' => 'manutencao-e-om',
                'icon' => 'maintenance',
                'summary' => 'Sustentação de sites, manutenção preventiva e corretiva e resposta a emergências em infraestrutura crítica.',
                'description' => 'Oferecemos suporte de O&M para manter a disponibilidade e a integridade de sites de telecomunicações. Atuamos em rotinas preventivas, corretivas e atendimento a emergências, com acionamento estruturado, diagnóstico e registro completo das intervenções.'."\n\n".'O modelo pode ser dimensionado por contrato, região ou criticidade, com SLA definido e reporte periódico de indicadores operacionais.',
                'is_active' => true,
                'sort_order' => 5,
            ],
            [
                'title' => 'Documentação Técnica e As-Built',
                'slug' => 'documentacao-tecnica',
                'icon' => 'docs',
                'summary' => 'Organização de dossiês, regularização de sites e atualização de as-built com rastreabilidade completa.',
                'description' => 'Estruturamos e atualizamos a documentação técnica de sites e projetos, incluindo as-built, memoriais, inventário de ativos, evidências fotográficas e registros de conformidade. O objetivo é eliminar lacunas documentais e facilitar auditorias, manutenção e expansão futura.'."\n\n".'Todo o acervo é organizado de forma digital e rastreável, com padronização de nomenclatura e controle de versões.',
                'is_active' => true,
                'sort_order' => 6,
            ],
        ];

        foreach ($services as $service) {
            Service::updateOrCreate(
                ['slug' => $service['slug']],
                $service,
            );
        }
    }
}
