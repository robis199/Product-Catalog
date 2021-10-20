<?php

namespace App\Http;

interface Middleware
{
    public function handle(): void;
}