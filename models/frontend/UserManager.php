<?php

namespace Forteroche\Models;

require_once("models/Manager.php");

class UserManager extends Manager
{
    public function isExist($user_pseudo)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT user_password FROM users WHERE user_pseudo = :user_pseudo');
        $req->bindValue(':user_pseudo', $user_pseudo, \PDO::PARAM_STR);
        $req->execute();
        
        return $req->fetchColumn();
    }
}