<?php

use Taxonomy\Taxonomy\AspectTaxonomy;
use Taxonomy\Death\DeathTaxonomy;
use Taxonomy\Fault\FaultTaxonomy;
use View\Partial;

?>

<?= Partial::build('layout/header'); ?>

    <!--THE REGISTRATION MODAL WINDOW-->
<?= Partial::build('modal/register'); ?>

    <!--THE LOGIN MODAL WINDOW-->
<?= Partial::build('modal/login'); ?>

    <!--THE HOMEPAGE WINDOW-->
<?= Partial::build('nav') ?>


<?= Partial::build("hero", [
    "heroText" => "Are you going to die? Have you kicked your mother's bucket? Are your friends on the way out?"
]); ?>

<?= Partial::build('taxonomyTile', ["taxonomies" => $taxonomies, "large" => FALSE]); ?>

<section>
    <div class="layout layout--distant g-flex">
        <?= Partial::build('omenGrid', ["omenCollection" => $omens, "columns" => 4]); ?>
    </div>
</section>

<?= Partial::build('footer'); ?>

