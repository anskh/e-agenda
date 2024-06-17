<?php

declare(strict_types=1);

use Core\AppFactory;
use Core\Helper\Url;
use Core\Helper\Config;
use Core\Db\Database;
use Core\Db\DatabaseFactory;
use Core\Helper\Service;
use Core\Http\Session\SessionInterface;

/**
 * Set of function helper 
 *
 * @author Khaerul Anas <anasikova@gmail.com>
 * @since v1.0.0
 * @package Core\Helper
 */

if (!function_exists('config')) {
    /**
     * config
     *
     * @param  mixed $offset
     * @param  mixed $defaultValue
     * @return mixed
     */
    function config($offset, $defaultValue = null)
    {
        return Config::get($offset, $defaultValue);
    }
}

if (!function_exists('base_url')) {
    /**
     * base_url
     *
     * @param  mixed $uri
     * @return string
     */
    function base_url(string $uri = ''): string
    {
        return Url::getBaseUrl($uri);
    }
}

if (!function_exists('base_path')) {
    /**
     * base_path
     *
     * @param  mixed $path
     * @return string
     */
    function base_path(string $path = ''): string
    {
        return Url::getBasePath($path);
    }
}

if (!function_exists('route')) {
    /**
     * route
     *
     * @param  mixed $name
     * @return string
     */
    function route(string $name): string
    {
        $route = Config::get('route.' . $name);
        $url = $route[1];
        $segments = explode('[', $url);
        $url = $segments[0];
        $segments = explode('{', $url);
        return Url::getBasePath($segments[0]);
    }
}

if (!function_exists('is_route')) {
    /**
     * is_route
     *
     * @param  mixed $name
     * @return bool
     */
    function is_route($name): bool
    {
        static $path;
        if (!$path) {
            $path = Url::getCurrentPath();
        }
        if (is_array($name)) {
            $found = false;
            foreach ($name as $n) {
                $found = is_route($n);
                if ($found) break;
            }
            return $found;
        } else {
            $r = route($name);
            if ($r === Url::getBasePath('/')) {
                return $path === $r;
            } else {
                return str_starts_with($path, $r);
            }
        }
    }
}

if (!function_exists('attr_to_string')) {
    /**
     * attr_to_string
     *
     * @param  mixed $attributes
     * @return string
     */
    function attr_to_string($attributes): string
    {
        if (empty($attributes)) {
            return '';
        }
        if (is_object($attributes)) {
            $attributes = (array) $attributes;
        }
        if (is_array($attributes)) {
            $atts = '';
            foreach ($attributes as $key => $val) {

                if (is_object($val)) {
                    $val = (array) $val;
                }
                if (is_array($val)) {
                    $val = "{" . attr_to_string($val) . "}";
                }
                if (is_numeric($key)) {
                    $key = '';
                } else {
                    $key .= '=';
                    if (is_string($val)) {
                        $val = "\"{$val}\"";
                    }
                }
                $atts = empty($atts) ? ' ' . $key . $val : $atts . ' ' . $key  . $val;
            }

            return $atts;
        }

        if (is_string($attributes)) {
            return ' ' . $attributes;
        }

        return '';
    }
}

if (!function_exists('csrf_token')) {
      
    /**
     * csrf_token
     *
     * @param  mixed $generator
     * @return string
     */
    function csrf_token(bool $generator = true): string
    {
        return Service::session()->csrfToken($generator);
    }
}
if (!function_exists('csrf_name')) {
      
    /**
     * csrf_name
     *
     * @return string
     */
    function csrf_name(): string
    {
        return Service::session()->csrfName();
    }
}
if (!function_exists('validate_csrf_token')) {      
    /**
     * validate_csrf_token
     *
     * @param  mixed $token
     * @return bool
     */
    function validate_csrf_token(string $token): bool
    {
        return Service::session()->validateCsrfToken($token);
    }
}
if (!function_exists('session')) {
    /**
     * session
     *
     * @param  mixed $request
     * @return Session
     */
    function session(): SessionInterface
    {
        return Service::session();
    }
}

if (!function_exists('db')) {
    /**
     * db
     *
     * @param  mixed $connection
     * @return Database
     */
    function db(?String $connection = null): Database
    {
        return DatabaseFactory::create($connection ?? AppFactory::create()->connection);
    }
}
