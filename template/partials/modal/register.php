<?php
use Util\HTML\SelectInputs;
?>

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
                <!------------------------------------------ KEEP start ------------------>
                <form method="post">
                    <!------------------------------------------ KEEP end ------------------>
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
                    <!------------------------------------------ KEEP start ------------------>
                    <fieldset class="form__row">
                        <legend class="input__label--small">Date of Birth</legend>
                        <div class="birthdate">
                            <?php SelectInputs::numberInput(1,31,"Day", "birthday__day"); ?>
                            <?php SelectInputs::monthInput(); ?>
                            <?php SelectInputs::numberInput(1920,2020,"Year", "birthday__year"); ?>
                        </div>
                    </fieldset>
                    <!------------------------------------------ KEEP end ------------------>
                    <div class="form__row">
                        <div class="form__cell">
                            <label class="input__label" for="country">Country</label><br>
                            <input class="input__text" type="text" id="country" name="country">
                        </div>
                    </div>
                    <!------------------------------------------ KEEP start ------------------>
                    <input type="submit" name="submit" class="input__submit" data-js="buttonSubmitRegisterForm" value="Register">
                    <!------------------------------------------ KEEP end ------------------>
                </form>
            </div>
        </section>
    </div>

</section>


    <!-- PROCESS FORM DATA -->
<?php
if(isset($_POST['submit']))
{
    $data="Name: ".$_POST['name'];
    $data.="\nEmailAddress: ".$_POST['emailAddress'];
    $data.="\nPassword: ".$_POST['password'];
    $data.="\nDOB: d:".$_POST['birthday__day'].", m:".$_POST['birthday__month'].", y:".$_POST['birthday__year'];
    $data.="\nCountry: ".$_POST['country'];
    $fp = fopen('data.txt', 'w');
    fwrite($fp, $data);
    fclose($fp);
}
?>