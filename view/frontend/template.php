<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= $title ?></title>
        <link rel="shortcut icon" type="image/x-icon" href="public/images/jf.png">
        <link href="public/css/style.css" rel="stylesheet" /> 
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    </head>
    <body class="container-fluid">
        <header class="row header d-flex justify-content-center">
         <nav class="nav-header navbar navbar-expand-lg navbar-light fixed-top">
            <div class="container">
            
                <a href="index.php?action=home" class="navbar-brand mx-auto"><img src="public/images/jf-navbar.png"></a>
                <button class="navbar-toggle navbar-toggler navbar-dark" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                 <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="nav navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link nav-design" href="index.php?action=home">Accueil <span class="sr-only">Accueil</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-design" href="index.php?action=about">À propos <span class="sr-only">À propos</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-design" href="index.php?action=listChapters">Chapitres</a><span class="sr-only">Chapitres</span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-design" href="index.php?action=contact">Contact</a><span class="sr-only">Contact</span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-design" href="index.php?action=login">Se connecter</a><span class="sr-only">Se connecter</span>
                        </li>
                    </ul>		
                </div>			
            </div>
        </nav>
            <div class="text-center title row">
                <div class="col-md-12">
                    <h1>BILLET SIMPLE POUR L'ALASKA</h1>
                    <p>Jean FORTEROCHE</p>
                </div>
            </div>
        </header>
        
        <section class="content">
            <?= $content ?>
        </section>
         <footer class="footer">
            <div class="row footer-informations">
                <div class="col-md-4 text-center">
                    <h4 class="underline">Mentions légales</h4>
                    <p><a href="index.php?action=legalNotice">Aller sur la page des mentions légales du site</a></p>
                </div>
                <div class="col-md-4 text-center">
                    <h4 class="underline">Connexion</h4>
                    <p><a href="index.php?action=login">Connectez-vous</a></p>
                </div>
                <div class="col-md-4 text-center">
                    <h4 class="underline">Contactez-moi</h4>
                    <p><a href="index.php?action=contact">jeanforteroche.alaska@gmail.com</a></p>
                </div>
            </div>
            <div class="row">
                <p class="col-md-12 text-center copyright">© 2018 Adeline Odinot | Site réalisé dans le cadre d'une formation Openclassooms</p>
            </div>
        </footer>
        <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <script src="./public/js/contactForm.js" async></script>
        <script src="./public/js/loginForm.js" async></script>
        <script src="./public/js/report.js" async></script>
    </body>
</html> 