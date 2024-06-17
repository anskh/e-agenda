<?php

declare(strict_types=1);

namespace Core\Helper;

/**
 * Url
 * -----------
 * Class for working with url
 *
 * @author Khaerul Anas <anasikova@gmail.com>
 * @since v1.0.0
 * @package Core\Helper
 */
class Url
{
    static ?string $basePath = null;
    static ?string $hostUrl = null;
    static ?array $parseurl = null;
    
    /**
     * getBasePath
     *
     * @param  mixed $path
     * @return string
     */
    public static function getBasePath(string $path = ''): string
    {
        if (static::$basePath === null) {
            if (array_key_exists('PATH_INFO', $_SERVER) === true) {
                $basePath = $_SERVER['PATH_INFO'];
            } else {
                $toReplace = '/' . basename($_SERVER['SCRIPT_FILENAME']);
                $basePath = str_replace($toReplace, '', $_SERVER['PHP_SELF']);
            }

            static::$basePath = $basePath;
        }

        return static::$basePath . $path;
    }
    
    /**
     * getBaseUrl
     *
     * @param  mixed $uri
     * @return string
     */
    public static function getBaseUrl(string $uri = ''): string
    {
        return sprintf("%s%s%s", static::getHostUrl(), static::getBasePath(), $uri);
    }
    
    /**
     * getCurrentUrl
     *
     * @return string
     */
    public static function getCurrentUrl(): string
    {
        return sprintf("%s%s", static::getHostUrl(), $_SERVER['REQUEST_URI']);
    }
        
    /**
     * getHostUrl
     *
     * @return string
     */
    public static function getHostUrl(): string
    {
        if (static::$hostUrl === null) {
            static::$hostUrl = sprintf(
                "%s://%s",
                isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
                $_SERVER['HTTP_HOST']);
        }

        return static::$hostUrl;
    }
    
    /**
     * getCurrentPath
     *
     * @param  mixed $query
     * @return string
     */
    public static function getCurrentPath(string $query = ''): string
    {
        $parseurl = static::getParseUrl();
        if($query){
            $query = '?' . $query;
        }
        return $parseurl['path'] . $query;
    }
    
    /**
     * getParseUrl
     *
     * @return array
     */
    public static function getParseUrl(): array{
        if (static::$parseurl === null) {
            static::$parseurl = parse_url(static::getCurrentUrl());
        }
        return static::$parseurl;
    } 
}
