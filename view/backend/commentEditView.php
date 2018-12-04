<?php $title = 'Modifier un commentaire'; ?>

<?php ob_start(); ?>

<h2 class="text-center title-content">Modifier un commentaire</h2>

<form action="" method="POST" id="edit-comment-form" class="d-flex flex-column align-items-center col-xs-12 col-md-10 ml-auto mr-auto">
    <div class="form-group design-form">
        <div>
            <label class="label-design" for="author">Nouvel auteur : </label><br />
            <input type="text" class="form-control" id="author" name="author" placeholder="Entrez le nouvel auteur" value="<?= $comment->getAuthor() ?>"><br />
            <p id="authorError" class="error-message"></p>
        </div>
        <div>
            <label class="label-design" for="comment">Nouveau commentaire : </label><br />
            <textarea id="comment" class="form-control" name="comment" rows="4"><?= $comment->getComment() ?></textarea>
            <p id="commentError" class="error-message"></p>
        </div>
        <div>
            <input class="button-design" onclick="editComment(<?= $comment->getId() ?>)" type="submit" value="Envoyer"/>
        </div>
    </div>
</form>

<?php $content = ob_get_clean(); ?>

<?php require('view/template/template.php'); ?>