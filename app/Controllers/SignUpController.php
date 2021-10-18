<?php
namespace App\Controllers;

use App\Storage\PDOUserDataStorage;

class SignUpController extends PDOUserDataStorage
{


    private string $username;
    private string $email;
    private string $password;
    private string $passwordRepeat;


    public function __construct($username,$email, $password, $passwordRepeat)
    {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->passwordRepeat = $passwordRepeat;
    }

    public function index()
    {

    }

    public function signUpUser()
    {
        if($this->emptyField() == false){
            echo "Empty input";
            exit();
        }
        if($this->invalidSymbol() == false){
            echo "Invalid symbols used";
            exit();
        }
        if($this->invalidEmail() == false){
            echo "Invalid email";
            exit();
        }
        if($this->passwordValidate() == false){
            echo "Passwords do not match";
            exit();
        }
        if($this->usernameExists() == false){
            echo "Username or email taken";
            exit();
        }

        $this->setUser($this->username, $this->password, $this->email);
    }

    private function emptyField(): bool
    {
        if(empty($this->username)||(empty($this->password)||(empty($this->passwordRepeat)))) {
            $dataCheck = false;
        }
        else
        {
            $dataCheck  = true;
        }
        return $dataCheck;
    }

    private function invalidSymbol(): bool
    {

        if(!preg_match("/^[a-zA-Z0-9]*$/",$this->username))
        {
            $dataCheck = false;
        }
        else
        {
            $dataCheck = true;
        }

        return $dataCheck;
    }

    private function invalidEmail(): bool
    {
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL))
        {
            $dataCheck = false;
        }
        else
        {
            $dataCheck = true;
        }
        return $dataCheck;
    }

    private function passwordValidate(): bool
    {
        if ($this->password !== $this->passwordRepeat) {
            $dataCheck = false;
        } else
        {
            $dataCheck = true;
        }
            return $dataCheck;
    }


    private function usernameExists(): bool
    {
        if (!$this->checkUserData($this->username,$this->email)) {
            $dataCheck = false;
        } else
        {
            $dataCheck = true;
        }
        return $dataCheck;
    }

}



