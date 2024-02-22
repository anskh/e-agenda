<?php declare(strict_types=1);

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

return [
    'hello' => ['GET', '/hello', function (ServerRequestInterface $request, ResponseInterface $response){
        $response->getBody()->write('Hello, you are in '. $request->getUri()->getPath());

        return $response->withStatus(200);
    }]
];