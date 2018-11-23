<?php 

namespace Forteroche\Models;

class Chapter
{
    // Attributs
    private $id;
    private $title;
    private $content;
    private $author;
    private $creation_date;
    private $update_date_fr;

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
    public function getId() 
    {
        return $this->id;
    }

    public function getTitle() 
    {
        return $this->title;
    }

    public function getContent() 
    {
        return $this->content;
    }

    public function getAuthor() 
    {
        return $this->author;
    }

    public function getCreation_date_fr() 
    {
        return $this->creation_date;
    }

    public function getUpdate_date_fr() 
    {
        return $this->update_date_fr;
    }

    //  Setters

    public function setId($id) 
    {
        $this->id = $id;
    }
    
    public function setTitle($title) 
    {
        $this->title = $title;
    }
    
    public function setContent($content) 
    {
        $this->content = $content;
    }
    
    public function setAuthor($author) 
    {
        $this->author = $author;
    }
    
    public function setCreation_date_fr($creation_date) 
    {
        $this->creation_date = $creation_date;
    }

    public function setUpdate_date_fr($update_date_fr) 
    {
        $this->update_date_fr = $update_date_fr;
    }
}