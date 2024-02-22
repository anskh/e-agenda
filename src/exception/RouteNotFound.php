<?php declare(strict_types=1);

namespace Core\Exception;

use Exception;

/**
 * RouteNotFound
 * -----------
 * Class to define RouteNotFound exception
 *
 * @author Khaerul Anas <anasikova@gmail.com>
 * @since v1.0.0
 * @package Core\Exception
 */
class RouteNotFound extends Exception
{
    protected string $route;
    
    /**
     * __construct
     *
     * @param  mixed $route
     * @return void
     */
    public function __construct(string $route)
    {
        $this->route = $route;
        parent::__construct("Route '" . $route . "' can not be found!");
    }
    
    /**
     * getRoute
     *
     * @return string
     */
    public function getRoute(): string
    {
        return $this->route;
    }
}
