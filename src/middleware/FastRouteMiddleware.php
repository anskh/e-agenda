<?php

declare(strict_types=1);

namespace Core\Middleware;

use FastRoute\Dispatcher;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Core\Exception\MethodNotAllowed;
use Core\Exception\RouteNotFound;
use Core\Http\Router\Router;

/**
 * FastRouteMiddleware
 * -----------
 * FastRouteMiddleware
 *
 * @author Khaerul Anas <anasikova@gmail.com>
 * @since v1.0.0
 * @package Core\Middleware
 */
class FastRouteMiddleware implements MiddlewareInterface
{    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * @throws MethodNotAllowed
     * @throws RouteNotFound
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $request = $this->routeRequest($request);

        return $handler->handle($request);
    }
    
    /**
     * routeRequest
     *
     * @param  mixed $request
     * @return ServerRequestInterface
     */
    private function routeRequest(ServerRequestInterface $request): ServerRequestInterface
    {
        $router = new Router();
        $fastRoute = $router->getDispatcher();

        $path = $request->getUri()->getPath();
        if (str_contains($path, '/public/')) {
            $path = str_replace('/public', '', $path);
        }
        $route = $fastRoute->dispatch($request->getMethod(), $path);

        if ($route[0] === Dispatcher::NOT_FOUND) {
            throw new RouteNotFound($request->getUri()->getPath());
        }

        if ($route[0] === Dispatcher::METHOD_NOT_ALLOWED) {
            throw new MethodNotAllowed($request->getMethod());
        }

        foreach ($route[2] as $name => $value) {
            $request = $request->withAttribute($name, $value);
        }

        $request = $request->withAttribute('__action', $route[1]);

        return $request;
    }
}
