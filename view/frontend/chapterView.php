<?php $title = htmlspecialchars('Billet simple pour l\'Alaska | ' . $chapter['title']); ?>
 <?php ob_start(); ?>
 <div class="row">
    <div class="col-md-12 d-flex flex-column align-items-center text-center">
        <h2 class="title-chapter">
            <?= htmlspecialchars($chapter['title']) ?>
        </h2>
        <p>
            <?= nl2br(htmlspecialchars($chapter['content'])) ?>
            <br />
            <blockquote>
                <p>Publié le <?= htmlspecialchars($chapter['creation_date_fr']) ?> par <?= htmlspecialchars($chapter['author']) ?></p>
            </blockquote>
        </p>
    </div>
</div>
 <h2 class="text-center title-comment underline">Laisser un commentaire : </h2>
 <form action="index.php?action=addComment&amp;id=<?= $chapter['id'] ?>" method="post" class="d-flex flex-column align-items-center form-comment">
    <div class="form-group">
        <label class="label-design" for="author">Nom : </label><br />
        <input type="text" class="form-control" id="author" name="author" placeholder="Votre nom"/>
        <label class="label-design" for="comment">Commentaire : </label><br />
        <textarea id="comment" class="form-control" name="comment" placeholder="Votre commentaire" rows="4"></textarea>
        <input class="button-design" type="submit" value="Commenter"/>
        <div class="border-bottom border-secondary"></div>
    <div>
</form>
 <?php
while ($comment = $comments->fetch())
{
?>  <div class="row">
        <div class="col-md-12 d-flex flex-column align-items-center comment">
            <p class="author-comment"><strong><?= htmlspecialchars($comment['author']) ?></strong></p>
            <p class="font-size-comment label-design"><em>Le <?= $comment['comment_date_fr'] ?></em></p>
            <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
            <p class="button-design"><em>Signaler le commentaire</em></p>
        </div>
        <div class="border-bottom border-secondary"></div>
    </div>
     
<?php
}
?>
<?php $content = ob_get_clean(); ?>
 <?php require('template.php'); ?>