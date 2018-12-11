<?php

namespace Forteroche\Models;

require_once("models/Manager.php");
require_once("models/User.php");

class UserAdminManager extends Manager
{
    // Ajout d'un administrateur dans la BDD.
    
    public function addUserAdmin($user_admin)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO users (user_pseudo, user_password, user_email, user_rank) VALUES(:user_pseudo, :user_password, :user_email, 1)');
        $req->bindValue(':user_pseudo', $user_admin->getUser_pseudo(), \PDO::PARAM_STR);
        $req->bindValue(':user_password', $user_admin->getUser_password(), \PDO::PARAM_STR);
        $req->bindValue(':user_email', $user_admin->getUser_email(), \PDO::PARAM_STR);
        $req->execute();

        return $req;
    }

    // Vérifie si un utilisateur existe par le nombre total du pseudo existant déjà.

    public function getUsers($user_pseudo)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT COUNT(*) AS number_users FROM users WHERE user_pseudo = :user_pseudo');
        $req->bindValue(':user_pseudo', $user_pseudo->getUser_pseudo(), \PDO::PARAM_STR);
        $req->execute();
        
        return $req->fetchColumn();
    }
}