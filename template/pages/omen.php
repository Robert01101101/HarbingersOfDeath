<?php

use Taxonomy\Taxonomy\AspectTaxonomy;
use Taxonomy\Death\DeathTaxonomy;
use Taxonomy\Fault\FaultTaxonomy;
use Entity\Omen;
use View\Partial;

// TODO: 404 error handling
?>

<?= Partial::build('layout/header'); ?>

<!--THE REGISTRATION MODAL WINDOW-->
<?= Partial::build('modal/register'); ?>

<!--THE LOGIN MODAL WINDOW-->
<?= Partial::build('modal/login'); ?>

<!--THE HOMEPAGE WINDOW-->
<?= Partial::build('nav', ["breadcrumb" => $omen->getTitle()]) ?>

<img src="/assets/images/bread.jpg" class="omenImg">

<?= Partial::build("omenHero", [
    "title" => $omen->getTitle(),
    "death" => $omen->generateSemanticDeath()
]); ?>

<article itemscope itemtype="http://schema.org/CreativeWork" class="poem g-margin2of9 g-span4of9">

  <!-- TODO: Swap for Sam's updated design -->
  <?php if(isset($_SESSION['user'])) : ?>
    <form method="post">
      <input type="submit" name="submit_user_omen" value="THIS TOTALLY APPLIES TO ME, I WILL DIE!!! &rarr;">
    </form>
    <br>
  <?php endif; ?>

  
  

  <p class="poem__body">
    morning Mass&mdash;<br>
    through the open door<br>
    the smell of new-baked bread<br>
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

