<?php
namespace App;

use App\Middleware\UnAuthMiddleware;
use Psr\Container\ContainerInterface;
use FastRoute\Dispatcher;

class Router
{
    private Dispatcher $dispatcher;
    private array $middlewares;
    private ContainerInterface $containerInterface;

    public function __construct(ContainerInterface $containerInterface)
    {
        $this->containerInterface = $containerInterface;

        $this->middlewares = [
            'ProductController-index' => [
                UnAuthMiddleware::class
            ],
            'ProductController-create' => [
                UnAuthMiddleware::class,
            ],
            'ProductController-store' => [
                UnAuthMiddleware::class
            ],
            'ProductController-delete' => [
                UnAuthMiddleware::class,
            ],
            'ProductController-update' => [
                UnAuthMiddleware::class
            ],
            'AuthController-search' => [
                AuthMiddleware::class,
            ],
            'AuthController-show' => [
                AuthMiddleware::class,
            ],
        ];

        $this->dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
            $r->get('/', 'ProductsController-index');
            $r->get('/products', 'ProductsController-index');
            $r->get('/products/create', 'ProductsController-create');
            $r->post('/products', 'ProductsController-store');
            $r->post('/products/{id}', 'ProductsController-delete');
            $r->get('/products/{id}/edit', 'ProductsController-update');
            $r->post('/products/{id}/edit', 'ProductsController-update');
            $r->get('/search', 'ProductsController-search');
            $r->get('/products/{id}', 'ProductsController-show');


            $r->get('/login', 'AuthController-indexLogin');
            $r->get('/signup', 'AuthController-indexSignUp');
            $r->post('/login', 'AuthController-logInUser');
            $r->post('/signup', 'AuthController-signUpUser');
            $r->get('/logout', 'AuthController-logout');

        });
    }

    public function start(): void
    {
        $httpMethod = $_SERVER['REQUEST_METHOD'];
        $uri = $_SERVER['REQUEST_URI'];

        if (false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }
        $uri = rawurldecode($uri);
        $routeInfo = $this->dispatcher->dispatch($httpMethod, $uri);

        switch ($routeInfo[0]) {
            case FastRoute\Dispatcher::NOT_FOUND:
                break;
            case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
                $allowedMethods = $routeInfo[1];
                break;
            case FastRoute\Dispatcher::FOUND:
                $handler = $routeInfo[1];
                $vars = $routeInfo[2];

                foreach ($this->middlewares as $key => $middleware) {
                    if ($key == $handler)
                        foreach ($middleware as $process) {
                            ($this->containerInterface->get($process))->handle($vars);
                        }
                }

                [$handler, $method] = explode('-', $handler);


                $controller = 'App\Controllers\\' . $handler;
                $controller = $this->containerInterface->get($controller);
                $controller->$method($vars);
        }
    }
}