<?php


use App\Controllers\LogInController;


if(isset($_GET["submit"]))
{

    $username = $_GET["user_name"];
    $password = $_GET["password"];



    $login = new LogInController($username,$password);


    $login->logInUser();

    header("location: /");

}