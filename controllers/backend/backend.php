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

    public function chapterEdit($title, $content, $author, $id)
    {       
        $chapterAdminManager = new \Forteroche\Models\ChapterAdminManager();

        $editChapterMsg = array('titleError' => '', 'contentError' => '',  'authorError' => '', 'isSuccess' => false);

        $editChapterMsg['isSuccess'] = true;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') 
        {
            if (empty($title))
            {
                $editChapterMsg['titleError'] = 'Vous devez entrer le titre du chapitre.';
                $editChapterMsg['isSuccess'] = false; 
            }

            if (empty($content))
            {
                $editChapterMsg['contentError'] = 'Vous devez entrer le texte du chapitre.';
                $editChapterMsg['isSuccess'] = false; 
            }

            if (empty($author))
            {
                $editChapterMsg['authorError'] = 'Vous devez entrer l\'auteur du chapitre.';
                $editChapterMsg['isSuccess'] = false; 
            }

            if($editChapterMsg['isSuccess'])  
            {
                $chapterAdminManager = new \Forteroche\Models\ChapterAdminManager();

                $arrayUpdateChapter = array('title' => $title, 'content' => $content, 'author' => $author, 'id' => $id);
        
                $chapter = new \Forteroche\Models\Chapter($arrayUpdateChapter);
        
                $updateAdminChapter = $chapterAdminManager->updateChapter($chapter);
            }
            echo json_encode($editChapterMsg);
        }
    }

    public function chapterEditView($id)
    {
        $chapterManager = new \Forteroche\Models\ChapterManager();
        $chapters = $chapterManager->getChapter($id);

        require('view/backend/chapterEditView.php');
    }
}
