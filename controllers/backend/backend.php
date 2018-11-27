<?php

// Chargement des classes

require_once('models/Chapter.php');
require_once('models/backend/CommentAdminManager.php');
require_once('models/Comment.php');

class BackendController 
{
    public function admin()
    {        
        $chapterManager = new \Forteroche\Models\ChapterManager();
        $chapters = $chapterManager->getChapters();

        $commentManager = new \Forteroche\Models\CommentAdminManager();
        $comments = $commentManager->getComments();

        require('view/backend/adminView.php');
    }
}
