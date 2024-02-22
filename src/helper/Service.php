<?php

declare(strict_types=1);

namespace Core\Helper;

use Core\Http\Session\Session;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Service
 * -----------
 * Class for helping access service component
 *
 * @author Khaerul Anas <anasikova@gmail.com>
 * @since v1.0.0
 * @package Core\Helper
 */
class Service
{
    protected static ?ServerRequestInterface $request = null;
    protected static ?ResponseInterface $response = null;

    /**
     * request
     *
     * @param  mixed $request
     * @return ServerRequestInterface
     */
    public static function request(?ServerRequestInterface $request = null): ServerRequestInterface
    {
        if($request){
            static::$request = $request;
        }
        return static::$request;
    }    
    /**
     * response
     *
     * @param  mixed $response
     * @return ResponseInterface
     */
    public static function response(?ResponseInterface $response = null): ResponseInterface
    {
        if($response){
            static::$response = $response;
        }
        return static::$response;
    }
    
    /**
     * session
     *
     * @return Session
     */
    public static function session(): Session
    {
        return static::$request->getAttribute('__session');
    }
}