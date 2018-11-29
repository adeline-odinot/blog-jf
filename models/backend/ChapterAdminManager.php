<?php

namespace Forteroche\Models;

require_once("models/Manager.php");
require_once("models/Chapter.php");

class ChapterAdminManager extends Manager
{
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
}