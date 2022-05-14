<?php


return
[
    'paths' => [
        'migrations' => '%%PHINX_CONFIG_DIR%%/db/migrations',
        'seeds' => '%%PHINX_CONFIG_DIR%%/db/seeds'
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_environment' => 'development',
        'production' => [
            'name' => $dbname,
            'connection' => $pdo,
        ],
        'development' => [
            'name' => $dbname,
            'connection' => $pdo,
        ],
        'testing' => [
            'name' => $dbname,
            'connection' => $pdo,
        ]
    ],
    'version_order' => 'creation'
];
