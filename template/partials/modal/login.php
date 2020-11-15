<?php
use Util\HTML\SelectInputs;
?>

<section data-js-modal="login" class="modal modal--login" id="modal--login">
    <header>
        <nav class="nav nav--modal layout g-flex">
            <ul class="nav__left">
                <li class="nav__link">Harbingers of Death</li>
                <li aria-hidden="true" class="nav__divider">//</li>
                <li class="nav__link">Login</li>
            </ul>
            <ul class="nav__right">
                <!-- <li class="nav__link">Login</li> -->
                <!-- <li aria-hidden="true" class="nav__divider">||</li> -->
                <li class="nav__link"><a href="" data-js-modal="close">Close</a></li>
            </ul>
        </nav>
    </header>
    <div class="modal__content">
        <section class="hero">
            <div class="layout layout--distant">
                <h1>Quick! Let's get you back to counting your corpses</h1>
            </div>
        </section>
		<?= Partial::build('forms/login') ?>
    </div>

</section>

