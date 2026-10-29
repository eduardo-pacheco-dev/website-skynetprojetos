<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Rastreamento de visitas
    |--------------------------------------------------------------------------
    |
    | O rastreamento próprio grava visualizações de página no banco de dados.
    | Ajuste os caminhos ignorados para não registrar o painel, APIs, assets
    | e endpoints internos do Laravel.
    |
    */

    'enabled' => env('ANALYTICS_ENABLED', true),

    'excluded_paths' => [
        'admin',
        'admin/*',
        'livewire/*',
        'api/*',
        'up',
        'storage/*',
        'build/*',
        'assets/*',
        'favicon.ico',
        'robots.txt',
    ],

    'track_bots' => false,

    'respect_do_not_track' => true,

    'retention_days' => 365,

    'bot_patterns' => [
        'bot',
        'crawl',
        'spider',
        'slurp',
        'facebookexternalhit',
        'headlesschrome',
        'lighthouse',
        'pagespeed',
        'pingdom',
        'uptimerobot',
    ],

];
