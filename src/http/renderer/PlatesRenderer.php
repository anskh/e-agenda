<?php

declare(strict_types=1);

namespace Core\Http\Renderer;

use League\Plates\Engine;

/**
 * PlatesRenderer
 * -----------
 * PlatesRenderer
 *
 * @author Khaerul Anas <anasikova@gmail.com>
 * @since v1.0.0
 * @package Core\Http\Renderer
 */
class PlatesRenderer extends Renderer
{
    private Engine $template;
    
    /**
     * __construct
     *
     * @param  mixed $viewPath
     * @param  mixed $fileExtension
     * @return void
     */
    public function __construct(string $viewPath, string $fileExtension = 'phtml')
    {
        $this->template = new Engine($viewPath, $fileExtension);

        parent::__construct();
    }    
    /**
     * render
     *
     * @param  mixed $view
     * @param  mixed $param
     * @return string
     */
    public function render(string $view, array $param): string
    {
        return $this->template->render($view, $param);
    }    
    /**
     * getTemplate
     *
     * @return Engine
     */
    public function getTemplate(): Engine
    {
        return $this->template;
    }    
    /**
     * addFolder
     *
     * @param  mixed $name
     * @param  mixed $path
     * @return void
     */
    public function addFolder(string $name, string $path): void
    {
        $this->template->addFolder($name, $path);
    }    
    /**
     * getViewPath
     *
     * @param  mixed $name
     * @return string
     */
    public function getViewPath(?string $name = null): string
    {
        return $this->template->path($name);
    }
}
