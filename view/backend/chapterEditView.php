<?php $title = 'Modifier un chapitre'; ?>

<?php ob_start(); ?>

<h2 class="text-center title-content">Modifier un chapitre</h2>

<form action="" method="POST" id="edit-chapter-form" class="d-flex flex-column align-items-center col-xs-12 col-md-10 ml-auto mr-auto">
    <div class="form-group design-form">
        <div>
            <label class="label-design" for="title">Nouveau titre : </label><br />
            <input type="text" class="form-control" id="title" name="title" placeholder="Entrez le nouveau titre" value="<?= $chapters->getTitle() ?>"><br />
            <p id="titleError" class="error-message"></p>
        </div>
        <div>
            <label class="label-design" for="author">Nouvel auteur : </label><br />
            <input type="text" class="form-control" id="author" name="author" placeholder="Entrez le nouvel auteur" value="<?= $chapters->getAuthor() ?>"><br />
            <p id="authorError" class="error-message"></p>
        </div>
        <div>
            <label class="label-design" for="content">Nouveau texte : </label><br />
            <textarea class="form-control" name="content" rows="4" id="content"><?= $chapters->getContent() ?></textarea>
            <p id="contentError" class="error-message"></p>
        </div>
        <div>
            <input class="button-design" onclick="editChapter(<?= $chapters->getId() ?>)" type="submit" value="Envoyer"/>
        </div>
    </div>
</form>

<?php $content = ob_get_clean(); ?>

<?php require('view/template/template.php'); ?>