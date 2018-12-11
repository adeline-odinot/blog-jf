<?php

// Chargement des classes

require_once('models/backend/ChapterAdminManager.php');
require_once('models/frontend/ChapterManager.php');
require_once('models/Chapter.php');
require_once('models/backend/CommentAdminManager.php');
require_once('models/Comment.php');
require_once('models/User.php');
require_once('models/backend/UserAdminManager.php');


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

    public function commentEditView($id)
    {   
        $commentManager = new \Forteroche\Models\CommentManager();
        $comment = $commentManager->getComment($id);

        require('view/backend/commentEditView.php');
    }

    public function commentEdit($author, $comment, $id)
    {       
        $commentAdminManager = new \Forteroche\Models\CommentAdminManager();

        $editCommentMsg = array('authorError' => '', 'commentError' => '','isSuccess' => false);

        $editCommentMsg['isSuccess'] = true;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') 
        {
            if (empty($author))
            {
                $editCommentMsg['authorError'] = 'Vous devez entrer l\'auteur du commentaire.';
                $editCommentMsg['isSuccess'] = false; 
            }

            if (empty($comment))
            {
                $editCommentMsg['commentError'] = 'Vous devez entrer le commentaire.';
                $editCommentMsg['isSuccess'] = false; 
            }

            if($editCommentMsg['isSuccess'])  
            {
                $commentAdminManager = new \Forteroche\Models\CommentAdminManager();

                $arrayUpdateComment = array('author' => $author, 'comment' => $comment, 'id' => $id);
        
                $comment = new \Forteroche\Models\Comment($arrayUpdateComment);
        
                $updateAdminComment = $commentAdminManager->updateComment($comment);
            }
            echo json_encode($editCommentMsg);
        }
    }

    public function deleteChapter($id)
    {
        if (true)
        {
            $chapterAdminManager = new \Forteroche\Models\ChapterAdminManager();
            $deleteChapter = $chapterAdminManager->deleteChapter($id);

            $commentAdminManager = new \Forteroche\Models\CommentAdminManager();
            $deleteComment = $commentAdminManager->deleteAllCommentChapter($id);
        }
    }

    public function deleteComment($id)
    {
        if (true)
        {
            $commentAdminManager = new \Forteroche\Models\CommentAdminManager();
            $deleteComment = $commentAdminManager->deleteComment($id);
        }
    }

    public function addUserAdminView()
    {
        require('view/backend/addUserAdminView.php');
    }

    public function formAddUserAdmin($user_pseudo, $user_password, $user_confirm, $user_email)
    {
        $userAdminManager = new \Forteroche\Models\UserAdminManager();

        $arrayUser = array('user_pseudo' => $user_pseudo);
        $user = new \Forteroche\Models\User($arrayUser);

        $user_id = $userAdminManager->getUsers($user);

        $addAdminMsg = array('id' => '', 'pass' => '', 'pass-confirm' => '', 'idError' => '', 'passError' => '', 'passConfirmError' => '','emailError' => '', 'isSuccess' => false);
        $emailTo = 'adeline.odinot1997@gmail.com';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') 
        { 
            $user_pseudo = $this->test_input($user_pseudo);
            $user_password = $this->test_input($user_password);
            $user_confirm = $this->test_input($user_confirm);
            $user_email = $this->test_input($user_email);
            $addAdminMsg['isSuccess'] = true; 
            $emailText = '';

            $pass_hash = password_hash($addAdminMsg['pass'], PASSWORD_DEFAULT);

            /* Identifiant */

            if (empty($user_pseudo))
            {
                $addAdminMsg['idError'] = 'Vous devez entrer l\'identifiant.';
                $addAdminMsg['isSuccess'] = false; 
            }
            elseif ($user_id > 0)
            {
                $addAdminMsg['idError'] = 'L\'identifiant a déjà été choisi.';
                $addAdminMsg['isSuccess'] = false; 
            }
            elseif(strlen($user_pseudo) < 8 || strlen($user_pseudo) > 255)
            {
                $addAdminMsg['idError'] = 'L\'identifiant doit être compris entre 8 et 255 caractères.'; 
                $addAdminMsg['isSuccess'] = false; 
            } 
            else
            {
                $emailText .= 'Identifiant: {$addAdminMsg["id"]}\n';
            }

            /*  Mot de passe  */ 

            if (empty($user_password))
            {
                $addAdminMsg['passError'] = 'Vous devez entrer le mot de passe.';
                $addAdminMsg['isSuccess'] = false;  
            }
            elseif(strlen($user_password) < 8 || strlen($user_password) > 255)
            {
                $addAdminMsg['passError'] = 'Le mot de passe doit être compris entre 8 et 255 caractères.'; 
                $addAdminMsg['isSuccess'] = false; 
            } 
            if (empty($user_confirm))
            {
                $addAdminMsg['passConfirmError'] = 'Vous devez confirmer le mot de passe.';
                $addAdminMsg['isSuccess'] = false;  
            }
            elseif ($user_password != $user_confirm)
            {
                $addAdminMsg['passError'] = 'Les mots de passe doivent être identiques.';
                $addAdminMsg['passConfirmError'] = 'Les mots de passe doivent être identiques.';
                $addAdminMsg['isSuccess'] = false; 
            }

            /*  Email  */ 

            if(!$this->isEmail($user_email))
            {
                $addAdminMsg['emailError'] = 'Vous devez entrer une adresse e-mail valide.';
                $addAdminMsg['isSuccess'] = false; 
            } 
            else
            {
                $emailText .= 'Email: {$addAdminMsg["email"]}\n';
            }
            
            /* Succès */

            if($addAdminMsg['isSuccess']) 
            {
                $arrayAddUserAdmin = array('user_pseudo' => $user_pseudo, 'user_password' => $pass_hash, 'user_email' => $user_email);
                $user = new \Forteroche\Models\User($arrayAddUserAdmin);
                $headers = 'From: {$addAdminMsg["id"]} <{$addAdminMsg["email"]}>\r\nReply-To: {$addAdminMsg["email"]}';
                mail($emailTo, 'Merci de votre inscription !', $emailText, $headers);

                $userAdminManager = new \Forteroche\Models\UserAdminManager();
                $addUser = $userAdminManager->addUserAdmin($user);
            }

            echo json_encode($addAdminMsg);
        }
    }

    protected function isEmail($email) 
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    protected function test_input($data) 
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars_decode($data);
        return $data;
    }
}
