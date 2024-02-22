<?php

declare(strict_types=1);

chdir(__DIR__);
require __DIR__ . "/vendor/autoload.php";

use Core\Db\MigrationContainer;
use Core\Helper\Config;
use Dotenv\Dotenv;

Dotenv::createImmutable(__DIR__)->load();

$action = null;
if ($argc > 1) {
    $action = $argv[1];
}

if (!in_array($action, ['up', 'down', 'seed'], true)) {
    die('Argument is invalid. Available arguments are up, seed, or down');
}

// init config
Config::init(configDir: 'app/config', environment: $_ENV['APP_ENV'] ?? 'development');

// build migration
$container = new MigrationContainer(action: $action,connection:$_ENV['DB_CONNECTION'] ?? 'default');
$container->applyMigration();
