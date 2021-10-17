<?php

use App\Controllers\SignUpController;


if(isset($_POST["submit"]))
{

    $username = $_POST["user_name"];
    $password = $_POST["password"];
    $passwordValidate = $_POST["password_validate"];
    $email = $_POST["email"];


    $signUp = new SignUpController($username,$email,$password, $passwordValidate);


    $signUp->signUpUser();

    header("location: /");

}