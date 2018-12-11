<?php 

namespace Forteroche\Models;

class User
{
    // Attributs
    private $user_id;
    private $user_pseudo;
    private $user_password;
    private $user_email;
    private $user_rank;

    // Constructeur
    public function __construct(array $donnees) 
    {
        $this->hydrate($donnees);
    }

    // Hydrate
    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value)
        {
            // On récupère le nom du setter correspondant à l'attribut.
            $method = 'set'.ucfirst($key);
                
            // Si le setter correspondant existe.
            if (method_exists($this, $method))
            {
                // On appelle le setter.
                $this->$method($value);
            }
        }
    }
    

    // Getters
    public function getUser_id() 
    {
        return $this->user_id;
    }

    public function getUser_pseudo() 
    {
        return $this->user_pseudo;
    }

    public function getUser_password() 
    {
        return $this->user_password;
    }

    public function getUser_email() 
    {
        return $this->user_email;
    }

    public function getUser_rank() 
    {
        return $this->user_rank;
    }

    //  Setters

    public function setUser_id(int $user_id) 
    {
        $this->user_id = $user_id;
    }
    
    public function setUser_pseudo(string $user_pseudo) 
    {
        $this->user_pseudo = $user_pseudo;
    }
    
    public function setUser_password(string $user_password) 
    {
        $this->user_password = $user_password;
    }
    
    public function setUser_email(string $user_email) 
    {
        $this->user_email = $user_email;
    }
    
    public function setUser_rank(int $user_rank) 
    {
        $this->user_rank = $user_rank;
    }
}