<?php

namespace Forteroche\Models;

require_once('Model.php');

class Chapter extends Model
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

    public function setId(int $id) 
    {
        $this->id = $id;
    }
    
    public function setTitle(string $title) 
    {
        $this->title = $title;
    }
    
    public function setContent(string $content) 
    {
        $this->content = $content;
    }
    
    public function setAuthor(string $author) 
    {
        $this->author = $author;
    }
    
    public function setCreation_date_fr(string $creation_date) 
    {
        $this->creation_date = $creation_date;
    }

    public function setUpdate_date_fr($update_date_fr) 
    {
        if ($update_date_fr === NULL || is_string($update_date_fr))
        {
            $this->update_date_fr = $update_date_fr;
        }
    }
}