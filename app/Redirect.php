<?php

namespace App;

class Redirect
{
    public static function redirect($path)
    {
        header("Location: $path");
        exit;
    }
}