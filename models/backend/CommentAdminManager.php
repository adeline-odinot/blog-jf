<?php

namespace Forteroche\Models;

require_once("models/Manager.php");
require_once("models/Comment.php");

class CommentAdminManager extends Manager
{
    // Récupère dans la BDD tous les commentaires.

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

    // Modifie dans la BDD un commentaire.

    public function updateComment($update)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE comments SET author = :author, comment = :comment WHERE id = :id');
        $req->bindValue(':author', $update->getAuthor(), \PDO::PARAM_STR);
        $req->bindValue(':comment', $update->getComment(), \PDO::PARAM_STR);
        $req->bindValue(':id', $update->getId(), \PDO::PARAM_INT);
        $req->execute();

        return $req;
    }

    // Supprime dans la BDD un commentaire.

    public function deleteComment($id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM comments WHERE id = :id');
        $req->bindValue(':id', $id, \PDO::PARAM_INT);
        $req->execute();

        return $req;
    }

    // Supprime dans la BDD tous les commentaires d'un chapitre.

    public function deleteAllCommentChapter($chapter_id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM comments WHERE chapter_id = :chapter_id');
        $req->bindValue(':chapter_id', $chapter_id, \PDO::PARAM_INT);
        $req->execute();

        return $req;
    }
}