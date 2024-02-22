<?php

declare(strict_types=1);

namespace Core\Http\Renderer;

use Core\Helper\Config;
use Exception;

/**
 * ViewRendererFactory
 * -----------
 * ViewRendererFactory
 *
 * @author Khaerul Anas <anasikova@gmail.com>
 * @since v1.0.0
 * @package Core\Http\Renderer
 */
class ViewRendererFactory
{
    private static array $renderer = [];
    
    /**
     * create
     *
     * @return ViewRendererInterface
     */
    static public function create(): ViewRendererInterface
    {
        $engine = Config::get('view.engine');
        $viewPath = Config::get('view.path');
        if($engine === 'plates'){
            return static::plates($viewPath);
        }elseif($engine === 'blade'){
            return static::blade($viewPath);
        }elseif($engine === 'twig'){
            return static::twig($viewPath);
        }else{
            return static::default($viewPath);
        }
    }
    
    /**
     * plates
     *
     * @param  mixed $viewPath
     * @return PlatesRenderer
     */
    static function plates(string $viewPath): PlatesRenderer
    {
        if(!array_key_exists($viewPath, static::$renderer)){
            static::$renderer[$viewPath] = new PlatesRenderer($viewPath);
        }elseif(!(static::$renderer[$viewPath] instanceof PlatesRenderer)){
            static::$renderer[$viewPath] = new PlatesRenderer($viewPath);
        }
        
        return static::$renderer[$viewPath];
    }
    
    /**
     * blade
     *
     * @param  mixed $viewPath
     * @return BladeRenderer
     */
    static function blade(string $viewPath): BladeRenderer
    {
        if(!array_key_exists($viewPath, static::$renderer)){
            static::$renderer[$viewPath] = new BladeRenderer($viewPath);
        }elseif(!(static::$renderer[$viewPath] instanceof BladeRenderer)){
            static::$renderer[$viewPath] = new BladeRenderer($viewPath);
        }
        
        return static::$renderer[$viewPath];
    }
        
    /**
     * twig
     *
     * @param  mixed $viewPath
     * @return TwigRenderer
     */
    static function twig(string $viewPath): TwigRenderer
    {
        if(!array_key_exists($viewPath, static::$renderer)){
            static::$renderer[$viewPath] = new TwigRenderer($viewPath);
        }elseif(!(static::$renderer[$viewPath] instanceof TwigRenderer)){
            static::$renderer[$viewPath] = new TwigRenderer($viewPath);
        }
        
        return static::$renderer[$viewPath];
    }
    
    /**
     * default
     *
     * @param  mixed $viewPath
     * @return ViewRenderer
     */
    static function default(string $viewPath): ViewRenderer
    {
        if(!array_key_exists($viewPath, static::$renderer)){
            static::$renderer[$viewPath] = new ViewRenderer($viewPath);
        }elseif(!(static::$renderer[$viewPath] instanceof ViewRenderer)){
            static::$renderer[$viewPath] = new ViewRenderer($viewPath);
        }
        
        return static::$renderer[$viewPath];
    }
}
