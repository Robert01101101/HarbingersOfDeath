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

<!--THE ACCOUNT MODAL WINDOW-->
<?= Partial::build('modal/account'); ?>

    <!--THE HOMEPAGE WINDOW-->
<?= Partial::build('nav', ["search" => TRUE]); ?>


<?= Partial::build("hero", [
    "heroText" => "Are you going to die? Have you kicked your mother's bucket? Are your friends on the way out?"
]); ?>

<?= Partial::build('taxonomyTile', ["taxonomies" => $taxonomies]); ?>

<section>
    <div data-js="filtered-omen-list" class="layout layout--distant g-flex">
        <?= Partial::build('omenGrid', ["omenCollection" => $omenCollection, "columns" => 4, "oilPaintings" => TRUE]); ?>
    </div>
</section>

<?= Partial::build('footer'); ?>

