<?php

namespace Forteroche\Models;

class Manager
{
    protected function dbConnect()
    {
        try{
            $db = new \PDO('mysql:host=localhost;dbname=blog-jf;charset=utf8', 'root', '');
            $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            return $db;
        }
        catch (PDOException $e) {
            echo 'Échec lors de la connexion : ' . $e->getMessage();
        }
    }
}