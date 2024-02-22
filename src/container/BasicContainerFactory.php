<?php declare(strict_types=1);

namespace Core\Container;

/**
 * Basic container factory
 * -----------
 * Basic container factory to create instance of 
 * BasicContainer class
 *
 * @author Khaerul Anas <anasikova@gmail.com>
 * @since v1.0.0
 * @package Core\Container
 */
class BasicContainerFactory
{
    private static ?BasicContainer $container = null;
    
    /**
     * create
     *
     * @return BasicContainer
     */
    public static function create(): BasicContainer
    {
        if(static::$container === null){
            static::$container = new BasicContainer();
        }

        return static::$container;
    }
}