<?php

namespace Forteroche\Models;

require_once("models/Manager.php");
require_once("models/Comment.php");

class CommentAdminManager extends Manager
{
    public function getComments()
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id_comment AS id , author, comment, COUNT(id_comment) AS nb_report , comment_date FROM comments, report WHERE id_comment = comments.id GROUP BY id_comment ORDER BY nb_report DESC');
        $comments->execute();

        $comment = [];

        while ($donnees = $comments->fetch(\PDO::FETCH_ASSOC))
        {
          $comment[] = new Comment($donnees);
        }
    
        return $comment;
    }
}