<?php

namespace App\Storage\UserStorage;

use App\Models\User;

interface UserDataStorage
{
    public function signup(User $user): void;
    public function login($username,$password,$email);
}