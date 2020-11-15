<?php
use View\Partial;
?>
<?= "page test" ?>
    <?= Partial::build('forms/success', ["user" => $user]); ?>