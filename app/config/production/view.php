<?php

declare(strict_types=1);

return [
    'engine' => 'plain', // options plain, plates, blade, twig
    'path' => 'resource/flatmin',
    'plain' => [
        'extension' => '.php'
    ],
    'plates' => [
        'extension' => 'phtml'
    ],
    'twig' => [
        'extension' => '.html.twig'
    ],
    'blade' => [
        'extension' => '.blade.php',
        'cache_path' => 'writeable/view'
    ]
];
