<!DOCTYPE html>
<html>
    <head>

        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Billet simple pour l'Alaska | <?= $title ?></title>
        <link rel="shortcut icon" type="image/x-icon" href="public/images/jf.png">

        <!-- Bootstrap CSS -->

        <link rel="stylesheet" 
              href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

        <!-- Google Font -->

        <link href="https://fonts.googleapis.com/css?family=Kodchasan:300|Spicy+Rice" rel="stylesheet">

        <!-- Icones Fontawesome -->

        <link rel="stylesheet" 
              href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" 
              integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" 
              crossorigin="anonymous">

        <!-- Style CSS -->

        <link href="public/css/style.css" rel="stylesheet" />

        <!-- Meta description -->

        <meta name="description" content="<?= $description ?>" />

        <!-- Open Graph -->

        <meta property="og:locale" content="fr_FR">
        <meta property="og:type" content="website">
        <meta property="og:title" content="Billet simple pour l'Alaska | <?= $title ?>">
        <meta property="og:description" content="<?= $description ?>" />
        <meta property="og:url" content="https://www.adeline-odinot.com/projets/billet-simple-alaska/">
        <meta property="og:site_name" content="Billet simple pour l'Alaska">
        <meta property="og:image" content="https://www.adeline-odinot.com/projets/billet-simple-alaska/public/images/jf-navbar.png">

        <!-- Twitter Card -->

        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:image:src" content="https://www.adeline-odinot.com/projets/billet-simple-alaska/public/images/jf-navbar.png">
        <meta name="twitter:description" content="<?= $description ?>" />
        <meta name="twitter:title" content="Billet simple pour l'Alaska | <?= $title ?>">


        <!-- Tinymce -->

        <script src="./public/tinymce/js/tinymce/tinymce.min.js"></script>

        <script>        
            tinymce.init({
                mode : "specific_textareas",
                editor_selector : "tinymce",
                plugins: "media textcolor colorpicker preview emoticons fullscreen image link lists",
                menubar: "insert edit format view",
                toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | numlist bullist outdent indent |  link unlink | emoticons |  image media | preview fullscreen",
                toolbar2: " forecolor backcolor | formatselect fontselect fontsizeselect",
                language : "fr_FR",
                
            });
        </script>

    </head>
    <body class="container-fluid">
        <header class="row header d-flex justify-content-center">

        <!-- Menu -->

        <nav class="nav-header navbar navbar-expand-lg navbar-light fixed-top">
            <div class="container">
            
                <a href="index.php?action=home" class="navbar-brand mx-auto"><img src="public/images/jf-navbar.png"></a>
                <button class="navbar-toggle navbar-toggler navbar-dark" type="button" data-toggle="collapse" data-target="#navbar-blog" aria-controls="navbar-blog" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbar-blog">
                    <ul class="nav navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link nav-design" href="index.php?action=home"><i class="fas fa-home"></i> Accueil <span class="sr-only">Accueil</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-design" href="index.php?action=about"><i class="fas fa-question-circle"></i> À propos <span class="sr-only">À propos</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-design" href="index.php?action=listChapters"><i class="fas fa-book-reader"></i> Chapitres</a><span class="sr-only">Chapitres</span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-design" href="index.php?action=contact"><i class="fas fa-envelope"></i> Contact</a><span class="sr-only">Contact</span>
                        </li>
                        <?php 
                            if (isset($_COOKIE['id']))
                            {
                        ?>
                                <li class="nav-item">
                                    <a class="nav-link nav-design" href="index.php?action=admin"><i class="fas fa-cog"></i> Administration</a><span class="sr-only">Administration</span>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link nav-design" href="index.php?action=disconnect"><i class="fas fa-user"></i> Se deconnecter</a><span class="sr-only">Se deconnecter</span>
                                </li>
                        <?php
                            }
                            else
                            {
                        ?>
                            <li class="nav-item">
                                <a class="nav-link nav-design" href="index.php?action=login"><i class="fas fa-user"></i> Se connecter</a><span class="sr-only">Se connecter</span>
                            </li>
                        <?php
                            }
                        ?>
                    </ul>		
                </div>			
            </div>
        </nav>

        <!-- En-tête -->

            <div class="text-center title row">
                <div class="col-md-12">
                    <h1>BILLET SIMPLE POUR L'ALASKA</h1>
                    <p>Jean FORTEROCHE</p>
                </div>
            </div>
        </header>

        <!-- Contenu de la page -->
        
        <section class="content">
            <?= $content ?>
        </section>

        <!-- Bas de page -->

        <footer class="footer">
            <div class="row footer-informations">
                <div class="col-md-4 text-center">
                    <h4 class="underline design-footer">Mentions légales</h4>
                    <p><a href="index.php?action=legalNotice">Aller sur la page des mentions légales du site</a></p>
                </div>
                <div class="col-md-4 text-center">
                    <?php 
                        if (isset($_COOKIE['id']))
                            {
                    ?>
                            <h4 class="underline design-footer">Deconnexion</h4>
                            <p><a href="index.php?action=disconnect">Se deconnecter</a></p>
                    <?php
                            }
                            else
                            {
                    ?>
                            <h4 class="underline design-footer">Connexion</h4>
                            <p><a href="index.php?action=login">Se connecter</a></p>
                    <?php
                            }
                    ?>

                    
                </div>
                <div class="col-md-4 text-center">
                    <h4 class="underline design-footer">Contactez-moi</h4>
                    <p><a href="index.php?action=contact">jeanforteroche.alaska@gmail.com</a></p>
                </div>
            </div>

            <!-- Copyright -->

            <div class="row">
                <p class="col-md-12 text-center copyright"><span class="design-footer">©</span> 2018 Adeline Odinot <span class="design-footer">|</span> Site réalisé dans le cadre d'une formation <span class="underline"><a href="https://openclassrooms.com/">Openclassooms</a></span></p>
            </div>
        </footer>

        <!-- Jquery CDN -->

        <script
            src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous">
        </script>

        <!-- Popper CDN -->

        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" 
                integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" 
                crossorigin="anonymous">
        </script>

        <!-- Bootstrap JS CDN -->

        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" 
                integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" 
                crossorigin="anonymous">
        </script>

        <!-- Librairie Jquery Cookie -->
        
        <script src="./public/js/frontend/jquery.cookie.js"></script>

        <!-- Fichiers JavaScript personnalisés -->

        <script src="./public/js/frontend/cookieBar.js"></script>
        <script src="./public/js/frontend/addCommentForm.js" async></script>
        <script src="./public/js/frontend/contactForm.js" async></script>
        <script src="./public/js/frontend/loginForm.js" async></script>
        <script src="./public/js/frontend/report.js" async></script>
        
        <script src="./public/js/backend/addChapterForm.js" async></script>
        <script src="./public/js/backend/editChapterForm.js" async></script>
        <script src="./public/js/backend/editCommentForm.js" async></script>
        <script src="./public/js/backend/deleteChapter.js" async></script>
        <script src="./public/js/backend/deleteComment.js" async></script>
        <script src="./public/js/backend/addUserAdminForm.js" async></script>

    </body>
</html>