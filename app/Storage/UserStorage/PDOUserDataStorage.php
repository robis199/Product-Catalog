<?php

namespace App\Storage\UserStorage;

use App\Config\DatabaseConnect;
use App\Models\User;
use PDO;

class PDOUserDataStorage extends databaseConnect implements UserDataStorage
{
    public function signup(User $user): void
    {
        $sql = 'INSERT INTO user (user_id, user_name, email, password) VALUES (?,?,?,?)';
        $statement = $this->connect()->prepare($sql);
        $statement->execute([
            $user->getId(),
            $user->getUsername(),
            $user->getPassword(),
            $user->getEmail(),
            ]);
    }

    public function login($username, $password, $email): ?User
    {
        $statement = $this->connect()->prepare('SELECT * FROM user WHERE user_name = ? OR email = ? AND password =?;');

        $user = $statement->fetchAll(PDO::FETCH_ASSOC);

        if (!$statement->rowCount() == 0 || !empty($user)) {
            return new User(
                $user['user_id'],
                $user['user_name'],
                $user['email'],
                $user['password']
            );

        } else {
            $statement = null;
            header("Location: /");
            exit;
        }
    }


}