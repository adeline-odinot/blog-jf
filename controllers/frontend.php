<?php

 // Chargement des classes
require_once('models/ChapterManager.php');
require_once('models/CommentManager.php');
require_once('models/UserManager.php');

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

    public function contact()
    {
        require('view/frontend/contactView.php');
    }
    
    public function formContact($name, $email, $phone, $message)
    {
        $array = array('name' => '', 'email' => '', 'phone' => '', 'message' => '', 'nameError' => '', 'emailError' => '', 'phoneError' => '', 'messageError' => '', 'isSuccess' => false);
        $emailTo = 'adeline.odinot1997@gmail.com';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') 
        { 
            $array['name'] = $this->test_input($name);
            $array['email'] = $this->test_input($email);
            $array['phone'] = $this->test_input($phone);
            $array['message'] = $this->test_input($message);
            $array['isSuccess'] = true; 
            $emailText = '';

            if (empty($array['name']))
            {
                $array['nameError'] = 'Vous devez entrer votre nom.';
                $array['isSuccess'] = false; 
            } 
            else
            {
                $emailText .= 'Name: {$array["name"]}\n';
            }

            if(!$this->isEmail($array['email'])) 
            {
                $array['emailError'] = 'Vous devez entrer une adresse e-mail valide.';
                $array['isSuccess'] = false; 
            } 
            else
            {
                $emailText .= 'Email: {$array["email"]}\n';
            }

            if (!$this->isPhone($array['phone']))
            {
                $array['phoneError'] = 'Vous devez entrer un numéro de téléphone valide.';
                $array['isSuccess'] = false; 
            }
            else
            {
                $emailText .= 'Phone: {$array["phone"]}\n';
            }

            if (empty($array['message']))
            {
                $array['messageError'] = 'Vous devez entrer un message';
                $array['isSuccess'] = false; 
            }
            else
            {
                $emailText .= 'Message: {$array["message"]}\n';
            }
            
            if($array['isSuccess']) 
            {
                $headers = 'From: {$array["name"]} <{$array["email"]}>\r\nReply-To: {$array["email"]}';
                mail($emailTo, 'Un message du site Jean FORTEROCHE', $emailText, $headers);
            }

            echo json_encode($array);
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
}
