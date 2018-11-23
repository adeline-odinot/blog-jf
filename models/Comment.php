<?php 

namespace Forteroche\Models;

class Comment
{
    // Attributs
    private $id;
    private $chapter_id;
    private $author;
    private $comment;
    private $comment_date;
    private $nb_report;

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

    public function getChapter_id() 
    {
        return $this->chapter_id;
    }

    public function getAuthor() 
    {
        return $this->author;
    }

    public function getComment() 
    {
        return $this->comment;
    }

    public function getComment_date() 
    {
        return $this->comment_date;
    }

    public function getNb_report() 
    {
        return $this->nb_report;
    }

    //  Setters

    public function setId($id) 
    {
        $this->id = $id;
    }
    
    public function setChapter_id($chapter_id) 
    {
        $this->chapter_id = $chapter_id;
    }
    
    public function setAuthor($author) 
    {
        $this->author = $author;
    }
    
    public function setComment($comment) 
    {
        $this->comment = $comment;
    }
    
    public function setComment_date($comment_date) 
    {
        $this->comment_date = $comment_date;
    }

    public function setNb_report($nb_report) 
    {
        $this->nb_report = $nb_report;
    }
}