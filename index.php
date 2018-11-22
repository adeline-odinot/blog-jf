<?php
require('controllers/frontend.php');

$frontendController = new FrontendController();

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
            
        case 'addComment':

            if (isset($_GET['id']) && $_GET['id'] > 0) 
            {
                if (!empty($_POST['author']) && !empty($_POST['comment'])) 
                {
                    $frontendController->addComment($_GET['id'], $_POST['author'], $_POST['comment']);
                }
                else 
                {
                    throw new Exception('Tous les champs ne sont pas remplis !');
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
            
        default:
            $frontendController->home();        
    }
}
catch(Exception $e) 
{
    echo 'Erreur : ' . $e->getMessage();
}