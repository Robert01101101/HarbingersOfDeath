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
        <section class="form">
            <div class="layout layout--distant">
                <form method="post">
                    <div class="form__row">
                        <div class="form__cell">
                            <label class="input__label" for="emailAddress">Email Address</label><br>
<!--                            I removed the 'L' because I made the forms
                                different by changing the name of the submit button-->
                            <input class="input__text" type="text" id="emailAddress-l" name="emailAddress">
                        </div>
                    </div>
                    <div class="form__row">
                        <div class="form__cell">
                            <label class="input__label" for="password">Password</label><br>
                            <input class="input__text" type="password" id="password-l" name="password">
                        </div>
                    </div>
                    <input type="submit" name="submit_login" class="input__submit" data-js="buttonSubmitLoginForm" value="Sign In &rarr;">
                </form>
            </div>
        </section>
    </div>

</section>

