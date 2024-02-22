<?php

declare(strict_types=1);

namespace Core;

/**
 * AppFactory
 * -----------
 * AppFactory
 *
 * @author Khaerul Anas <anasikova@gmail.com>
 * @since v1.0.0
 * @package Core
 */
class AppFactory 
{
    private static ?App $app = null;    
    /**
     * create
     *
     * @param  mixed $configDir
     * @return App
     */
    public static function create(string $configDir = 'app/config'): App
    {
        if(static::$app === null){
            static::$app = new App($configDir);
        }
        return static::$app;
    }
}