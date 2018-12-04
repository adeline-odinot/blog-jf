<?php
require('controllers/frontend/frontend.php');
require('controllers/backend/backend.php');

$frontendController = new FrontendController();
$backendController = new BackendController();

try {
    
    $action = $_GET['action'];

    switch ($action) 
    {
        case 'listChapters':

            $frontendController->listChapters();
            break;

        case 'chapter':

            if (isset($_GET['id']) && $_GET['id'] > 0) 
            {
                $frontendController->chapter($_GET['id'], $_GET['id']);
            }
            else 
            {
                throw new Exception('Aucun identifiant de chapitre envoyé');
            }
            break;
            
        case 'verifAddComment':
            $frontendController->addComment($_GET['id'], $_POST['author'], $_POST['comment']);
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
            $frontendController->formContact($_POST['name'], $_POST['email'], $_POST['phone'], $_POST['message']);
            break;

        case 'login':
            $frontendController->login();
            break;
        
        case 'verifLogin':
            $frontendController->formLogin($_POST['id'], $_POST['pass']);
            break;

        case 'legalNotice':
            $frontendController->legalNotice();
            break;

        case 'report':
            $frontendController->commentReport($_GET['id_comment']);
            break;

        // BACKEND

        case 'admin':
            $backendController->admin();
            break;
    
        case 'addChapter':
            $backendController->addChapterView();
            break;
            
        case 'verifAddChapter':
            $backendController->addChapter($_POST['title'], $_POST['content'], $_POST['author']);
            break;
            
        case 'chapterEdit':
            $backendController->chapterEditView($_GET['id']);
            break;

        case 'verifChapterEdit':
            $backendController->chapterEdit($_POST['title'], $_POST['content'], $_POST['author'], $_GET['id']);
            break;

        case 'commentEdit':
            $backendController->commentEditView($_GET['id']);
            break;

        case 'verifCommentEdit':
            $backendController->commentEdit($_POST['author'], $_POST['comment'], $_GET['id']);
            break;

        default:
            $frontendController->home();        
    }
}
catch(Exception $e) 
{
    echo 'Erreur : ' . $e->getMessage();
}