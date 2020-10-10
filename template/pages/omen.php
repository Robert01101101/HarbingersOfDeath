<?php

use Taxonomy\Taxonomy\AspectTaxonomy;
use Taxonomy\Death\DeathTaxonomy;
use Taxonomy\Fault\FaultTaxonomy;
use View\Partial;

// THIS IS THE OMEN OBJECT YOU NEED
$omen = $arguments["omen"];
?>

<?= Partial::build('layout/header'); ?>

<!--THE REGISTRATION MODAL WINDOW-->
<?= Partial::build('modal/register'); ?>

<!--THE LOGIN MODAL WINDOW-->
<?= Partial::build('modal/login'); ?>

<!--THE HOMEPAGE WINDOW-->
<?= Partial::build('nav') ?>

<img src="/assets/images/bread.jpg" class="omenImg">

<?= Partial::build("omenHero", [
    "title" => $omen->getTitle(),
    "death" => $omen->generateSemanticDeath()
]); ?>

<article itemscope itemtype="http://schema.org/CreativeWork" class="poem g-margin2of9 g-span4of9">
  <p class="poem__body">
    morning Mass&mdash;<br>
    through the open door<br>
    the smell of new-baked bread
  </p>
  <footer class="poem__author">
    &mdash;<cite itemprop="author">John McDonald</cite>
  </footer>
</article>

<?= Partial::build('taxonomyTile'); ?>
    
  <section>
      <div class="layout layout--distant g-flex">
          <div class="tile__panel tile__panel--primary g-span3of9">
              <h2>Other ways you can kill people</h2>
              <span class="callToAction">See more</span>
          </div>

          <?= Partial::build('omenGrid'); ?>

      </div>
  </section>


  <?= Partial::build('footer'); ?>
</div>