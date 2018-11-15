<?php
require('controllers/frontend.php');
 $frontendController = new FrontendController;
 try {
    if (isset($_GET['action'])) 
    {
        if ($_GET['action'] == 'chapter') 
        {
            if (isset($_GET['id']) && $_GET['id'] > 0) 
            {
                $frontendController->chapter();
            }
            else 
            {
                throw new Exception('Aucun identifiant de chapitre envoyé');
            }
        }
        elseif ($_GET['action'] == 'addComment') 
        {
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
        }
        elseif ($_GET['action'] == 'home') 
        {
            $frontendController->home();
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