<?php

use Taxonomy\Aspect\AspectCollection;
use Taxonomy\Death\DeathCollection;
use Taxonomy\Fault\FaultCollection;
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
        "heroText" => "Are you going to die? Have you kicked your mother&#39;s bucket? Are your friends on the way out?",
        "callToActionText" => "Sign in to find out",
        "large" => "true"
]); ?>

    <section>
        <div class="layout layout--distant g-flex">
            <div class="tile__panel tile__panel--primary g-span3of9">
                <h2>Common indicators of imminent death</h2>
                <span class="callToAction">See more</span>
            </div>

            <?= Partial::build('omenGrid'); ?>

        </div>
    </section>

    <?= Partial::build('taxonomyTile'); ?>

    <?= Partial::build('footer'); ?>
</div>


