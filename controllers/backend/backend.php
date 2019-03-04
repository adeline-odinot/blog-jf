<?php

// Chargement des classes

require_once('models/backend/ChapterAdminManager.php');
require_once('models/frontend/ChapterManager.php');
require_once('models/frontend/UserManager.php');
require_once('models/Chapter.php');
require_once('models/backend/CommentAdminManager.php');
require_once('models/Comment.php');
require_once('models/User.php');
require_once('models/backend/UserAdminManager.php');

class BackendController 
{
    // Sécurise l'administration

    public function secure($user_pseudo)
    {
        $arrayUser = array('user_pseudo' => $user_pseudo);
        $user = new \Forteroche\Models\User($arrayUser);

        $userManager = new \Forteroche\Models\UserManager();
        $userRank = $userManager->isAdmin($user);
        
        if (sha1($user_pseudo.'tonchatestrose') === $_COOKIE['secure'])
        {
            if ($userRank !== '1')
            {
                return false;
            }
            else
            {
                return true;
            }
        }
        else
        {
            throw new Exception('Raté ! Essaye encore !');
        }
    }

    // Affiche la page d'administration avec le tableau des chapitres et commentaires.

    public function admin()
    {        
        $chapterManager = new \Forteroche\Models\ChapterAdminManager();
        $chapters = $chapterManager->getChapters();

        $commentManager = new \Forteroche\Models\CommentAdminManager();
        $comments = $commentManager->getComments();

        require('view/backend/adminView.php');
    }

    // Affiche la page du formulaire d'ajout d'un chapitre.

    public function addChapterView()
    {
        require('view/backend/addChapterView.php');
    }

    // Ajoute un chapitre et affiche les messages d'erreurs du formulaire.

    public function addChapter($title, $content, $author)
    {       
        $chapterAdminManager = new \Forteroche\Models\ChapterAdminManager();

        $addChapterMsg = array('titleError' => '', 'contentError' => '',  'authorError' => '', 'isSuccess' => false);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') 
        {
            $title = $this->test_input($title);
            $content = $this->test_input($content);
            $author = $this->test_input($author);
            $addChapterMsg['isSuccess'] = true;

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

    // Affiche la page de modification d'un chapitre.

    public function chapterEditView($id)
    {
        $chapterManager = new \Forteroche\Models\ChapterManager();
        $chapters = $chapterManager->getChapter($id);

        require('view/backend/chapterEditView.php');
    }

    // Modifie un chapitre et affiche les messages d'erreurs du formulaire.

    public function chapterEdit($title, $content, $author, $id)
    {       
        $chapterAdminManager = new \Forteroche\Models\ChapterAdminManager();

        $editChapterMsg = array('titleError' => '', 'contentError' => '',  'authorError' => '', 'isSuccess' => false);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') 
        {
            $title = $this->test_input($title);
            $content = $this->test_input($content);
            $author = $this->test_input($author);
            $editChapterMsg['isSuccess'] = true;

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

    // Supprime un chapitre et ses commentaires.

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
    
    // Affiche la page de modification d'un commentaire.

    public function commentEditView($id)
    {   
        $commentManager = new \Forteroche\Models\CommentManager();
        $comment = $commentManager->getComment($id);

        require('view/backend/commentEditView.php');
    }

    //  Modifie un commentaire et affiche les messages d'erreurs du formulaire.

    public function commentEdit($author, $comment, $id)
    {       
        $commentAdminManager = new \Forteroche\Models\CommentAdminManager();

        $editCommentMsg = array('authorError' => '', 'commentError' => '','isSuccess' => false);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') 
        {
            $author = $this->test_input($author);
            $comment = $this->test_input($comment);
            $editCommentMsg['isSuccess'] = true;

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

    // Supprime un commentaire signalé.

    public function deleteComment($id)
    {
        if (true)
        {
            $commentAdminManager = new \Forteroche\Models\CommentAdminManager();
            $deleteComment = $commentAdminManager->deleteComment($id);
        }
    }

    // Affiche la page d'inscription d'un d'administrateur.

    public function addUserAdminView()
    {
        require('view/backend/addUserAdminView.php');
    }

    //  Ajoute un administrateur et affiche les messages d'erreurs du formulaire.

    public function formAddUserAdmin($user_pseudo, $user_password, $user_confirm, $user_email)
    {
        $userAdminManager = new \Forteroche\Models\UserAdminManager();

        $arrayUser = array('user_pseudo' => $user_pseudo);
        $user = new \Forteroche\Models\User($arrayUser);

        $user_id = $userAdminManager->getUsers($user);

        $addAdminMsg = array('idError' => '', 'passError' => '', 'passConfirmError' => '','emailError' => '', 'isSuccess' => false);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') 
        { 
            $user_pseudo = $this->test_input($user_pseudo);
            $user_password = htmlspecialchars($user_password);
            $user_email = $this->test_input($user_email);
            $addAdminMsg['isSuccess'] = true; 

            $pass_hash = password_hash($user_password, PASSWORD_DEFAULT);

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
            
            /* Succès */

            if($addAdminMsg['isSuccess']) 
            {
                $arrayAddUserAdmin = array('user_pseudo' => $user_pseudo, 'user_password' => $pass_hash, 'user_email' => $user_email);
                $user = new \Forteroche\Models\User($arrayAddUserAdmin);
                $userAdminManager = new \Forteroche\Models\UserAdminManager();
                $addUser = $userAdminManager->addUserAdmin($user);
            }

            echo json_encode($addAdminMsg);
        }
    }
        // Vérifie si l'adresse e-mail rempli dans le formulaire est correct.

        protected function isEmail($email) 
        {
            return filter_var($email, FILTER_VALIDATE_EMAIL);
        }
    
        // Sécurisation des inputs
    
        protected function test_input($data) 
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars_decode($data);
            return $data;
        }
}