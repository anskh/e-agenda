<?php

declare(strict_types=1);

namespace Core\Http\Handler;

use Core\Helper\Service;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * RequestHandler
 * -----------
 * RequestHandler adopt mechanism from Harmoni
 * @see www.github.com/whohoolabs/harmony
 *
 * @author Khaerul Anas <anasikova@gmail.com>
 * @since v1.0.0
 * @package Core\Http\Handler
 */
class RequestHandler implements RequestHandlerInterface
{
    private ServerRequestInterface $request;
    private int $currentMiddleware;

    /**
     * __construct
     *
     * @param  mixed $middleware
     * @return void
     */
    public function __construct(private array $middleware, private ResponseInterface $response)
    {
        $this->currentMiddleware = -1;
    }

    /**
     * @inheritdoc
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $this->request = Service::request($request);
        $this->currentMiddleware++;

        if (array_key_exists($this->currentMiddleware, $this->middleware) === true) {
            $this->executeMiddleware($this->middleware[$this->currentMiddleware]);
        }

        return $this->response;
    }

    /**
     * addMiddleware
     *
     * @param  mixed $middleware
     * @param  mixed $id
     * @return static
     */
    public function addMiddleware(MiddlewareInterface $middleware, ?string $id = null): static
    {
        $this->middleware[] = [
            "id" => $id,
            "middleware" => $middleware,
        ];

        return $this;
    }

    /**
     * @param array<string, mixed> $middlewareArray
     * @return Psr\Http\Message\ServerRequestInterface
     */
    private function executeMiddleware(array $middlewareArray): void
    {
        /** @var MiddlewareInterface $middleware */
        $middleware = $middlewareArray["middleware"];

        $this->response = Service::response($middleware->process($this->request, $this));
    }
}
