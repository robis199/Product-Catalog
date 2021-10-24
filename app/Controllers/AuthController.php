<?php
namespace App\Controllers;

use App\Models\User;
use App\Storage\UserStorage\PDOUserDataStorage;
use App\Storage\UserStorage\UserDataStorage;
use Ramsey\Uuid\Nonstandard\Uuid;
use App\Redirect;

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
        $username = trim($_POST['user_name']);
        $password = $_POST['password'];
        $passwordRepeat = $_POST['password_validate'];
        $email = $_POST['email'];

        if($this->emptyField() || $this->invalidSymbol($username) || $this->invalidEmail($email) || $this->passwordValidate($password,$passwordRepeat) || $this->usernameExists($username,$email) == false){
            echo "ERROR";
            require_once 'App/Views/user/signup.php';
        }

        $password = password_hash($password,PASSWORD_DEFAULT);

        $user = new User(
          $id,
          $username,
          $password,
          $email
        );

        $this->userStorage->signup($user);

        $_SESSION['user_id'] = $user->getId();

        Redirect::redirect("/");

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

    public function logInUser(): void
    {
        $username = $_POST['user_name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        if(!$this->emptyField() || !$this->invalidEmail($email)){
            echo "Ups, something went wrong";
            require_once 'app/Views/user/login.php';
        }

        $user = $this->userStorage->login($username, $password, $email);
        if ($user && password_verify($password, $user->getPassword()))
            $_SESSION['user_id'] = $user->getId();
            Redirect::redirect("/");

    }

    public function logout(): void
    {
        unset($_SESSION['user_id']);
        header('Location: /login');
    }
}



