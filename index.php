<?php

// TODO: look into implementing something like this: https://www.sitepoint.com/flexible-view-manipulation-1/

// TODO: replace with composer ASAP, to autoload php files
require "src/Entity/Omen.php";
require "src/Entity/OmenCollection.php";
require "src/Util/Tags.php";

use Entity\Omen\Omen;
use Entity\Omen\OmenCollection;

$omens = new OmenCollection();

?>

<!DOCTYPE html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8"/>
    <title></title>
    <meta name="description" content=""/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>

    <link rel="apple-touch-icon" href="icon.png"/>
    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="https://use.typekit.net/fjv6qfc.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css"
          integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w=="
          crossorigin="anonymous"/>
    <link rel="stylesheet" href="style/main.css"/>
</head>

<body>
<div class="background"></div>
<header>
    <nav class="nav layout g-flex">
        <ul class="nav__breadcrumbs">
            <li class="nav__link">Harbingers of Death</li>
        </ul>
        <ul class="nav__user">
            <li class="nav__link">Register</li>
            <li aria-hidden="true" class="nav__divider">||</li>
            <li class="nav__link">Login</li>
        </ul>
    </nav>
</header>
<section class="hero">
    <div class="layout layout--distant">
        <h1>Are you going to die? Have you kicked your mother's bucket? Are your friends on the way out?</h1>
        <span class="callToAction callToAction--large">Sign in to find out</span>
    </div>
</section>
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

            <?php foreach ($omens->getOmens() as $omen): ?>
                <div data-js="tile" class="tile">

                    <span>
                        <span class="tile__text  tile__text--title"><?php echo $omen->getTitle() ?></span>
                        <span class="tile__text"><?php echo $omen->generateSemanticDeath() ?></span>
                    </span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<footer>
    <script src="scripts/script-min.js"></script>
</footer>
</body>
</html>

<!-- SNIPPETS

  <article itemscope itemtype="http://schema.org/CreativeWork" class="poem">
    <p class="poem__body">
      Yessir, <br>
      yessir, <br>
      three bags full
    </p>
    <footer class="poem__author">
      &mdash;<cite itemprop="author">Tory Guilfroy</cite>
    </article> 

-->
