<?php

namespace Forteroche\Models;

require_once("models/Manager.php");
require_once("models/Chapter.php");

class ChapterManager extends Manager
{
    public function getChapters()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, content, author, update_date, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr, DATE_FORMAT(update_date, \'%d/%m/%Y à %Hh%imin%ss\') AS update_date_fr FROM chapters ORDER BY creation_date DESC LIMIT 0, 5');

        $chapters = [];

        while ($donnees = $req->fetch(\PDO::FETCH_ASSOC))
        {
          $chapters[] = new Chapter($donnees);
        }
    
        return $chapters;
    }

    public function getChapter($chapterId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, content, author, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM chapters WHERE id = ?');
        $req->execute(array($chapterId));
        $chapter = $req->fetch(\PDO::FETCH_ASSOC);

        return new Chapter($chapter);
    }

    public function getLastChapter()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, content, author, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM chapters ORDER BY creation_date DESC LIMIT 0, 1');
        $chapter = $req->fetch(\PDO::FETCH_ASSOC);
        
        return new Chapter($chapter);
    }
}