<?php $title = 'Accueil'; ?>

<?php ob_start(); ?>

<?php
?>  
    <div class="text-center showing">
        <h2 class="title-content">Bienvenue sur mon blog</h2>
        <p>
            Bienvenue, je publierais régulièrement chacun des chapitres de mon nouveau roman "Billet simple pour l'Alaska". <br />
            N'hésitez-pas à commenter en partagant vos avis et ressentie. <br />
            Je vous souhaites une bonne lecture et une bonne découverte de chacune des aventures de mon merveilleux roman. <br />
        </p>
        <em class="author-sign">Jean FORTEROCHE</em>
    </div>
    <h2 class="text-center title-content">Mon dernier chapitre</h2>

    <div class="row showing">
        <div class="col-md-12 d-flex flex-column align-items-center">
            <div class="text-center">
                <h3 class="title-chapter">
                    <a href="index.php?action=chapter&amp;id=<?= $lastChapter->getId() ?>">
                        <?= htmlspecialchars_decode($lastChapter->getTitle()) ?>
                    </a>
                </h3>
            
                <p>
                    <?php
                        if (strlen($lastChapter->getContent()) <= 400)
                        {
                            $content = $lastChapter->getContent();
                        }
                        
                        else
                        {
                            $start = substr($lastChapter->getContent(), 0, 400);
                            $start = substr($start, 0, strrpos($start, ' ')) . ' [...]';
                            
                            $content = $start;
                        }
                        echo $content;
                    ?>
                    <br />
                    <em>
                        <a href="index.php?action=chapter&amp;id=<?= htmlspecialchars_decode($lastChapter->getId()) ?>">Lire la suite</a>
                    </em>
                </p>
            </div>
            <blockquote>
                <p>Publié le <?= htmlspecialchars_decode($lastChapter->getCreation_date_fr()) ?> par <?= htmlspecialchars_decode($lastChapter->getAuthor()) ?></p>
            </blockquote>
        </div>
    </div>

<?php $content = ob_get_clean(); ?>

<?php require('view/template/template.php'); ?>