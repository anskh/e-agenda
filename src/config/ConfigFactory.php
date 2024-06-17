<?php

declare(strict_types=1);

namespace Core\Config;

use ArrayAccess;
use Core\Config\ConfigInterface;

/**
 * ConfigFactory
 *
 * @author Khaerul Anas <anasikova@gmail.com>
 * @since v1.0.0
 * @package Core\Config
 */
class ConfigFactory
{
    private static ?ArrayAccess $config = null;
    
    /**
     * create
     *
     * @param  mixed $configDir
     * @param  mixed $environment
     * @param  mixed $initialConfig
     * @return ArrayAccess
     */
    public static function create(string $configDir, string $environment, array $initialConfig = []) : ArrayAccess
    {
        if(static::$config === null){
            static::$config = new Config($configDir, $environment, $initialConfig);
        }
        return static::$config;
    }
}