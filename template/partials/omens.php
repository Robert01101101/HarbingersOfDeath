<?php

use Entity\Omen\OmenCollection;
use Entity\Omen\Omen;


$omens = null;


if(
        isset($omenCollection) &&
        !is_null($omenCollection) &&
        is_a($omenCollection,'Entity\Omen\OmenCollection')){
    $omens = $omenCollection->getOmenList();
} else {
    $omens = OmenCollection::getNewOmenList();
}


?>


<?php foreach ($omens as $omen): ?>

    <?php
        // Build taxonomy array for data-js
        $taxonomies = ['fault' => $omen->getFault()->getSlug(),
                'aspect' => $omen->getAspect()->getSlug(),
                'death' => $omen->getDeath()->getSlug()
        ];
        $dataTaxonomyString = '';
        foreach($taxonomies as $taxonomy=>$tag){
            $dataTaxonomyString .= "data-js-" . $taxonomy . "=\"" . $tag . "\" ";
        }
        $taxonomies = $omen->getFault()->getSlug();
    ?>
    <div <?= $dataTaxonomyString ?> data-js="tile" class="tile">
        <a href="<?= $omen->getPath(); ?>">
                <span class="tile__text  tile__text--title"><?php echo $omen->getTitle() ?></span>
                <span class="tile__text"><?php echo $omen->generateSemanticDeath() ?></span>
        </a>
    </div>
<?php endforeach; ?>