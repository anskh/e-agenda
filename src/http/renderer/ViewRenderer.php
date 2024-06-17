<?php

declare(strict_types=1);

namespace Core\Http\Renderer;

use Core\Helper\Service;

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

    private string $viewPath;

    /**
     * __construct
     *
     * @param  mixed $viewPath
     * @return void
     */
    public function __construct(string $viewPath)
    {
        $this->session = Service::session();
        $this->viewPath = $viewPath;
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
        include $this->viewPath . '/' . $view . '.php';
        return ob_get_clean();
    }
}
