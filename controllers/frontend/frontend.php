<?php

// Chargement des classes
require_once('models/frontend/ChapterManager.php');
require_once('models/frontend/CommentManager.php');
require_once('models/frontend/UserManager.php');
require_once('models/frontend/ReportManager.php');

class FrontendController
{
    public function listChapters()
    {
        $chapterManager = new \Forteroche\Models\ChapterManager();
        $chapters = $chapterManager->getChapters();

        require('view/frontend/listChaptersView.php');
    }

    public function chapter($chapterId)
    {
        $chapterManager = new \Forteroche\Models\ChapterManager();
        $commentManager = new \Forteroche\Models\CommentManager();

        $chapter = $chapterManager->getChapter($chapterId);
        $comments = $commentManager->getComments($chapterId);

        require('view/frontend/chapterView.php');
    }

    public function addComment($chapterId, $author, $comment_content)
    {       
        $addCommentMsg = array('authorError' => '', 'commentError' => '','isSuccess' => false);

        $addCommentMsg['isSuccess'] = true;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') 
        {
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

    public function home()
    {
        $chapterManager = new \Forteroche\Models\ChapterManager();
        $lastChapter = $chapterManager->getLastChapter();

        require('view/frontend/homeView.php');
    }

    public function about()
    {
        require('view/frontend/aboutView.php');
    }
    
    public function login()
    {
        require('view/frontend/loginView.php');
    }

    public function formLogin($user_pseudo, $user_password)
    {
        $userManager = new \Forteroche\Models\UserManager();

        $user_id = $userManager->isExist($user_pseudo);

        $login = array('id' => '', 'password' => '', 'messageError' => '', 'idError' => '', 'passwordError' => '', 'isSuccess' => false);
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') 
        { 
            $login['id'] = $this->test_input($user_pseudo);
            $login['password'] = $this->test_input($user_password);
            $login['isSuccess'] = true;

            if (empty($login['id']))
            {
                $login['idError'] = 'Vous devez entrer votre identifiant.';
                $login['isSuccess'] = false; 
            }
            if (empty($login['password']))
            {
                $login['passwordError'] = 'Vous devez entrer votre mot de passe.';
                $login['isSuccess'] = false; 
            }
            if (!empty($login['id']) && (!empty($login['password'])))
            {
                if (($user_id < 0) || (!password_verify($user_password, $user_id)))
                {
                    $login['messageError'] = 'Votre identifiant ou votre mot de passe est incorrect.';
                    $login['isSuccess'] = false; 
                }
            }
            echo json_encode($login);
        }
    }

    public function legalNotice()
    {
        require('view/frontend/legalNoticeView.php');
    }

    public function contact()
    {
        require('view/frontend/contactView.php');
    }
    
    public function formContact($name, $email, $phone, $message)
    {
        $contact = array('name' => '', 'email' => '', 'phone' => '', 'message' => '', 'nameError' => '', 'emailError' => '', 'phoneError' => '', 'messageError' => '', 'isSuccess' => false);
        $emailTo = 'adeline.odinot1997@gmail.com';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') 
        { 
            $contact['name'] = $this->test_input($name);
            $contact['email'] = $this->test_input($email);
            $contact['phone'] = $this->test_input($phone);
            $contact['message'] = $this->test_input($message);
            $contact['isSuccess'] = true; 
            $emailText = '';

            if (empty($contact['name']))
            {
                $contact['nameError'] = 'Vous devez entrer votre nom.';
                $contact['isSuccess'] = false; 
            } 
            else
            {
                $emailText .= 'Name: {$contact["name"]}\n';
            }

            if(!$this->isEmail($contact['email'])) 
            {
                $contact['emailError'] = 'Vous devez entrer une adresse e-mail valide.';
                $contact['isSuccess'] = false; 
            } 
            else
            {
                $emailText .= 'Email: {$contact["email"]}\n';
            }

            if (!$this->isPhone($contact['phone']))
            {
                $contact['phoneError'] = 'Vous devez entrer un numéro de téléphone valide.';
                $contact['isSuccess'] = false; 
            }
            else
            {
                $emailText .= 'Phone: {$contact["phone"]}\n';
            }

            if (empty($contact['message']))
            {
                $contact['messageError'] = 'Vous devez entrer un message.';
                $contact['isSuccess'] = false; 
            }
            else
            {
                $emailText .= 'Message: {$contact["message"]}\n';
            }
            
            if($contact['isSuccess']) 
            {
                $headers = 'From: {$contact["name"]} <{$contact["email"]}>\r\nReply-To: {$contact["email"]}';
                mail($emailTo, 'Un message du site Jean FORTEROCHE', $emailText, $headers);
            }

            echo json_encode($contact);
        }
    }

    protected function isEmail($email) 
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    protected function isPhone($phone) 
    {
        return preg_match('/^(0|\+33)[1-9]([-. ]?[0-9]{2}){4}$/m',$phone);
    }

    protected function test_input($data) 
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

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

    public function nbReport($id_comment)
    {

        $reportManager = new \Forteroche\Models\ReportManager();
        $arrayReport = array('id_comment' => $id_comment);
        $report = new \Forteroche\Models\Report($arrayReport);
        $nbReport = $reportManager->getNbReport($report);
        $commentManager = new \Forteroche\Models\CommentManager();

        if ($nbReport >= 10)
        {
            $archive = $commentManager->archive($commentManager->getComment($id_comment));
        }
    }
}
