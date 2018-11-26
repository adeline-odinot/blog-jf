<?php

namespace Forteroche\Models;

require_once("models/Manager.php");
require_once("models/Comment.php");

class CommentManager extends Manager
{
    public function getComments($chapterId)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT * FROM comments WHERE chapter_id = ? AND archive = 0 ORDER BY comment_date DESC');
        $comments->execute(array($chapterId));

        $comment = [];

        while ($donnees = $comments->fetch(\PDO::FETCH_ASSOC))
        {
          $comment[] = new Comment($donnees);
        }
    
        return $comment;
    }

    public function getComment($id)
    {
        $db = $this->dbConnect();
        $comment = $db->prepare('SELECT * FROM comments WHERE id = :id');
        $comment->bindValue(':id', $id, \PDO::PARAM_INT);
        $comment->execute();

        $data = $comment->fetch(\PDO::FETCH_ASSOC);
    
        return new Comment($data);
    }

    public function chapterComment($comment)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO comments(chapter_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())');
        $affectedLines = $comments->execute(array($comment->getChapter_id(), $comment->getAuthor(), $comment->getComment()));

        return $affectedLines;
    }

    public function archive($comments)
    {
        $db = $this->dbConnect();
        $archive = $db->prepare('UPDATE comments SET archive = 1 WHERE id = :id');
        $archive->bindValue(':id', $comments->getId(), \PDO::PARAM_INT);
        $archive->execute();
        return $archive;
    }
}