<?php
namespace App\Middleware;

use App\Http\Middleware;
use App\Http\LogInRequest;

class AuthMiddleware implements Middleware
{
    public function handle(): void
    {
        if(LogInRequest::userSession()) {
            header('Location: /login');
            exit;
        }
    }
}