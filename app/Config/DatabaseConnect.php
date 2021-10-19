<?php

namespace App\Config;

use PDO;
use PDOException;

class DatabaseConnect

{
    private string $host = "127.0.0.1";
    private string $database = "product_catalog";
    private string $username = "roberts";
    private string $password ="robis199";


    protected function connect(): PDO
    {
        try {
            $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->database;
            $pdo = new PDO($dsn, $this->username, $this->password);

            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $pdo;
        }
        catch(PDOException $exception) {
            die('Could not connect');
        }

    }


}