<?php $title = 'À propos'; ?>

<?php ob_start(); ?>

    <h2 class="text-center title-content">À propos</h2>
    <div>
        <div class="row">
            <div class="col-md-4">
                <img class="img-jean" src="public/images/jean.jpg" alt="Jean Forteroche écrivain">
            </div>

            <div class="col-md-8 d-flex align-items-center text-justify">
                <p>
                   <span class="title-txt-about">Qui-suis-je?</span><br /><br />

                   Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                   Cras aliquet nulla sit amet sodales viverra. Interdum et malesuada fames ac ante ipsum primis in faucibus. 
                   Aenean aliquam velit dignissim laoreet accumsan. Phasellus iaculis elit lacus, sit amet malesuada ligula pretium eu. 
                   Pellentesque nibh odio, fermentum in lorem sed, lacinia volutpat est. Aliquam at sapien nibh. Sed facilisis ac odio sed eleifend. 
                   Maecenas convallis imperdiet tellus sed molestie.
                   Quisque nec magna quam. Aenean eros ante, facilisis sed commodo eget, consectetur quis sem. 
                   Pellentesque venenatis pellentesque quam, varius pharetra orci. Mauris eu justo mi. 
                   Fusce facilisis auctor augue, eu finibus quam gravida a. Aliquam erat volutpat. 
                   Integer accumsan aliquam fermentum. Vivamus auctor leo vitae scelerisque ornare. 
                   In congue vestibulum semper. 
                   Donec luctus eros nunc, et dignissim quam tempus sit amet.
                </p>
            </div>
        </div>
    </div>

<?php $content = ob_get_clean(); ?>

<?php require('view/template/template.php'); ?>
