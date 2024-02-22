<?php

declare(strict_types=1);

namespace Core\Config;

use Core\Abstraction\FactoryInterface;
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
    private static ?ConfigInterface $config = null;
    
    /**
     * create
     *
     * @param  mixed $configDir
     * @param  mixed $environment
     * @param  mixed $initialConfig
     * @return ConfigInterface
     */
    public static function create(string $configDir, string $environment, array $initialConfig = []) : ConfigInterface
    {
        if(static::$config === null){
            static::$config = new Config($configDir, $environment, $initialConfig);
        }
        return static::$config;
    }
}