<?php
use App\Router;
use DI\Container;
require_once 'vendor/autoload.php';
session_start();


$container = new Container\();


$router = new Router($container);

$router->start();

unset($_SESSION['errors']);
unset($_SESSION['data']);