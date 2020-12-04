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

<!--THE ACCOUNT MODAL WINDOW-->
<?= Partial::build('modal/account'); ?>

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

	<div class="response"><span><?= $response ?></span></div>
		
<?php endif; ?>
 
    <section>
        <div class="layout layout--distant g-flex">
            <div class="tile__panel tile__panel--primary g-span3of9">

            <?php if($userLoggedIn) : ?>
                <h2>Your encounters with death</h2>
            <?php else : ?>
                <h2>Common indicators of imminent death</h2>
            <?php endif; ?>

                <span class="callToAction"><a href="/omen/" class="input__seeMore" >See more</a></span>
                <br />
                <span class="callToAction"><a href="/search/" class="input__seeMore" >Search</a></span>

                <?php if($userLoggedIn) : ?>
                    <br />
                    <span class="callToAction"><a href="/clear/" class="input__seeMore" >Clear all omens</a></span>
                <?php endif; ?>

            </div>

            <?= Partial::build('omenGrid', ["home" => "true", "omenCollection" => $omenCollection]); ?>

        </div>
    </section>

    <?= Partial::build('taxonomyTile'); ?>

    <?= Partial::build('footer'); ?>
</div>