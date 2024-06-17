<?php

declare(strict_types=1);

if(getcwd()!== __DIR__){
    chdir(__DIR__);
}

require 'vendor/autoload.php';

Dotenv\Dotenv::createImmutable(__DIR__)->load();
Core\AppFactory::create()->run();
