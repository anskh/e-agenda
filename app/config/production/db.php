<?php

declare(strict_types=1);

return [
    'connections' => [
        'default' => [
            'dsn' => 'mysql:host=localhost;dbname=eagenda;',
            'user' => 'root',
            'password' => 'root',
            'prefix' => 'dbo_',
            'options' => [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]
        ]
    ]
];
