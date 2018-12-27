<?php

// Chargement des classes
require_once('models/frontend/ChapterManager.php');
require_once('models/frontend/CommentManager.php');
require_once('models/frontend/UserManager.php');
require_once('models/frontend/ReportManager.php');

class FrontendController
{

    // Page d'accueil avec son dernier chapitre.

    public function home()
    {
        $chapterManager = new \Forteroche\Models\ChapterManager();
        $lastChapter = $chapterManager->getLastChapter();

        require('view/frontend/homeView.php');
    }

    // Affiche un chapitre et ses commentaires avec pagination des commentaires.

    public function chapter($chapterId, $cPage)
    {
        $chapterManager = new \Forteroche\Models\ChapterManager();
        $commentManager = new \Forteroche\Models\CommentManager();

        $nb_comments = $commentManager->getNbComments($chapterId);
        $nb_by_page = 4;
        $nb_page = ceil($nb_comments/$nb_by_page);
        $page_position = ($cPage-1)*$nb_by_page;

        $chapter = $chapterManager->getChapter($chapterId);
        $comments = $commentManager->getComments($chapterId, $page_position, $nb_by_page);

        require('view/frontend/chapterView.php');
    }

    // Ajoute un commentaire et affiche les messages d'erreurs au besoin.

    public function addComment($chapterId, $author, $comment_content)
    {       
        $addCommentMsg = array('authorError' => '', 'commentError' => '','isSuccess' => false);

        $addCommentMsg['isSuccess'] = true;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') 
        {
            $author = $this->test_input($author);
            $comment_content = $this->test_input($comment_content);
            $addCommentMsg['isSuccess'] = true;

            if (empty($author))
            {
                $addCommentMsg['authorError'] = 'Vous devez entrer votre nom.';
                $addCommentMsg['isSuccess'] = false; 
            }

            if (empty($comment_content))
            {
                $addCommentMsg['commentError'] = 'Vous devez entrer votre commentaire.';
                $addCommentMsg['isSuccess'] = false; 
            }

            if($addCommentMsg['isSuccess'])  
            {
                $commentManager = new \Forteroche\Models\CommentManager();

                $arrayComment = array('chapter_id' => $chapterId, 'author' => $author, 'comment' => $comment_content);
        
                $comment = new \Forteroche\Models\Comment($arrayComment);
        
                $commentManager->chapterComment($comment);

                setcookie('author', $_POST['author'], time() + 365*24*3600, null, null, false, true);
            }
            echo json_encode($addCommentMsg);
        }
    }

    // Ajout d'un signalement.

    public function commentReport($id_comment)
    {
        $reportManager = new \Forteroche\Models\ReportManager();
        $arrayReport = array('id_comment' => $id_comment);
        $report = new \Forteroche\Models\Report($arrayReport);
        $reportManager->addReport($report);

        if ($report)
        {
            $archive = $this->nbReport($id_comment);
            echo true;
        }
        else
        {
            throw new Exception('Impossible de signaler le commentaire !');
        }
    }

    // Vérifie si le nombre de report est supérieur à 10 pour l'archiver si c'est le cas.

    public function nbReport($id_comment)
    {

        $reportManager = new \Forteroche\Models\ReportManager();
        $arrayReport = array('id_comment' => $id_comment);
        $report = new \Forteroche\Models\Report($arrayReport);
        $nbReport = $reportManager->getNbReport($report);


        if ($nbReport >= 10)
        {
            $commentManager = new \Forteroche\Models\CommentManager();
            $archive = $commentManager->archive($commentManager->getComment($id_comment));
        }
    }

   // Affiche la page à propos.

    public function about()
    {
        require('view/frontend/aboutView.php');
    }

    // Affiche tous les chapitres avec paginations des chapitres.

    public function listChapters($cPage)
    {
        $chapterManager = new \Forteroche\Models\ChapterManager();

        $nb_chapters = $chapterManager->getNbChapters();
        $nb_by_page = 4;
        $nb_page = ceil($nb_chapters/$nb_by_page);
        $page_position = ($cPage-1)*$nb_by_page;

        $chapters = $chapterManager->getChapters($page_position, $nb_by_page);

        require('view/frontend/listChaptersView.php');
    }

    // Affiche la page des contacts

    public function contact()
    {
        require('view/frontend/contactView.php');
    }

    // Affiche les messages d'erreurs du formulaire de contact et permet l'envoi d'un e-mail.
    
    public function formContact($name, $email, $phone, $message)
    {
        $contactMsg = array('nameError' => '', 'emailError' => '', 'phoneError' => '', 'messageError' => '', 'isSuccess' => false);
        $emailTo = 'adeline.odinot1997@gmail.com';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') 
        { 

            $name = $this->test_input($name);
            $email = $this->test_input($email);
            $phone = $this->test_input($phone);
            $message = $this->test_input($message);
            $contactMsg['isSuccess'] = true; 
            $emailText = '';

            if (empty($name))
            {
                $contactMsg['nameError'] = 'Vous devez entrer votre nom.';
                $contactMsg['isSuccess'] = false; 
            } 
            else
            {
                $emailText .= "Nom: {$name}\n";
            }

            if(!$this->isEmail($email)) 
            {
                $contactMsg['emailError'] = 'Vous devez entrer une adresse e-mail valide.';
                $contactMsg['isSuccess'] = false; 
            } 
            else
            {
                $emailText .= "E-mail: {$email}\n";
            }

            if (!$this->isPhone($phone))
            {
                $contactMsg['phoneError'] = 'Vous devez entrer un numéro de téléphone valide.';
                $contactMsg['isSuccess'] = false; 
            }
            else
            {
                $emailText .= "Numéro de téléphone: {$phone}\n";
            }

            if (empty($message))
            {
                $contactMsg['messageError'] = 'Vous devez entrer un message.';
                $contactMsg['isSuccess'] = false; 
            }
            else
            {
                $emailText .= "Message: {$message}\n";
                                
            }
            
            if($contactMsg['isSuccess']) 
            {
                $headers = "From: {".$name."} <{".$email."}>\r\nReply-To: {".$email."}";
                mail($emailTo, 'Un message du site Jean FORTEROCHE', $emailText, $headers);
            }

            echo json_encode($contactMsg);
        }
    }

    // Vérifie si l'adresse e-mail rempli dans le formulaire est correct.

    protected function isEmail($email) 
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    // Vérifie si le numéro de téléphone rempli dans le formulaire est correct.

    protected function isPhone($phone) 
    {
        return preg_match('/^(0|\+33)[1-9]([-. ]?[0-9]{2}){4}$/m',$phone);
    }

    // Sécurisation des inputs

    protected function test_input($data) 
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars_decode($data);
        return $data;
    }

    // Affiche la page de connexion.

    public function login()
    {
        require('view/frontend/loginView.php');
    }

    // Affiche les messages d'erreurs du formulaire de connexion et permet la connexion.

    public function formLogin($user_pseudo, $user_password)
    {
        $userManager = new \Forteroche\Models\UserManager();

        $arrayUser = array('user_pseudo' => $user_pseudo);
        $user = new \Forteroche\Models\User($arrayUser);

        $user_id = $userManager->isExist($user);

        $loginMsg = array('messageError' => '', 'idError' => '', 'passwordError' => '', 'isSuccess' => false);
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') 
        { 
            $user_pseudo = $this->test_input($user_pseudo);
            $user_password = htmlspecialchars($user_password);
            $loginMsg['isSuccess'] = true;

            if (empty($user_pseudo))
            {
                $loginMsg['idError'] = 'Vous devez entrer votre identifiant.';
                $loginMsg['isSuccess'] = false; 
            }
            if (empty($user_password))
            {
                $loginMsg['passwordError'] = 'Vous devez entrer votre mot de passe.';
                $loginMsg['isSuccess'] = false; 
            }
            if (!empty($user_pseudo) && (!empty($user_password)))
            {
                if (($user_id < 0) || (!password_verify($user_password, $user_id)))
                {
                    $loginMsg['messageError'] = 'Votre identifiant ou votre mot de passe est incorrect.';
                    $loginMsg['isSuccess'] = false; 
                }
            }
            if ($loginMsg['isSuccess'])
            {
                if (isset($_POST['remember']))
                {
                    setcookie('id', $user_pseudo, time() + 365*24*3600, null, null, false, true);
                    setcookie('secure', sha1($user_pseudo.'tonchatestrose'), time() + 365*24*3600, null, null, false, true);
                }
                else
                {
                    setcookie('id', $user_pseudo, time() + 2*3600, null, null, false, true);
                    setcookie('secure', sha1($user_pseudo.'tonchatestrose'), time() + 2*3600, null, null, false, true);
                }
            }
            echo json_encode($loginMsg);
        }
    }

    // Permet de se deconnecter

    public function disconnectView()
    {
        require('view/frontend/disconnectView.php');
    }

    // Affiche la page des mentions légales

    public function legalNotice()
    {
        require('view/frontend/legalNoticeView.php');
    }
}