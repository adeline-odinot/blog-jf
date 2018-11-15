<?php $title = 'Billet simple pour l\'Alaska | Accueil'; ?>
 <?php ob_start(); ?>
 <?php
?>  
    <div class="text-center showing">
        <h2 class="title-content">Bienvenue sur mon blog</h2>
        <p>Bienvenue, je publierais régulièrement chacun des chapitres de mon nouveau roman "Billet simple pour l'Alaska". <br />
        N'hésitez-pas à commenter en partagant vos avis et ressentie. <br />
        Je vous souhaites une bonne lecture et une bonne découverte de chacune des aventures de mon merveilleux roman. <br />
        </p>
        <em class="author-sign">Jean FORTEROCHE</em>
    </div>
    <h2 class="text-center title-content">Mon dernier chapitre</h2>
     <?php
    foreach($newChapters as $chapter)
    {
    ?>
    <div class="row showing">
        <div class="col-md-12 d-flex flex-column align-items-center">
            <div class="text-center">
                <h3 class="title-chapter">
                        <a href="index.php?action=chapter&amp;id=<?= $chapter['id'] ?>">
                        <?= htmlspecialchars($chapter['title']) ?>
                    </a>
                </h3>
            
                <p>
                    <?= nl2br(htmlspecialchars($chapter['content'])) ?>
                    <br />
                    <em><a href="index.php?action=chapter&amp;id=<?= htmlspecialchars($chapter['id']) ?>">Lire la suite</a></em>
                </p>
            </div>
                <blockquote>
                    <p>Publié le <?= htmlspecialchars($chapter['creation_date_fr']) ?> par <?= htmlspecialchars($chapter['author']) ?></p>
                </blockquote>
        </div>
    </div>
    <?php
    }
    ?>
 <?php $content = ob_get_clean(); ?>
 <?php require('template.php'); ?> 