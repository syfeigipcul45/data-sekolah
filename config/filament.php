<?php

use Filament\Panel;

return [
    'default' => 'admin',

    'panels' => [
        'admin' => [
            'path' => 'admin',
            'brand' => 'SIAKAD',
            'brandLogo' => null,
            'favicon' => null,
            'auth' => [
                'guard' => 'web',
            ],
            'globalSearch' => false, // Disable global search
            'navigation' => [
                'enabled' => true,
                'collapseOnMobile' => true,
                'isCollapsed' => false,
            ],
            'topNavigation' => false,
            'sidebarCollapsibleOnDesktop' => true,
            'databaseNotifications' => [
                'enabled' => false,
                'polling' => '30s',
            ],
            'broadcasting' => [
                'enabled' => false,
            ],
        ],
    ],
];
