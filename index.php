<?php
require('controllers/frontend/frontend.php');
require('controllers/backend/backend.php');

$frontendController = new FrontendController();
$backendController = new BackendController();

try {
    
    if (isset($_GET['action']))
    {
        $action = $_GET['action'];
    
        switch ($action) 
        {
    
            // FRONTEND
    
            case 'listChapters':
                if(isset($_GET['page']) && $_GET['page'] > 0) 
                {
                    $cPage = $_GET['page'];
                }
                else 
                {
                    $cPage = 1;
                }
                $frontendController->listChapters($cPage);
                break;
    
            case 'chapter':
                if (isset($_GET['id']) && $_GET['id'] > 0) 
                {
                    if(isset($_GET['page']) && $_GET['page'] > 0) 
                    {
                        $cPage = $_GET['page'];
                    }
                    else 
                    {
                        $cPage = 1;
                    }
                    $frontendController->chapter($_GET['id'], $cPage);
                }
                else 
                {
                    throw new Exception('Aucun identifiant de chapitre envoyé');
                }
                break;
                
            case 'verifAddComment':
                if (isset($_GET['id']))
                {
                    if(isset($_POST['author']) || isset($_POST['comment']))
                    {
                        $frontendController->addComment($_GET['id'], $_POST['author'], $_POST['comment']);
                    }
                }
                else
                {
                    throw new Exception('Aucun identifiant de chapitre envoyé');
                }
    
                break;
    
            case 'home':
                $frontendController->home();
                break;
    
            case 'about':
                $frontendController->about();
                break;
    
            case 'contact':
                $frontendController->contact();
                break;
    
            case 'verifContact':
                if(isset($_POST['name']) || isset($_POST['email']) || isset($_POST['phone']) || isset($_POST['message']))
                {
                    $frontendController->formContact($_POST['name'], $_POST['email'], $_POST['phone'], $_POST['message']);
                }
                break;
    
            case 'login':
                $frontendController->login();
                break;
            
            case 'verifLogin':
                if (isset($_POST['id']) || isset($_POST['pass']))
                {
                    $frontendController->formLogin($_POST['id'], $_POST['pass']);
                }
                break;
            
            case 'legalNotice':
                $frontendController->legalNotice();
                break;
    
            case 'report':
                if (isset($_GET['id_comment']))
                {
                    $frontendController->commentReport($_GET['id_comment']);
                }
                else
                {
                    throw new Exception('Aucun identifiant de commentaire envoyé');
                }
                break;
    
            case 'disconnect':
                $frontendController->disconnectView();
                break;
            
            // BACKEND
    
            case 'admin':
                if (isset($_COOKIE['id']))
                {
                    if ($backendController->secure($_COOKIE['id']))
                    {
                        $backendController->admin();
                    }
                }
                else
                {
                    $frontendController->home();
                }
                break;
            
            case 'chapterEdit':
                if (isset($_COOKIE['id']))
                {
                    if ($backendController->secure($_COOKIE['id']))
                    {
                        $backendController->chapterEditView($_GET['id']);
                    }
                }
                else
                {
                    $frontendController->home();
                }
                break;
    
            case 'verifChapterEdit':
                if (isset($_COOKIE['id']))
                {
                    if ($backendController->secure($_COOKIE['id']))
                    {
                        $backendController->chapterEdit($_POST['title'], $_POST['content'], $_POST['author'], $_GET['id']);
                    }
                }
                else
                {
                    $frontendController->home();
                }
                break;
    
            case 'commentEdit':
                if (isset($_COOKIE['id']))
                {
                    if ($backendController->secure($_COOKIE['id']))
                    {
                        $backendController->commentEditView($_GET['id']);
                    }
                }
                else
                {
                    $frontendController->home();
                }
                break;
    
            case 'verifCommentEdit':
                if (isset($_COOKIE['id']))
                {
                    if ($backendController->secure($_COOKIE['id']))
                    {
                        $backendController->commentEdit($_POST['author'], $_POST['comment'], $_GET['id']);
                    }
                }
                else
                {
                    $frontendController->home();
                }
                break;
    
            case 'addChapter':
                if (isset($_COOKIE['id']))
                {
                    if ($backendController->secure($_COOKIE['id']))
                    {
                        $backendController->addChapterView();
                    }
                }
                else
                {
                    $frontendController->home();
                }
                break;
    
            case 'verifAddChapter':
                if (isset($_COOKIE['id']))
                {
                    if ($backendController->secure($_COOKIE['id']))
                    {
                        $backendController->addChapter($_POST['title'], $_POST['content'], $_POST['author']);
                    }
                }
                else
                {
                    $frontendController->home();
                }
                break;
            
            case 'deleteChapter':
                if (isset($_COOKIE['id']))
                {
                    if ($backendController->secure($_COOKIE['id']))
                    {
                        $backendController->deleteChapter($_GET['id']);
                    }
                }
                else
                {
                    $frontendController->home();
                }
                break;
    
            case 'deleteComment':
                if (isset($_COOKIE['id']))
                {
                    if ($backendController->secure($_COOKIE['id']))
                    {
                        $backendController->deleteComment($_GET['id']);
                    }
                }
                else
                {
                    $frontendController->home();
                }
                break;

                case 'addUserAdmin':
                if (isset($_COOKIE['id']))
                {
                    if ($backendController->secure($_COOKIE['id']))
                    {
                        $backendController->addUserAdminView();
                    }
                    else
                    {
                        $frontendController->home();
                    }
                }
                break;
                
            case 'verifUserAdminForm':
                if (isset($_COOKIE['id']))
                {
                    if ($backendController->secure($_COOKIE['id']))
                    {
                        $backendController->formAddUserAdmin($_POST['id'], $_POST['pass'], $_POST['pass-confirm'], $_POST['email']);
                    }
                }
                else
                {
                    $frontendController->home();
                }
                break;
            
            default:
                $frontendController->home();
                break;        
        }
    }
    else
    {
        $frontendController->home();
    }
}
catch(Exception $e) 
{
    echo 'Erreur : ' . $e->getMessage();
}