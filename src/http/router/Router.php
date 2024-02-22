<?php

declare(strict_types=1);

namespace Core\Http\Router;

use FastRoute\Dispatcher;
use FastRoute\RouteCollector;
use Core\Helper\Config;
use Core\Helper\Url;

use function FastRoute\simpleDispatcher;

/**
 * Router
 * -----------
 * Router
 *
 * @author Khaerul Anas <anasikova@gmail.com>
 * @since v1.0.0
 * @package Core\Http\Router
 */
class Router
{
    private array $routes = [];
    private string $basePath = '';
    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->basePath = Url::getBasePath();
        $this->routes = Config::get('route');
    }    
    /**
     * getDispatcher
     *
     * @return Dispatcher
     */
    public function getDispatcher(): Dispatcher
    {
        $routes = $this->routes;
        $basePath = $this->basePath;
        $dispatcher = simpleDispatcher(function (RouteCollector $r) use ($routes, $basePath) {
            foreach ($routes as $name => $route) {
                list($method, $path, $handler) = $route;
                $path = $basePath . $path;
                $r->addRoute($method, $path, $handler);
            }
        });
        return $dispatcher;
    }
}
