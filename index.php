<?php

// TODO: look into implementing something like this: https://www.sitepoint.com/flexible-view-manipulation-1/

// TODO: replace with composer ASAP, to autoload php files
require "src/Entity/Omen.php";
require "src/Entity/OmenCollection.php";

require "src/Taxonomy/Taxonomy.php";
require "src/Taxonomy/TaxonomyCollection.php";
require "src/Taxonomy/Fault.php";
require "src/Taxonomy/FaultCollection.php";
require "src/Taxonomy/Death.php";
require "src/Taxonomy/DeathCollection.php";
require "src/Taxonomy/Aspect.php";
require "src/Taxonomy/AspectCollection.php";

require "src/Util/Tags.php";

require "src/Route/Route.php";

use Entity\Omen\Omen;
use Entity\Omen\OmenCollection;
use Taxonomy\Fault\FaultCollection;
use Taxonomy\Death\DeathCollection;
use Taxonomy\Aspect\AspectCollection;

use Route\Route;

$faults = new FaultCollection();
$deaths = new DeathCollection();
$aspects = new AspectCollection();

$omens = new OmenCollection();

// Add the first route
Route::add('/user/([0-9]*)/edit', function($id) {
    echo 'Edit user with id '.$id.'<br>';
}, 'get');

// Run the router
Route::run('/');

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

<!--THE REGISTRATION/SIGNIN MODAL WINDOW-->
<section data-js="modal" class="modal modal--register">
    <header>
        <nav class="nav nav--modal layout g-flex">
            <ul class="nav__left">
                <li class="nav__link">Harbingers of Death</li>
                <li aria-hidden="true" class="nav__divider">//</li>
                <li class="nav__link">Register</li>
            </ul>
            <ul class="nav__right">
                <li class="nav__link">Login</li>
                <li aria-hidden="true" class="nav__divider">||</li>
                <li class="nav__link"><a href="" data-js="buttonClose">Close</a></li>
            </ul>
        </nav>
    </header>
    <div class="modal__content">
        <section class="hero">
            <div class="layout layout--distant">
                <h1>Let’s get you counting corpses as quickly as possible.</h1>
            </div>
        </section>
        <section class="form">
            <div class="layout layout--distant">
                <form>
                    <div class="form__row">
                        <div class="form__cell">
                        <label class="input__label" for="name">Name</label><br>
                        <input class="input__text" type="text" id="name" name="name">
                        </div>
                    </div>
                    <div class="form__row">
                        <div class="form__cell">
                        <label class="input__label" for="emailAddress">Email Address</label><br>
                        <input class="input__text" type="text" id="emailAddress" name="emailAddress">
                        </div>
                    </div>
                    <div class="form__row">
                        <div class="form__cell">
                        <label class="input__label" for="password">Password</label><br>
                        <input class="input__text" type="password" id="password" name="password">
                        </div>
                    </div>
                    <fieldset class="form__row">
                        <legend class="input__label">Date of Birth</legend>
                        <div class="form__cell">
                            <label class="input__label input__label--small" for="birthday__day">Day</label><br>
                            <select name="birthday__day" id="birthday__day" class="input__select">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </div>
                        <div class="form__cell">
                            <label class="input__label input__label--small" for="birthday__month">Day</label><br>
                            <select name="birthday__month" id="birthday__month" class="input__select">
                                <option value="1">January</option>
                                <option value="2">February</option>
                                <option value="3">March</option>
                            </select>
                        </div>
                        <div class="form__cell">
                            <label class="input__label input__label--small" for="birthday__month">Day</label><br>
                            <select name="birthday__year" id="birthday__year" class="input__select">
                                <option value="1990">1990</option>
                                <option value="1991">1991</option>
                                <option value="1992">1992</option>
                                <option value="1993">1993</option>
                                <option value="1994">1994</option>
                                <option value="1995">1995</option>
                            </select>
                        </div>

                    </fieldset>
                    <div class="form__row">
                        <div class="form__cell">
                        <label class="input__label" for="country">Country</label><br>
                        <input class="input__text" type="text" id="country" name="country">
                        </div>
                    </div>
                    <input type="submit" class="input__submit" data-js="buttonSubmitRegisterForm" value="Register">
                </form>
            </div>
        </section>
    </div>

</section>

<!--THE HOMEPAGE WINDOW-->
<div data-js="content" class="content">
    <header>
        <nav class="nav layout g-flex">
            <ul class="nav__left">
                <li class="nav__link">Harbingers of Death</li>
            </ul>
            <ul class="nav__right">
                <li class="nav__link"><a data-js="buttonRegister" href="#0">Register</a></li>
                <li aria-hidden="true" class="nav__divider">||</li>
                <li class="nav__link"><a href="">Login</a></li>
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
    <section>
        <div class="layout layout--distant">
            <div class="tile">
                <div class="tile__row">
                    <h2>Find the harbinger of death.</h2>
                </div>
                <ul class="tile__row">
                    <li class="tile__listItem tile__listItem--large tile__listItem--title">Who’s at fault?</li>
                    <?php foreach ($faults->getTaxonomies() as $fault): ?>
                        <li class="tile__listItem tile__listItem--large">
                            <?php echo $fault->getTitle() ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <ul class="tile__row">
                    <li class="tile__listItem tile__listItem--large tile__listItem--title">Who is dying?</li>
                    <?php foreach ($deaths->getTaxonomies() as $death): ?>
                        <li class="tile__listItem tile__listItem--large">
                            <?php echo $death->getTitle() ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <ul class="tile__row  tile__row--last">
                    <li class="tile__listItem tile__listItem--large tile__listItem--title">Where is the dying happening?</li>
                    <?php foreach ($aspects->getTaxonomies() as $aspect): ?>
                        <li class="tile__listItem tile__listItem--large">
                            <?php echo $aspect->getTitle() ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </section>
    <footer class="nav layout">
        <ul class="nav__left">
            <li class="nav__text">Created by <a href="http://www.sfu.ca/~rmichels/imgs/thanksMsg.png">Robert Michels</a> & <a href="">Sam Barnett</a></li>
            <li aria-hidden="true" class="nav__divider">||</li>
            <li class="nav__text">Copyright © 2020. All rights reserved.</li>
        </ul>
        <script src="scripts/script-min.js"></script>
    </footer>
</div>
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
