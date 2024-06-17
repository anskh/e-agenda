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
    private static $renderer = null;
    
    /**
     * create
     *
     * @return ViewRendererInterface
     */
    static public function create(): ViewRendererInterface
    {
        $viewPath = Config::get('view.path');
        if(static::$renderer === null){
            static::$renderer = new ViewRenderer($viewPath);
        }        
        return static::$renderer;
    }
}
