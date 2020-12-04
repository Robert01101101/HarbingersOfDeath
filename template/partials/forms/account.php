<?php
use Util\HTML\SelectInputs;
?>

<?php if(isset($_SESSION['user']) && is_object($_SESSION['user'])) : ?>

    <?php 
        $user = $_SESSION['user'];  
    ?>

    <section class="form">
        <div class="layout layout--distant">
            <div class="response" data-js-modal="accountResponse"></div>
            <form method="post" action="/account/" data-js-modal="accountForm"  id="form_account">
                <div class="form__row">
                    <div class="form__cell">
                        <label class="input__label input__label--floating input__label--selected" for="emailAddress-a">Email Address</label><br>
                        <input class="input__text" type="text" id="emailAddress-a" name="emailAddress" value="<?php echo $user->getEmailAddress(); ?>">
                    </div>
                </div>
                <div class="form__row">
                    <div class="form__cell">
                        <label class="input__label input__label--floating input__label--selected" for="name-a">Name</label><br>
                        <input class="input__text" type="name" id="name-a" name="name" value="<?php echo $user->getName(); ?>">
                    </div>
                </div>
                <div class="form__row">
                    <div class="form__cell">
                        <label class="input__label input__label--floating" for="password-a-old">Password (old)</label><br>
                        <input class="input__text" type="password-old" id="password-a-old" name="password-old">
                    </div>
                </div>
                <div class="form__row">
                    <div class="form__cell">
                        <label class="input__label input__label--floating" for="password-a">Password (new)</label><br>
                        <input class="input__text" type="password" id="password-a" name="password">
                    </div>
                </div>
                <div class="accountSubmit">
                    <input type="submit" name="submit_account" class="input__submit input__submit--disabled" data-js-modal="accountSubmitButton" value="Save &rarr;" id="submit_account"  title="Change values in order to save" disabled>
                    <a href="/logout/" class="input__submit input__submit--logout input__submit--destructive">&larr; Logout</a>
                </div>
            </form>
        </div>
    </section>

<?php endif; ?>