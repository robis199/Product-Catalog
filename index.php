<?php
require_once 'vendor/autoload.php';

use DI\Container;

session_start();

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
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

$container = new Container();

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);

switch ($routeInfo[0])
{

    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];

        $middlewares = require_once 'app/middlewares.php';

        if (array_key_exists($handler, $middlewares)) {
            foreach ($middlewares[$handler] as $middleware) {
                $middleware = $container->get($middleware);
                $middleware->handle();
            }
        }
        [$controller, $method] = explode('-', $handler);

        $controller = 'App\Controllers\\' . $controller;
        $controller = new $controller();
        $render = $controller->$method($vars);

        break;
}
