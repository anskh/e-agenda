<?php

declare(strict_types=1);

use App\Helper\Service;
use Core\Helper\Url;
use Core\Http\Auth\UserPrincipalInterface;
use Core\Http\Renderer\ViewRendererFactory;
use Core\Http\ViewComponent\FlashMessage;
use Core\Model\FormModel;
use Laminas\Diactoros\Response;
use Laminas\Diactoros\Response\JsonResponse;
use Laminas\Diactoros\Response\RedirectResponse;
use Psr\Http\Message\ResponseInterface;

if(!function_exists('asset')){
    function asset(string $uri = ''): string {
        return Url::getBaseUrl('/assets' . $uri);
    }
}
if(!function_exists('upload')){
    function upload(string $uri = ''): string {
        return Url::getBaseUrl('/uploads' . $uri);
    }
}
if(!function_exists('view')){
    function view(string $view, array $data = [], ?ResponseInterface $response = null): ResponseInterface {
        $renderer = ViewRendererFactory::create();
        $response = $response ?? new Response();
        $response->getBody()->write($renderer->render($view, $data));
        return $response;
    }
}
if(!function_exists('view_json')){
    function view_json($data): ResponseInterface {
        $response = new JsonResponse($data);
        return $response;
    }
}
if(!function_exists('redirect')){
    function redirect(string $name): ResponseInterface {
        return redirect_url(route($name));
    }
}
if(!function_exists('redirect_url')){
    function redirect_url(string $url): ResponseInterface {
        return new RedirectResponse($url);
    }
}
if (!function_exists('auth')) {    
    /**
     * auth
     *
     * @param  mixed $request
     * @return null|UserPrincipalInterface
     */
    function auth(): UserPrincipalInterface
    {
        return Service::auth();
    }
}
if (!function_exists('render_flash')) {    
    /**
     * render_flash
     *
     * @param  mixed $flash
     * @return string
     */
    function render_flash(array|FlashMessage $flash): string
    {
        $html = '';
        if(is_array($flash) && $flash){
            foreach($flash as $item){
                $html .= render_flash($item) . PHP_EOL;
            }
        }elseif($flash){
            $html .= '<div class="alert alert-' . $flash->getType() . ' shadow" role="alert">' . PHP_EOL;
            $html .= '<div class="pe-3 me-auto">' . PHP_EOL;
            $html .= '<ul role="list" class="mb-0 ps-5" style="list-style-type: square;">' . PHP_EOL;
            foreach ($flash->getMessage() as $msg) {
                $html .= '<li>' . $msg . '</li>' . PHP_EOL;
            }
            $html .= '</ul>' . PHP_EOL;
            $html .= '</div>' . PHP_EOL;
            $html .= '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>'  . PHP_EOL;
            $html .= '</div>'  . PHP_EOL;
        }
        return $html;
    }
}
if (!function_exists('render_error_form')) {    
    /**
     * render_error_form
     *
     * @param  mixed $model
     * @return string
     */
    function render_error_form(FormModel $model): string
    {
        $html = '<div class="alert alert-danger" role="alert">' . PHP_EOL;
        $html .= '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 me-3 icon icon-tabler icon-tabler-alert-circle" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">' . PHP_EOL;
        $html .= '<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>'. PHP_EOL;
        $html .= '<circle cx="12" cy="12" r="9"></circle>'. PHP_EOL;
        $html .= '<line x1="12" y1="8" x2="12" y2="12"></line>'. PHP_EOL;
        $html .= '<line x1="12" y1="16" x2="12.01" y2="16"></line>'. PHP_EOL;
        $html .= '</svg>'. PHP_EOL;
        $html .= '<div class="pe-3 me-auto">'. PHP_EOL;
        $html .= '<div class="ml-3">'. PHP_EOL;
        $html .= '<p class="fw-semibold mb-1">Terdapat kesalahan berikut:</p>'. PHP_EOL;
        $html .= '<ul role="list" class="mb-0 ps-5" style="list-style-type: square;">'. PHP_EOL;
        foreach ($model->firstError() as $error) { 
            $html .= '<li>' . $error . '</li>'. PHP_EOL;
        }
        $html .= '</ul>'. PHP_EOL;
        $html .= '</div>'. PHP_EOL;
        $html .= '</div>'. PHP_EOL;
        $html .= '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>'. PHP_EOL;
        $html .= '</div>'. PHP_EOL;
        return $html;
    }
}