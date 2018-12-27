<?php

namespace Forteroche\Models;

require_once("models/Manager.php");
require_once("models/Comment.php");

class CommentManager extends Manager
{
    // Récupère dans la BDD tous les commentaires qui ne sont pas archivés.

    public function getComments($chapterId, $page_position, $nb_by_page)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT * FROM comments WHERE chapter_id = :chapter_id AND archive = 0 ORDER BY comment_date DESC LIMIT :page_position, :nb_by_page');
        $comments->bindValue(':chapter_id', $chapterId, \PDO::PARAM_INT);
        $comments->bindValue(':page_position', intval($page_position), \PDO::PARAM_INT);
        $comments->bindValue(':nb_by_page', intval($nb_by_page), \PDO::PARAM_INT);
        $comments->execute();

        $comment = [];

        while ($donnees = $comments->fetch(\PDO::FETCH_ASSOC))
        {
            $comment[] = new Comment($donnees);
        }
    
        return $comment;
    }

    // Récupère dans la BDD un commentaire selon son id.

    public function getComment($id)
    {
        $db = $this->dbConnect();
        $comment = $db->prepare('SELECT * FROM comments WHERE id = :id');
        $comment->bindValue(':id', $id, \PDO::PARAM_INT);
        $comment->execute();

        $data = $comment->fetch(\PDO::FETCH_ASSOC);
    
        return new Comment($data);
    }

    // Récupère dans la BDD le nombre de commentaires total selon l'id.

    public function getNbComments($chapterId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT COUNT(id) AS $nb_comments FROM comments WHERE chapter_id = :chapter_id ');
        $req->bindValue(':chapter_id', $chapterId, \PDO::PARAM_INT);
        $req->execute();

        return $req->fetchColumn();
    }
            
    // Ajoute dans la BDD un commentaire au chapitre lui correspondant.

    public function chapterComment($comment)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO comments(chapter_id, author, comment, comment_date) VALUES(:chapter_id, :author, :comment, NOW())');
        $comments->bindValue(':chapter_id', $comment->getChapter_id(), \PDO::PARAM_INT);
        $comments->bindValue(':author', $comment->getAuthor(), \PDO::PARAM_STR);
        $comments->bindValue('comment', $comment->getComment(), \PDO::PARAM_STR);
        $affectedLines = $comments->execute();

        return $affectedLines;
    }

    // Archive un commentaire dans la BDD.

    public function archive($comments)
    {
        $db = $this->dbConnect();
        $archive = $db->prepare('UPDATE comments SET archive = 1 WHERE id = :id');
        $archive->bindValue(':id', $comments->getId(), \PDO::PARAM_INT);
        $archive->execute();
        return $archive;
    }
}