<?php
use App\Middleware\AuthMiddleware;
use App\Middleware\UnAuthMiddleware;

return [
    'ProductController-index' => [
        UnAuthMiddleware::class
    ],
    'ProductController@create' => [
        UnAuthMiddleware::class,
    ],
    'ProductController@store' => [
        UnAuthMiddleware::class
    ],
    'ProductControoler@delete' => [
        UnAuthMiddleware::class,
    ],
    'ProductController@update' => [
        UnAuthMiddleware::class
    ],
    'AuthController@search' => [
        AuthMiddleware::class,
    ],
    'AuthController@show' => [
        AuthMiddleware::class,
    ],
];