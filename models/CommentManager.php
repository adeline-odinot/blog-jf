<?php
 namespace Forteroche\Models;
 require_once("models/Manager.php");
 class CommentManager extends Manager
{
    public function getComments($chapterId)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE chapter_id = ? ORDER BY comment_date DESC');
        $comments->execute(array($chapterId));
         return $comments;
    }
     public function chapterComment($chapterId, $author, $comment)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO comments(chapter_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())');
        $affectedLines = $comments->execute(array($chapterId, $author, $comment));
         return $affectedLines;
    }
} 