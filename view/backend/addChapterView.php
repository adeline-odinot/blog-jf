<?php $title = 'Ajouter un chapitre'; ?>

<?php ob_start(); ?>

<h2 class="text-center title-content">Ajouter un chapitre</h2>

<form action="" method="POST" class="d-flex flex-column align-items-center col-xs-12 col-md-10 ml-auto mr-auto" id="add-chapter-form">
    <div class="form-group design-form">
        <div>
            <label class="label-design" for="title">Titre : </label><br />
            <input type="text" class="form-control" id="title" name="title" placeholder="Entrez le titre du chapitre"><br />
            <p id="titleError" class="error-message"></p>
        </div>
        <div>
            <label class="label-design" for="author">Auteur : </label><br />
            <input type="text" class="form-control" id="author" name="author" placeholder="Entrez l'auteur du chapitre"><br />
            <p id="authorError" class="error-message"></p>
        </div>
        <div>
            <label class="label-design" for="content">Contenu du chapitre: </label><br />
            <textarea class="form-control tinymce" name="content" rows="4" id="content"></textarea>
            <p id="contentError" class="error-message"></p>
        </div>
        <div>
            <input class="btn button-design" type="submit" value="Envoyer"/>
        </div>
    </div>
</form>

<?php $content = ob_get_clean(); ?>

<?php require('view/template/template.php'); ?>