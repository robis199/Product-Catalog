<?php
namespace App\Controllers;

use App\Storage\PDOUserDataStorage;
use Ramsey\Uuid\Nonstandard\Uuid;

class AuthController extends PDOUserDataStorage
{


    private string $id;
    private string $username;
    private string $email;
    private string $password;
    private string $passwordRepeat;


    public function __construct($id,$username,$email, $password, $passwordRepeat)
    {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->passwordRepeat = $passwordRepeat;
    }

    public function indexSignUp()
    {
        require_once 'App/Views/user/auth.template.php';
    }

    public function indexLogin()
    {
        require_once 'App/Views/user/login.template.php';
    }

    public function signUpUser(): void
    {
        $id = Uuid::uuid4();
        $name = trim($_POST['name']);
        $email = $_POST['email'];
        $password = $_POST['password'];
        $passwordRepeat = $_POST['passwordRepeat'];

        if($this->emptyField() == false){
            echo "Empty input";
              require_once 'App/Views/user/auth.template.php';
        }
        if($this->invalidSymbol() == false){
            echo "Invalid symbols used";
              require_once 'App/Views/user/auth.template.php';
        }
        if($this->invalidEmail() == false){
            echo "Invalid email";
              require_once 'App/Views/user/auth.template.php';
        }
        if($this->passwordValidate() == false){
            echo "Passwords do not match";
              require_once 'App/Views/user/auth.template.php';
        }
        if($this->usernameExists() == false){
            echo "Username or email taken";
              require_once 'App/Views/user/auth.template.php';
        }

        $this->setUser($this->username, $this->password, $this->email);
        $_SESSION['id'] = $this->id;

        header('Location: /');


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



    public function logInUser()
    {
        if($this->emptyField() == false){
            echo "Empty input";
            exit();
        }

        $this->getUser($this->username, $this->password);
        require_once 'App/Views/user/login.template.php';
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



