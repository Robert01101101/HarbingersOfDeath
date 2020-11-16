<?php

use Taxonomy\Taxonomy\AspectTaxonomy;
use Taxonomy\Death\DeathTaxonomy;
use Taxonomy\Fault\FaultTaxonomy;
use View\Partial;

$userLoggedIn = isset($_SESSION['user']);
if ($userLoggedIn) $user = $_SESSION['user'];



?>

<?= Partial::build('layout/header'); ?>

<!--THE REGISTRATION MODAL WINDOW-->
<?= Partial::build('modal/register'); ?>

<!--THE LOGIN MODAL WINDOW-->
<?= Partial::build('modal/login'); ?>

<!--THE HOMEPAGE WINDOW-->
<?= Partial::build('nav') ?>

<?php if(!$userLoggedIn) : ?>
    <?= Partial::build("hero", [
            "heroText" => "Are you going to die? Have you kicked your mother's bucket? Are your friends on the way out?",
            "callToActionText" => "Sign in to find out",
            "large" => "true"
    ]); ?>
 <?php endif; ?>


<?php if (isset($response) && !is_null($response)): ?>

	<span class="response"><?= $response ?></span>
		
<?php endif; ?>
 
    <section>
        <div class="layout layout--distant g-flex">
            <div class="tile__panel tile__panel--primary g-span3of9">

            <?php if($userLoggedIn) : ?>
                <h2>Your encounters with death</h2>
            <?php else : ?>
                <h2>Common indicators of imminent death</h2>
            <?php endif; ?>

                

                <span class="callToAction">See more</span>
            </div>

            <?= Partial::build('omenGrid', ["home" => "true"]); ?>

        </div>
    </section>

    <?= Partial::build('taxonomyTile'); ?>

    <?= Partial::build('footer'); ?>
</div>