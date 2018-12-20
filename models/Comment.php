<?php 

namespace Forteroche\Models;

require_once('Model.php');

class Comment extends Model
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

    public function setId(int $id) 
    {
        $this->id = $id;
    }
    
    public function setChapter_id(int $chapter_id) 
    {
        $this->chapter_id = $chapter_id;
    }
    
    public function setAuthor(string $author) 
    {
        $this->author = $author;
    }
    
    public function setComment(string $comment) 
    {
        $this->comment = $comment;
    }
    
    public function setComment_date(string $comment_date) 
    {
        $this->comment_date = $comment_date;
    }

    public function setNb_report(int $nb_report) 
    {
        $this->nb_report = $nb_report;
    }
}