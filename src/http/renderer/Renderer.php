<?php

declare(strict_types=1);

namespace Core\Http\Renderer;

use Core\Helper\Service;
use Core\Http\Auth\UserPrincipalInterface;
use Core\Http\Session\SessionInterface;

/**
 * Renderer
 * -----------
 * Renderer
 *
 * @author Khaerul Anas <anasikova@gmail.com>
 * @since v1.0.0
 * @package Core\Http\Renderer
 */
abstract class Renderer implements ViewRendererInterface
{
    protected SessionInterface $session;
    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->session = Service::session();
    }

    abstract public function render(string $view, array $param): string;
}
