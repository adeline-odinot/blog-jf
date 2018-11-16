<?php $title = 'Billet simple pour l\'Alaska | Chapitres'; ?>

<?php ob_start(); ?>

<h2 class="title-content text-center">Chapitres</h2>

<?php
foreach ($newChapters as $chapter)
{
?>
    <div class="row showing text-center">
        <div class="col-md-12 d-flex flex-column align-items-center">
            <h3 class="title-chapter"><a href="index.php?action=chapter&amp;id=<?= $chapter['id'] ?>">
                    <?= htmlspecialchars($chapter['title']) ?>
                </a>
            </h3>
        
            <p>
                <?= nl2br(htmlspecialchars($chapter['content'])) ?>
                <br />
                <em><a href="index.php?action=chapter&amp;id=<?= htmlspecialchars($chapter['id']) ?>">Lire la suite</a></em>
                <blockquote>
                    <p>Publié le <?= htmlspecialchars($chapter['creation_date_fr']) ?> par <?= htmlspecialchars($chapter['author']) ?></p>
                </blockquote>
            </p>
            <div class="border-bottom border-secondary"></div>
        </div>
    </div>
<?php
}
$chapters->closeCursor();
?>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>