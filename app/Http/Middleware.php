<?php

namespace Http;

interface Middleware
{
    public function handle(): void;
}