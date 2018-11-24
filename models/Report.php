<?php 

namespace Forteroche\Models;

class Report
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

    public function getId_comment() 
    {
        return $this->id_comment;
    }

    public function getReport_date() 
    {
        return $this->report_date;
    }

    //  Setters

    public function setId($id) 
    {
        $this->id = $id;
    }
    
    public function setId_comment($id_comment) 
    {
        $this->id_comment = $id_comment;
    }
    
    public function setReport_date($report_date) 
    {
        $this->report_date = $report_date;
    }
}