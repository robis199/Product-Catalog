<?php

use App\Http\Middleware;
use App\Controllers\AuthController;

class AuthMiddleware implements Middleware
{
    public function handle(): void
    {
        if(AuthController::getUser()) {
            header('Location: /login');
            exit;
        }
    }
}