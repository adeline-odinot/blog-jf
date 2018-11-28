<?php

// Chargement des classes

require_once('models/backend/ChapterAdminManager.php');
require_once('models/frontend/ChapterManager.php');
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

    public function addChapter($title, $content, $author)
    {       
        $chapterAdminManager = new \Forteroche\Models\ChapterAdminManager();

        $addChapterMsg = array('titleError' => '', 'contentError' => '',  'authorError' => '', 'isSuccess' => false);

        $addChapterMsg['isSuccess'] = true;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') 
        {
            if (empty($title))
            {
                $addChapterMsg['titleError'] = 'Vous devez entrer le titre du chapitre.';
                $addChapterMsg['isSuccess'] = false; 
            }

            if (empty($content))
            {
                $addChapterMsg['contentError'] = 'Vous devez entrer le texte du chapitre.';
                $addChapterMsg['isSuccess'] = false; 
            }

            if (empty($author))
            {
                $addChapterMsg['authorError'] = 'Vous devez entrer l\'auteur du chapitre.';
                $addChapterMsg['isSuccess'] = false; 
            }

            if($addChapterMsg['isSuccess'])  
            {
                $arrayAddChapter = array('title' => $title, 'content' => $content, 'author' => $author);

                $chapter = new \Forteroche\Models\Chapter($arrayAddChapter);

                $addChapter = $chapterAdminManager->addChapter($chapter);
            }
            echo json_encode($addChapterMsg);
        }
    }

    public function addChapterView()
    {
        require('view/backend/addChapterView.php');
    }
}
