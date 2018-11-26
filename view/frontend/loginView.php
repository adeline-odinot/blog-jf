<?php $title = 'Connexion'; ?>

<?php ob_start(); ?>


<h2 class="text-center title-content">Connectez-vous</h2>

<form id="login-form" action="" method="post" class="d-flex flex-column align-items-center form-comment col-md-5 ml-auto mr-auto">
    <div class="form-group design-form">
        <p id="messageError" class="error-message"></p>
        <div>
            <label class="label-design" for="id">Identifiant : <span class="star-color">*</span></label><br />
            <input type="text" class="form-control" id="id" name="id" placeholder="Entrez votre identifiant"/><br />
            <p id="idError" class="error-message"></p>
        </div>
        <div>
            <label class="label-design" for="pass">Mot de passe : <span class="star-color">*</span></label><br />
            <input type="password" class="form-control" id="mdp" name="pass" placeholder="Entrez votre mot de passe"/><br />
            <p id="passwordError" class="error-message"></p>
        </div>
        <div>
            <label class="label-design" for="remember">Se souvenir de moi : </label>
            <input type="checkbox" id="remember" name="remember"/>
        </div>
        <br />
        <div class="d-flex flex-column">
            <input class="button-design boutton-connection" type="submit" value="Se connecter"/>
        </div>
    <div>
</form>

<?php $content = ob_get_clean(); ?>

<?php require('view/template/template.php'); ?>
