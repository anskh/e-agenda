<?php

declare(strict_types=1);

namespace Core;

use Core\Exception\MethodNotAllowed;
use Core\Exception\RouteNotFound;
use Core\Helper\Config;
use Core\Helper\Service;
use Core\Http\Handler\RequestHandlerFactory;
use Core\Http\Handler\RequestHandlerRunnerInterface;
use Exception;
use HttpSoft\Emitter\SapiEmitter;
use HttpSoft\Message\Response;
use HttpSoft\ServerRequest\ServerRequestCreator;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * App
 * -----------
 * App
 *
 * @author Khaerul Anas <anasikova@gmail.com>
 * @since v1.0.0
 * @package Core
 */
class App implements RequestHandlerRunnerInterface
{
    private ServerRequestInterface $request;
    private RequestHandlerInterface $requestHandler;
    private ResponseInterface $response;

    public string $connection;
    public string $environment;
    public string $configDir;


    /**
     * __construct
     *
     * @return void
     */
    public function __construct(string $configDir)
    {
        $this->configDir = $configDir;
        $this->connection = $_ENV['DB_CONNECTION'] ?? 'default';
        $this->environment = $_ENV['APP_ENV'] ?? 'development';
        Config::init($configDir, $this->environment);
        $this->response = Service::response(new Response());
    }

    /**
     * @inheritdoc
     */
    public function run(): void
    {
        try {
            if ($this->environment === 'down') {
                $maintenance = file_get_contents(__DIR__ . '/template/view/maintenance.php');
                $this->response->getBody()->write($maintenance);
            } else {
                $this->request = Service::request(ServerRequestCreator::createFromGlobals());
                $middleware = Config::get('app.middleware') ?? [];
                $this->requestHandler = RequestHandlerFactory::create($middleware, $this->response);
                $this->response = $this->requestHandler->handle($this->request);
            }
        } catch (Exception $e) {
            if ($e instanceof RouteNotFound) {
                $error = Config::get('error.404');
                $this->response = ($error)($e, $this->response);
            } elseif ($e instanceof MethodNotAllowed) {
                $error = Config::get('error.403');
                $this->response = ($error)($e, $this->response);
            } else {
                $error = Config::get('error.500');
                $this->response = ($error)($e, $this->response);
            }
        }

        if (headers_sent() === false) {
            $emitter = new SapiEmitter();
            $emitter->emit($this->response);
        }
    }
}
