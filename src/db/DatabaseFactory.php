<?php

declare(strict_types=1);

namespace Core\Db;

use Core\Helper\Config;

/**
 * Database factory
 * -----------
 * Database factory to create instance of 
 * Database class
 *
 * @author Khaerul Anas <anasikova@gmail.com>
 * @since v1.0.0
 * @package Core\Db
 */
class DatabaseFactory
{
    private static array $db = [];
    
    /**
     * create
     *
     * @param  mixed $name
     * @return Database
     */
    static public function create(string $name): Database
    {
        if(!array_key_exists($name, static::$db)){
            $config = Config::get("db.connections.{$name}");
            $dsn = $config['dsn'];
            $user = $config['user'];
            $pass = $config['password'];
            $prefix = $config['prefix'];
            $options = $config['options'];
            static::$db[$name] = new Database($name, $dsn, $user, $pass, $prefix, $options);
        }
        return static::$db[$name];
    } 
}