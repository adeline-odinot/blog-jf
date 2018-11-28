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
}