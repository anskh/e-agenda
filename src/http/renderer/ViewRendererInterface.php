<?php declare(strict_types=1);

namespace Core\Http\Renderer;

/**
 * ViewRendererInterface
 * -----------
 * ViewRendererInterface
 *
 * @author Khaerul Anas <anasikova@gmail.com>
 * @since v1.0.0
 * @package Core\Http\Renderer
 */
Interface ViewRendererInterface
{    
    /**
     * render
     *
     * @param  mixed $view
     * @param  mixed $param
     * @return string
     */
    public function render(string $view, array $param): string;
}