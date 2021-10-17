<?php
namespace App\Controllers;

use App\Storage\PDOUserDataStorage;

class LogInController extends PDOUserDataStorage
{


    private string $username;

    private string $password;



    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;

    }

    public function logInUser()
    {
        if($this->emptyField() == false){
            echo "Empty input";
            exit();
        }

        $this->getUser($this->username, $this->password);
    }

    private function emptyField(): bool
    {
        if(empty($this->username)||(empty($this->password))) {
            $dataCheck = false;
        }
        else
        {
            $dataCheck  = true;
        }
        return $dataCheck;
    }

}