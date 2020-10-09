<?php
use Taxonomy\Aspect\AspectCollection;
use Taxonomy\Death\DeathCollection;
use Taxonomy\Fault\FaultCollection;

?>

<section>
    <div class="layout layout--distant">
        <div class="tile">
            <div class="tile__row">
                <h2>Find the harbinger of death.</h2>
            </div>
            <ul class="tile__row">
                <li class="tile__listItem tile__listItem--large tile__listItem--title">Who’s at fault?</li>
                <?php foreach (FaultCollection::getTaxonomies() as $fault): ?>
                    <li class="tile__listItem tile__listItem--large">
                        <?php echo $fault->getTitle() ?>
                    </li>
                <?php endforeach; ?>
            </ul>
            <ul class="tile__row">
                <li class="tile__listItem tile__listItem--large tile__listItem--title">Who is dying?</li>
                <?php foreach (DeathCollection::getTaxonomies() as $death): ?>
                    <li class="tile__listItem tile__listItem--large">
                        <?php echo $death->getTitle() ?>
                    </li>
                <?php endforeach; ?>
            </ul>
            <ul class="tile__row  tile__row--last">
                <li class="tile__listItem tile__listItem--large tile__listItem--title">Where is the dying
                    happening?
                </li>
                <?php foreach (AspectCollection::getTaxonomies() as $aspect): ?>
                    <li class="tile__listItem tile__listItem--large">
                        <?php echo $aspect->getTitle() ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</section>
