<?php

declare(strict_types=1);

use Dotenv\Dotenv;
use Core\AppFactory;

chdir(dirname(__DIR__));

require 'vendor/autoload.php';

Dotenv::createImmutable(dirname(__DIR__))->load();
AppFactory::create()->run();
