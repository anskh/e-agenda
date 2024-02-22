<?php

declare(strict_types=1);

namespace Core\Http\Renderer;

/**
 * ViewRenderer
 * -----------
 * ViewRenderer
 *
 * @author Khaerul Anas <anasikova@gmail.com>
 * @since v1.0.0
 * @package Core\Http\Renderer
 */
class ViewRenderer extends Renderer
{

    /**
     * __construct
     *
     * @param  mixed $viewPath
     * @param  mixed $fileExtension
     * @return void
     */
    public function __construct(private string $viewPath, private string $fileExtension = '.php')
    {
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
        extract($param, EXTR_SKIP);
        ob_start();
        include $this->viewPath . '/' . $view . $this->fileExtension;
        return ob_get_clean();
    }
}
