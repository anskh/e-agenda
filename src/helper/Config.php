<?php

declare(strict_types=1);

namespace Core\Helper;

use Core\Config\Config as Container;
use Core\Config\ConfigFactory;
use Exception;

/**
 * Config
 * -----------
 * Class for working with @see Core\Config\Config
 *
 * @author Khaerul Anas <anasikova@gmail.com>
 * @since v1.0.0
 * @package Core\Helper
 */
class Config
{
    private static ?Container $container = null;
    
    /**
     * init
     *
     * @param  mixed $configDir
     * @param  mixed $environment
     * @return void
     */
    public static function init(string $configDir, string $environment): void
    {
        if (static::$container === null) {
            static::$container = ConfigFactory::create($configDir, $environment);
        }
    }
    
    /**
     * get
     *
     * @param  mixed $offset
     * @param  mixed $defaultValue
     * @return mixed
     */
    public static function get(mixed $offset, mixed $defaultValue = null): mixed
    {
        if (static::$container === null) {
            throw new Exception('Init config by calling init method first.');
        }
        return static::$container[$offset] ?? $defaultValue;
    }
    
    /**
     * set
     *
     * @param  mixed $offset
     * @param  mixed $value
     * @return void
     */
    public static function set(mixed $offset, mixed $value): void
    {
        if (static::$container === null) {
            throw new Exception('Init config by calling init method first.');
        }
        static::$container[$offset] = $value;
    }
    
    /**
     * has
     *
     * @param  mixed $offset
     * @return bool
     */
    public static function has(mixed $offset): bool
    {
        if (static::$container === null) {
            throw new Exception('Init config by calling init method first.');
        }
        return static::$container->offsetExists($offset);
    }   
}
