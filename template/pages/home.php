<?php

use Taxonomy\Aspect\AspectCollection;
use Taxonomy\Death\DeathCollection;
use Taxonomy\Fault\FaultCollection;
use View\Partial;

?>

<?= Partial::build('layout/header'); ?>

<!--THE REGISTRATION/SIGNIN MODAL WINDOW-->
<?= Partial::build('modal/register'); ?>

<!--THE HOMEPAGE WINDOW-->
<?= Partial::build('nav') ?>


<?= Partial::build("hero", [
        "heroText" => "Are you going to die? Have you kicked your mother\'s bucket? Are your friends on the way out?",
        "callToActionText" => "Sign in to find out",
        "large" => "true"
]); ?>

    <section>
        <div class="layout layout--distant g-flex">
            <div class="tile__panel tile__panel--primary g-span3of9">
                <h2>Common indicators of imminent death</h2>
                <span class="callToAction">See more</span>
            </div>
            <div data-js="grid" class="tile__panel js-panel g-span6of9 g-last g-flex">
                <div data-js="column" class="tile__panel__column g-span2of6"></div>
                <div data-js="column" class="tile__panel__column g-span2of6"></div>
                <div data-js="column" class="tile__panel__column g-span2of6 g-last"></div>

                <?= Partial::build('omens'); ?>

            </div>
        </div>
    </section>
    <?= Partial::build('taxonomyTile'); ?>

    <?= Partial::build('footer'); ?>
</div>


