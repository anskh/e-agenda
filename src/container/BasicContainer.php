<?php declare(strict_types=1);

namespace Core\Container;

use Psr\Container\ContainerInterface;

/**
 * Basic container
 * -----------
 * Basic container for get instance of class
 * based on full qualified name
 *
 * @author Khaerul Anas <anasikova@gmail.com>
 * @since v1.0.0
 * @package Core\Container
 */
class BasicContainer implements ContainerInterface 
{
    private array $container = [];

    /**
     * @inheritdoc
     */
    public function get(string $id)
    {
        if($this->has($id)){
            return $this->container[$id];
        }

        throw new \Exception("Class {$id} doesn't exists.");
    }

    /**
     * @inheritdoc
     */
    public function has(string $id): bool
    {
        if(class_exists($id)){
            $this->container[$id] = new $id();
            return true;
        }

        return false;
    }
}