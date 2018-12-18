<?php $title = htmlspecialchars_decode($chapter->getTitle()); ?>

<?php ob_start(); ?>

<div class="row">
    <div class="col-md-12 d-flex flex-column align-items-center text-center">
        <h2 class="title-chapter-view">
            <?= htmlspecialchars_decode($chapter->getTitle()) ?>
        </h2>
        <p>
            <?= nl2br($chapter->getContent()) ?>
            <br />
            <blockquote>
                <p>Publié le <?= htmlspecialchars_decode($chapter->getCreation_date_fr()) ?> par <?= htmlspecialchars_decode($chapter->getAuthor()) ?></p>
            </blockquote>
        </p>
    </div>
</div>

<h2 class="text-center title-comment underline">Laisser un commentaire : </h2>

<form action="index.php?action=addComment&amp;id=<?= $chapter->getId() ?>" method="post" class="d-flex flex-column align-items-center form-comment add-comment">
    <div class="form-group">
        <div>
            <label class="label-design" for="author">Nom : <span class="star-color">*</span></label><br />
            <input type="text" class="form-control" id="author" name="author" placeholder="Votre nom" value="<?php if(isset($_COOKIE['author'])) { echo htmlspecialchars_decode($_COOKIE['author']); }?>"/><br />
            <p id="authorError" class="error-message"></p>
        </div>
       <div>
            <label class="label-design" for="comment">Commentaire : <span class="star-color">*</span></label><br />
            <textarea id="comment" class="form-control" name="comment" placeholder="Votre commentaire" rows="4"></textarea><br />
            <p id="commentError" class="error-message"></p>
       </div>
        <input class="button-design" type="submit" value="Commenter" onclick="addCommentForm(<?= $chapter->getId() ?>)"/>
    </div>
    <div class="border-bottom border-secondary"></div>
    <br />
</form>

<h2 class="text-center title-comment underline">Commentaires : </h2>

<?php
foreach ($comments as $comment)
{
?>  <div class="row">
        <div class="col-md-8 ml-auto mr-auto text-center comment">
            <p class="author-comment"><strong><?= htmlspecialchars_decode($comment->getAuthor()) ?></strong></p>
            <p class="font-size-comment label-design"><em>Le <?= $comment->getComment_date() ?></em></p>
            <p><?= nl2br(htmlspecialchars_decode($comment->getComment())) ?></p>
            <span class="button-design" id="report-<?= $comment->getId() ?>" onclick="report(<?= $comment->getId() ?>)"><em>Signaler le commentaire</em></span>
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
                        <a class="page-link" href="index.php?action=chapter&amp;id=<?= htmlspecialchars($chapter->getId()) ?>&amp;page=<?= $i ?>"><?= $i ?></a>
                    </li> 
            <?php    
                }
            }
            ?>
    </ul>
</nav>

<?php $content = ob_get_clean(); ?>

<?php require('view/template/template.php'); ?>
