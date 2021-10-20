<?php
namespace App\Controllers;

use App\Storage\UserStorage\PDOUserDataStorage;
use App\Storage\UserStorage\UserDataStorage;
use Ramsey\Uuid\Nonstandard\Uuid;

class AuthController
{

    private UserDataStorage $userStorage;

    public function __construct()
    {
        $this->userStorage = new PDOUserDataStorage();
    }

    public function indexSignUp()
    {
        require_once 'App/Views/user/signup.php';
    }

    public function indexLogin()
    {
        require_once 'App/Views/user/login.php';
    }

    public function signUpUser(): void
    {
        $id = Uuid::uuid4();
        $username = trim($_POST['username']);
        $email = $_POST['email'];
        $password = $_POST['password'];
        $passwordRepeat = $_POST['passwordRepeat'];

        if($this->emptyField() == false){
            echo "Empty input";
              require_once 'App/Views/user/signup.php';
        }
        if($this->invalidSymbol($username) == false){
            echo "Invalid symbols used";
              require_once 'App/Views/user/signup.php';
        }
        if($this->invalidEmail($email) == false){
            echo "Invalid email";
              require_once 'App/Views/user/signup.php';
        }
        if($this->passwordValidate($password,$passwordRepeat) == false){
            echo "Passwords do not match";
              require_once 'App/Views/user/signup.php';
        }
        if($this->usernameExists($username,$email) == false){
            echo "Username or email taken";
              require_once 'App/Views/user/signup.php';
        }

        $this->userStorage->setUser($username, $password, $email);
        $_SESSION['id'] = $id;

        header('Location: /');


}

    private function emptyField(): bool
    {
        if(empty($username)||(empty($password)||(empty($passwordRepeat)))) {
            $dataCheck = false;
        }
        else
        {
            $dataCheck  = true;
        }
        return $dataCheck;
    }

    private function invalidSymbol($username): bool
    {

        if(!preg_match("/^[a-zA-Z0-9]*$/",$username))
        {
            $dataCheck = false;
        }
        else
        {
            $dataCheck = true;
        }
        return $dataCheck;

    }

    private function invalidEmail($email): bool
    {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $dataCheck = false;
        }
        else
        {
            $dataCheck = true;
        }
        return $dataCheck;
    }

    private function passwordValidate($password,$passwordRepeat): bool
    {
        if ($password !== $passwordRepeat) {
            $dataCheck = false;
        } else
        {
            $dataCheck = true;
        }
            return $dataCheck;
    }


    private function usernameExists($username, $email): bool
    {
        if (!$this->userStorage->checkUserData($username,$email)) {
            $dataCheck = false;
        } else
        {
            $dataCheck = true;
        }
        return $dataCheck;
    }



    public function logInUser($username, $password)
    {
        if($this->emptyField() == false){
            echo "Empty input";
            exit();
        }

        $this->userStorage->getUser($username, $password);
        require_once 'App/Views/user/login.php';
    }



    private function emptyLogInField(): bool
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


    public function logout(): void
    {
        unset($_SESSION['id']);
        header('Location: /login');
    }
}



