<?php declare(strict_types=1);

namespace Core\Exception;

use Exception;

/**
 * MethodNotAllowed
 * -----------
 * Class to define MethodNotAllowed exception
 *
 * @author Khaerul Anas <anasikova@gmail.com>
 * @since v1.0.0
 * @package Core\Exception
 */
class MethodNotAllowed extends Exception
{
    protected string $method;
    
    /**
     * __construct
     *
     * @param  mixed $method
     * @return void
     */
    public function __construct(string $method)
    {
        $this->method = $method;
        parent::__construct("Method '" . $method . "' is not allowed!");
    }
    
    /**
     * getMethod
     *
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }
}
