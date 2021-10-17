<?php

namespace App\Storage;

interface UserDataStorage
{
    public function setUser($username, $password, $email);
    public function getUser($username, $password);
    public function checkUserData($username, $email);

}