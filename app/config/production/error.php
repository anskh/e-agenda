<?php

declare(strict_types=1);

use Psr\Http\Message\ResponseInterface;

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
        $response->getBody()->write($e->getMessage());
        return $response->withStatus(500);
    }
];
