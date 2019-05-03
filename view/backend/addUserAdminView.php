<?php $title = 'Ajout d\'un administrateur'; ?>

<?php ob_start(); ?>

<h2 class="text-center title-content">Ajouter un administrateur</h2>

<form id="user-admin-form" action="" method="post" class="d-flex flex-column align-items-center form-comment col-md-5 ml-auto mr-auto">
    <div class="form-group design-form">
        <div>
            <label class="label-design" for="id">Identifiant : </label><br />
            <input type="text" class="form-control" id="id" name="id" placeholder="Choisissez l'identifiant"/><br />
            <p id="idError" class="error-message"></p>
        </div>
        <div>
            <label class="label-design" for="pass">Mot de passe : </label><br />
            <input type="password" class="form-control" id="pass" name="pass" placeholder="Choisissez le mot de passe"/><br />
            <p id="passError" class="error-message"></p>
        </div>
        <div>
            <label class="label-design" for="pass-confirm">Confirmation du mot de passe : </label><br />
            <input type="password" class="form-control" id="pass-confirm" name="pass-confirm" placeholder="Confirmer le mot de passe"/><br />
            <p id="passConfirmError" class="error-message"></p>
        </div>
        <div>
            <label class="label-design" for="email">Adresse e-mail : </label><br />
            <input type="email" class="form-control" id="email" name="email" placeholder="Entrez l'adresse e-mail"/><br />
            <p id="emailError" class="error-message"></p>
        </div>
        <input class="btn button-design boutton-connection" type="submit" value="Inscription"/>
    <div>
</form>

<p class="thank-you text-center"></p>

<?php $content = ob_get_clean(); ?>

<?php require('view/template/template.php'); ?>