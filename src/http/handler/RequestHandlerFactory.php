<?php

declare(strict_types=1);

namespace Core\Http\Handler;

use Psr\Http\Message\ResponseInterface;

/**
 * RequestHandlerFactory
 * -----------
 * RequestHandlerFactory
 *
 * @author Khaerul Anas <anasikova@gmail.com>
 * @since v1.0.0
 * @package Core\Http\Handler
 */
class RequestHandlerFactory
{  
    /**
     * create
     *
     * @param  mixed $middleware
     * @param  mixed $response
     * @return RequestHandler
     */
    public static function create(array $middleware, ResponseInterface $response): RequestHandler
    {
        return new RequestHandler($middleware, $response);
    }
}
