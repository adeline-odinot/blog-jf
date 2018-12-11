<?php $title = 'Administration'; ?>

<?php ob_start(); ?>

    <h2 class="text-center title-content">Administration</h2>

    <?php require('chaptersView.php'); ?>

    <?php require('reportView.php'); ?>

    <?php require('userAdminView.php'); ?>

<?php $content = ob_get_clean(); ?>

<?php require('view/template/template.php'); ?>