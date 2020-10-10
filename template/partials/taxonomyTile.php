<?php
use Taxonomy\AspectTaxonomy;
use Taxonomy\DeathTaxonomy;
use Taxonomy\FaultTaxonomy;


$tileSizeModifier = (isset($large) && !is_null($large) && $large === false) ? "" : " tile--large";

/****
 * This loops through the terms in the URL
 * and checks them against the full list of terms.
 * If there is a match, its sets the terms "active"
 * parameter to true.
 *
 */
$faults = new FaultTaxonomy(TRUE);
$deaths = new DeathTaxonomy(TRUE);
$aspects = new AspectTaxonomy(TRUE);

if(isset($taxonomies) && is_array($taxonomies)) {
    if (isset($taxonomies['fault'])) {
        foreach ($faults->getTerms() as $fault) {
            foreach ($taxonomies['fault']->getTerms() as $activeFault) {
                if ($fault->getSlug() == $activeFault->getSlug()) {
                    $fault->setActive(TRUE);
                }
            }
        }
    }

    if (isset($taxonomies['death'])) {
        foreach ($deaths->getTerms() as $death) {
            foreach ($taxonomies['death']->getTerms() as $activeDeath) {
                if ($death->getSlug() == $activeDeath->getSlug()) {
                    $death->setActive(TRUE);
                }
            }
        }
    }

    if (isset($taxonomies['aspect'])) {
        foreach ($aspects->getTerms() as $aspect) {
            foreach ($taxonomies['aspect']->getTerms() as $activeAspect) {
                if ($aspect->getSlug() == $activeAspect->getSlug()) {
                    $aspect->setActive(TRUE);
                }
            }
        }
    }
}

?>

<section>
    <div class="layout layout--distant">
        <div class="tile<?= $tileSizeModifier ?>">
            <div class="tile__row">
                <h2>Find the harbinger of death.</h2>
            </div>
            <ul class="tile__row">
                <li class="tile__listItem tile__listItem--title">Who’s at fault?</li>
                <?php foreach ($faults->getTerms() as $term): ?>
                    <li class="tile__listItem<?= ($term->isActive() == TRUE) ? " tile__listItem--active" : "" ?>"><?= $term->getTitle() ?></li>
                <?php endforeach; ?>
            </ul>
            <ul class="tile__row">
                <li class="tile__listItem tile__listItem--title">Who is dying?</li>
                <?php foreach ($deaths->getTerms() as $term): ?>
                    <li class="tile__listItem<?= ($term->isActive() == TRUE) ? " tile__listItem--active" : "" ?>"><?= $term->getTitle() ?></li>
                <?php endforeach; ?>
            </ul>
            <ul class="tile__row  tile__row--last">
                <li class="tile__listItem tile__listItem--title">Where is the dying
                    happening?
                </li>
                <?php foreach ($aspects->getTerms() as $term): ?>
                    <li class="tile__listItem<?= ($term->isActive() == TRUE) ? " tile__listItem--active" : "" ?>"><?= $term->getTitle() ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</section>
