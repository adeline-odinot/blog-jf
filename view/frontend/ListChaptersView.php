<?php $title = 'Chapitres'; ?>

<?php ob_start(); ?>

<h2 class="title-content text-center">Chapitres</h2>

<?php
foreach ($chapters as $chapter)
{
?>
    <div class="row showing text-center">
        <div class="col-md-12 d-flex flex-column align-items-center">
            <h3 class="title-chapter">
                <a href="index.php?action=chapter&amp;id=<?= $chapter->getId() ?>">
                    <?= htmlspecialchars_decode($chapter->getTitle()) ?>
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
                <em>
                    <a href="index.php?action=chapter&amp;id=<?= htmlspecialchars_decode($chapter->getId()) ?>">Lire la suite</a>
                </em>
                <blockquote>
                    <p>Publié le <?= htmlspecialchars_decode($chapter->getCreation_date_fr()) ?> par <?= htmlspecialchars_decode($chapter->getAuthor()) ?></p>
                </blockquote>
            </p>
            <div class="border-bottom border-secondary"></div>
        </div>
    </div>
<?php
}
?>

<nav aria-label="Pagination des chapitres">
    <ul class="pagination">
        <?php
            for($i = 1; $i <= $nb_page; $i++) 
            {
                if ($i == $cPage) 
                {
                ?>

                    <li class="page-item active">
                        <div class="page-link"><?= $i ?><span class="sr-only">(current)</span></div>
                    </li>
                <?php
                }
                else 
                {
        ?>
                    <li class="page-item">
                        <a class="page-link" href="index.php?action=listChapters&amp;page=<?= $i ?>"><?= $i ?></a>
                    </li> 
            <?php    
                }
            }
            ?>
    </ul>
</nav>  
<?php $content = ob_get_clean(); ?>

<?php require('view/template/template.php'); ?>