<?php declare(strict_types=1);

namespace Core\Http\Renderer;

use Core\Helper\Config;
use Core\Http\Auth\UserPrincipalInterface;
use Core\Http\Session\SessionInterface;
use eftec\bladeone\BladeOne;

/**
 * BladeRenderer
 * -----------
 * BladeRenderer
 *
 * @author Khaerul Anas <anasikova@gmail.com>
 * @since v1.0.0
 * @package Core\Http\Renderer
 */
class BladeRenderer extends Renderer
{
    private BladeOne $blade;

    public SessionInterface $session;
    public UserPrincipalInterface $user;
    
    /**
     * __construct
     *
     * @param  mixed $viewPath
     * @param  mixed $fileExtension
     * @return void
     */
    public function __construct(string $viewPath, string $fileExtension = '.blade.php')
    {
        $cache = Config::get('view.blade.cache_path');
        $this->blade = new BladeOne($viewPath, $cache);
        $this->blade->setFileExtension($fileExtension);

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
        return $this->blade->run($view, $param);
    }
}