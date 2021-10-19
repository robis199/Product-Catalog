<?php

use App\Controllers\AuthController;


if(isset($_POST["submit"]))
{

    $username = $_POST["user_name"];
    $password = $_POST["password"];
    $passwordValidate = $_POST["password_validate"];
    $email = $_POST["email"];


    $signUp = new AuthController($username,$email,$password, $passwordValidate);


    $signUp->signUpUser();

    header("location: /");

}