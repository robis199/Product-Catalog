<?php
namespace App\Http;

class LogInRequest
{
    public static function userSession(): bool
    {
        return ($_SESSION['user_id']);
    }
}