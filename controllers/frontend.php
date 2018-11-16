<?php

 // Chargement des classes
require_once('models/ChapterManager.php');
require_once('models/CommentManager.php');

class FrontendController 
{
    public function listChapters()
    {
        $chapterManager = new \Forteroche\Models\ChapterManager();
        $chapters = $chapterManager->getChapters();
        
        $newChapters = $this->chaptersBlockCharacter($chapters);

        require('view/frontend/listChaptersView.php');
    }
    
    public function chaptersBlockCharacter($chapters)
    {
        $newChapters = [];
        $i = 0;
         while ($data = $chapters->fetch())
        {
            $newChapters[$i]['id'] = $data['id'];
            if (strlen($data['content'])>400) 
            {
                $data['content']=substr($data['content'], 0, 400);
                $dernier_mot=strrpos($data['content']," ");
                $data['content']=substr($data['content'],0,$dernier_mot);
            }
            $newChapters[$i]['content'] = $data['content'];
            $newChapters[$i]['title'] = $data['title'];
            $newChapters[$i]['author'] = $data['author'];
            $newChapters[$i]['creation_date_fr'] = $data['creation_date_fr'];
             $i++;
        }
        return $newChapters;
    }
     public function chapter()
    {
        $chapterManager = new \Forteroche\Models\ChapterManager();
        $commentManager = new \Forteroche\Models\CommentManager();
         $chapter = $chapterManager->getChapter($_GET['id']);
        $comments = $commentManager->getComments($_GET['id']);
         require('view/frontend/chapterView.php');
    }
     public function addComment($chapterId, $author, $comment)
    {
        $commentManager = new \Forteroche\Models\CommentManager();
         $affectedLines = $commentManager->chapterComment($chapterId, $author, $comment);
         if ($affectedLines === false) {
            throw new Exception('Impossible d\'ajouter le commentaire !');
        }
        else {
            header('Location: index.php?action=chapter&id=' . $chapterId);
        }
    }
     public function home()
    {
        $chapterManager = new \Forteroche\Models\ChapterManager();
        $lastChapter = $chapterManager->getLastChapter();
         $newChapters = $this->chaptersBlockCharacter($lastChapter);
         require('view/frontend/homeView.php');
    }

    public function about()
    {
        require('view/frontend/aboutView.php');
    }
}
