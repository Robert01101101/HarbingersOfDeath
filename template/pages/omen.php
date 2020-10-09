<?php

use Taxonomy\Aspect\AspectCollection;
use Taxonomy\Death\DeathCollection;
use Taxonomy\Fault\FaultCollection;
use View\Partial;

// THIS IS THE OMEN OBJECT YOU NEED
$omen = $arguments["omen"];
?>


<?= Partial::build('layout/header'); ?>

    <!--THE REGISTRATION/SIGNIN MODAL WINDOW-->
<?= Partial::build('modal/register'); ?>

    <!--THE HOMEPAGE WINDOW-->
<?= Partial::build('nav') ?>

<?= Partial::build("omenHero", [
    "title" => $omen->getTitle(),
    "death" => $omen->generateSemanticDeath()
]); ?>




<article itemscope itemtype="http://schema.org/CreativeWork" class="poem">
  <p class="poem__body">
    Yessir, <br>
    yessir, <br>
    three bags full
  </p>
  <footer class="poem__author">
    &mdash;<cite itemprop="author">Tory Guilfroy</cite>
    



