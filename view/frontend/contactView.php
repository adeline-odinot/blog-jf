<?php $title = 'Contact' ?>

<?php ob_start(); ?>

<h2 class="text-center title-content">Contactez-moi</h2>

<form id="contact-form" action="" method="POST" class="d-flex flex-column align-items-center form-comment col-xs-12 col-md-7 ml-auto mr-auto">
    <div class="form-group design-form">
        <div>
            <label class="label-design" for="name">Nom : <span class="star-color">*</span></label><br />
            <input type="text" class="form-control" id="name" name="name" placeholder="Entrez votre nom" id="name"/><br />
            <p id="nameError" class="error-message"></p>
        </div>
        <div>
            <label class="label-design" for="email">Adresse e-mail : <span class="star-color">*</span></label><br />
            <input type="text" class="form-control" id="email" name="email" placeholder="Entrez votre adresse e-mail" id="email"/><br />
            <p id="emailError" class="error-message"></p>
        </div>
        <div>
            <label class="label-design" for="phone">Téléphone : <span class="star-color">*</span></label><br />
            <input type="text" class="form-control" id="phone" name="phone" placeholder="Entrez votre numéro de téléphone" id="phone"/><br />
            <p id="phoneError" class="error-message"></p>
        </div>
        <div>
            <label class="label-design" for="message">Message : <span class="star-color">*</span></label><br />
            <textarea id="message" class="form-control" name="message" rows="4" placeholder="Entrez votre message" id="message"></textarea>
            <p id="messageError" class="error-message"></p>
        </div>
        <div>
            <input class="button-design" type="submit" value="Envoyer"/>
        </div>
    </div>
</form>

<p class="thank-you text-center"></p>

<?php $content = ob_get_clean(); ?>

<?php require('view/template/template.php'); ?>
