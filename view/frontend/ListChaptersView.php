<?php $title = 'Chapitres'; ?>

<?php ob_start(); ?>

<h2 class="title-content text-center">Chapitres</h2>

<?php
foreach ($chapters as $chapter)
{
?>
    <div class="row showing text-center">
        <div class="col-md-12 d-flex flex-column align-items-center">
            <h3 class="title-chapter"><a href="index.php?action=chapter&amp;id=<?= $chapter->getId() ?>">
                    <?= htmlspecialchars($chapter->getTitle()) ?>
                </a>
            </h3>
        
            <p>
                <?php 
                    if (strlen($chapter->getContent()) <= 400)
                    {
                      $content = $chapter->getContent();
                    }
                    
                    else
                    {
                      $start = substr($chapter->getContent(), 0, 400);
                      $start = substr($start, 0, strrpos($start, ' ')) . ' [...]';
                      
                      $content = $start;
                    }
                    echo $content;
                ?>
                <br />
                <em><a href="index.php?action=chapter&amp;id=<?= htmlspecialchars($chapter->getId()) ?>">Lire la suite</a></em>
                <blockquote>
                    <p>Publié le <?= htmlspecialchars($chapter->getCreation_date_fr()) ?> par <?= htmlspecialchars($chapter->getAuthor()) ?></p>
                </blockquote>
            </p>
            <div class="border-bottom border-secondary"></div>
        </div>
    </div>
<?php
}
?>
<?php $content = ob_get_clean(); ?>

<?php require('view/template/template.php'); ?>