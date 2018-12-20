<?php 

namespace Forteroche\Models;

require_once('Model.php');

class Report extends Model
{
    // Attributs
    private $id;
    private $id_comment;
    private $report_date;

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

    public function getId_comment() 
    {
        return $this->id_comment;
    }

    public function getReport_date() 
    {
        return $this->report_date;
    }

    //  Setters

    public function setId(int $id) 
    {
        $this->id = $id;
    }
    
    public function setId_comment(int $id_comment) 
    {
        $this->id_comment = $id_comment;
    }
    
    public function setReport_date(string $report_date) 
    {
        $this->report_date = $report_date;
    }
}