<?php

// Chargement des classes

require_once('models/Chapter.php');

class BackendController 
{
    public function admin()
    {        
        $chapterManager = new \Forteroche\Models\ChapterManager();
        $chapters = $chapterManager->getChapters();

        require('view/backend/adminView.php');
    }
}
