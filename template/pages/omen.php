<?php

use Taxonomy\Taxonomy\AspectTaxonomy;
use Taxonomy\Death\DeathTaxonomy;
use Taxonomy\Fault\FaultTaxonomy;
use Entity\Omen;
use Entity\Omen\OmenCollection;
use View\Partial;

// TODO: 404 error handling

//Provide similar omens (same fault)
$filter = array("fault"=>$omen->getFault()->getSlug());
$omens = OmenCollection::findOmensByFilter($filter);

?>

<?= Partial::build('layout/header'); ?>

<!--THE REGISTRATION MODAL WINDOW-->
<?= Partial::build('modal/register'); ?>

<!--THE LOGIN MODAL WINDOW-->
<?= Partial::build('modal/login'); ?>

<!--THE HOMEPAGE WINDOW-->
<?= Partial::build('nav', ["breadcrumb" => $omen->getTitle()]) ?>

<img src="<?php echo $omen->getImage() ?>" class="omenImg" alt="<?php echo $omen->getImageAuthor() ?>" title="<?php echo $omen->getImageAuthor() ?>">

<?= Partial::build("omenHero", [
    "title" => $omen->getTitle(),
    "statement" => $omen->getStatement(),
    "death" => $omen->generateSemanticDeath(),
    "slug" => $omen->getId()
]); ?>

<article itemscope itemtype="http://schema.org/CreativeWork" class="poem g-margin4of9 g-span4of9">

  <p class="poem__body">
    <?php
      echo str_replace('/',"<br>", $omen->getPoem());
    ?>
  </p>
  <footer class="poem__author">
    &mdash;<cite itemprop="author"><?php echo $omen->getPoemAuthor() ?></cite>
  </footer>
</article>

<?= Partial::build('taxonomyTile'); ?>
    
  <section>
      <div class="layout layout--distant g-flex">
          <div class="tile__panel tile__panel--primary g-span3of9">
              <h2>Other ways <?php echo strtolower($omen->getFault()->getTitle()) ?> can kill people</h2>
              <span class="callToAction">See more</span>
          </div>

          <?= Partial::build('omenGrid', ["omenCollection" => $omens]); ?>

      </div>
  </section>


  <?= Partial::build('footer'); ?>
</div>

