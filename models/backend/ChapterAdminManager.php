<?php

namespace Forteroche\Models;

require_once("models/Manager.php");
require_once("models/Chapter.php");

class ChapterAdminManager extends Manager
{
    public function getChapters()
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, content, author, update_date, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr, DATE_FORMAT(update_date, \'%d/%m/%Y à %Hh%imin%ss\') AS update_date_fr FROM chapters ORDER BY creation_date DESC');
        $req->execute();

        $chapters = [];

        while ($donnees = $req->fetch(\PDO::FETCH_ASSOC))
        {
          $chapters[] = new Chapter($donnees);
        }
    
        return $chapters;
    }

    public function addChapter($addChapter)
    {   
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO chapters(title, content, creation_date, author) VALUES(:title, :content, NOW(), :author)');
        $req->bindValue(':title', $addChapter->getTitle(), \PDO::PARAM_STR);
        $req->bindValue(':content', $addChapter->getContent(), \PDO::PARAM_STR);
        $req->bindValue(':author', $addChapter->getAuthor(), \PDO::PARAM_STR);
        $req->execute();

        return $req;
    }

    public function updateChapter($updateChapter)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE chapters SET title = :title, content = :content, author = :author, update_date = NOW() WHERE id = :id');
        $req->bindValue(':title', $updateChapter->getTitle(), \PDO::PARAM_STR);
        $req->bindValue(':content', $updateChapter->getContent(), \PDO::PARAM_STR);
        $req->bindValue(':author', $updateChapter->getAuthor(), \PDO::PARAM_STR);
        $req->bindValue(':id', $updateChapter->getId(), \PDO::PARAM_INT);
        $req->execute();

        return $req;
    }

    public function deleteChapter($id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM chapters WHERE id = :id');
        $req->bindValue(':id', $id, \PDO::PARAM_INT);
        $req->execute();

        return $req;
    }
}