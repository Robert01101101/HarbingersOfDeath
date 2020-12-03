<?php
use View\Partial; ?>

<section data-js-modal="account" class="modal modal--account" id="modal--account">
    <header>
        <nav class="nav nav--modal layout g-flex">
            <ul class="nav__left">
                <li class="nav__link">Harbingers of Death</li>
                <li aria-hidden="true" class="nav__divider">//</li>
                <li class="nav__link">account</li>
            </ul>
            <ul class="nav__right">
                <!-- <li class="nav__link">account</li> -->
                <!-- <li aria-hidden="true" class="nav__divider">||</li> -->
                <li class="nav__link"><a href="" data-js-modal="closeAccount">Close</a></li>
            </ul>
        </nav>
    </header>
    <div class="modal__content">
        <section class="hero">
            <div class="layout layout--distant">
                <h1>Edit your account while you are still alive.</h1>
            </div>
        </section>
        <?= Partial::build('forms/account'); ?>
    </div>
</section>



