<?php

declare(strict_types=1);

namespace Core\Http\Renderer;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

/**
 * TwigRenderer
 * -----------
 * TwigRenderer
 *
 * @author Khaerul Anas <anasikova@gmail.com>
 * @since v1.0.0
 * @package Core\Http\Renderer
 */
class TwigRenderer extends Renderer
{
    private Environment $twig;
    private string $fileExtension;
    
    /**
     * __construct
     *
     * @param  mixed $viewPath
     * @param  mixed $fileExtension
     * @return void
     */    
    /**
     * __construct
     *
     * @param  mixed $viewPath
     * @param  mixed $fileExtension
     * @return void
     */
    public function __construct(string $viewPath, string $fileExtension = '.html.twig')
    {
        $loader = new FilesystemLoader($viewPath);
        $this->twig = new Environment($loader);
        $this->fileExtension = $fileExtension;

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
        $view = $view  . $this->fileExtension;
        return $this->twig->render($view, $param);
    }
}
