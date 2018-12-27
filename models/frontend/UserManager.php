<?php

namespace Forteroche\Models;

require_once("models/Manager.php");

class UserManager extends Manager
{
    // Vérifie si un utilisateur existe dans la BDD.

    public function isExist($user_pseudo)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT user_password FROM users WHERE user_pseudo = :user_pseudo');
        $req->bindValue(':user_pseudo', $user_pseudo->getUser_pseudo(), \PDO::PARAM_STR);
        $req->execute();
        
        return $req->fetchColumn();
    }

    // Vérifie dans la BDD si l'utilisateur est un administrateur.

    public function isAdmin($user_pseudo)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT user_rank FROM users WHERE user_rank = 1 AND user_pseudo = :user_pseudo');
        $req->bindValue(':user_pseudo', $user_pseudo->getUser_pseudo(), \PDO::PARAM_STR);
        $req->execute();

        return $req->fetchColumn();
    }
}