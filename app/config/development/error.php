<?php

declare(strict_types=1);

use Psr\Http\Message\ResponseInterface;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

return [
    '403' => function (Throwable $e, ResponseInterface $response) {
        $response->getBody()->write($e->getMessage());
        return $response->withStatus(403);
    },
    '404' => function (Throwable $e, ResponseInterface $response) {
        $response->getBody()->write($e->getMessage());
        return $response->withStatus(404);
    },
    '500' => function (Throwable $e, ResponseInterface $response) {
        $whoops = new Run();
        $whoops->allowQuit(false);
        $whoops->writeToOutput(false);
        $whoops->pushHandler(new PrettyPageHandler());
        $output = $whoops->handleException($e);
        $response->getBody()->write($output);
        return $response->withStatus(500);
    }
];
