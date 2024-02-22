<?php declare(strict_types=1);

use App\Middleware\AuthMiddleware;
use Core\Middleware\DispatcherMiddleware;
use Core\Middleware\FastRouteMiddleware;
use Core\Middleware\SessionMiddleware;

return [
    'middleware' => [
        ['id' => 'fastroute', 'middleware' => new FastRouteMiddleware()],
        ['id' => 'session', 'middleware' => new SessionMiddleware()],
        ['id' => 'auth', 'middleware' => new AuthMiddleware()],
        ['id' => 'dispatcher', 'middleware' => new DispatcherMiddleware()]
    ],
];