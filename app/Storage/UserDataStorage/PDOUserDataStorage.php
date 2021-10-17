<?php

namespace App\Storage;

use config\databaseConnect;
use PDO;

class PDOUserDataStorage extends databaseConnect implements UserDataStorage
{

    public function setUser($username, $password, $email) {
        $statement = $this->connect()->prepare('INSERT INTO user (user_name, password, email) VALUES (?,?,?);');

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);



        if(!$statement->execute(array($username, $hashedPassword, $email))) {
            $statement = null;
            header("location: Views/user/auth.template.php?error=stmtfailed");
            exit();
        }

        $statement = null;
    }

    public function getUser($username, $password){
        $statement = $this->connect()->prepare('SELECT password FROM user WHERE user_name = ? OR email = ?;');


        if(!$statement->execute(array($username,$password))) {
            $statement = null;
            header("Location: /");
            exit();
        }
        if($statement->rowCount() == 0) {
            $statement = null;
            header("Location: /");
            exit;
        }

        $passwordHashed = $statement->fetchAll(PDO::FETCH_ASSOC);
        $checkPassword = password_verify($password, $passwordHashed[0]["password"]);

        if($checkPassword == false) {
            $statement = null;
            header("Location: /wrongpassword");
            exit;
        }
        elseif($checkPassword == true)
        {
            $statement = $this->connect()->prepare('SELECT * FROM user WHERE user_name = ? OR email = ? AND password =?;');

            if(!$statement->execute(array($username,$username,$password))) {
                $statement = null;
                header("location: /failed");
                exit();
            }

            if($statement->rowCount() == 0) {
                $statement = null;
                header("Location: /");
                exit;
            }

            $user = $statement->fetchAll(PDO::FETCH_ASSOC);

            session_start();
            $_SESSION["user_id"] =$user[0]["id"];
            $_SESSION["user_name"] =$user[0]["user_name"];

            $statement = null;
        }

    }










    public function checkUserData($username, $email) {
        $statement = $this->connect()->prepare('SELECT user_name FROM user WHERE user_name = ? OR email = ?;');

        if(!$statement->execute(array($username,$email))) {
            $statement = null;
            header("location: /failed");
            exit();
        }

        if($statement->rowCount() > 0) {
            $dataCheck = false;
        }
        else {
            $dataCheck = true;
        }
        return $dataCheck;
    }
}