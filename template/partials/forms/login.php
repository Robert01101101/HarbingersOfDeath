<?php
use Util\HTML\SelectInputs;
?>

<section class="form">
    <div class="layout layout--distant">
		<div class="response" data-js-modal="loginResponse"></div>
        <form method="post" action="/login/" data-js-modal="loginForm"  id="form_login">
            <div class="form__row">
                <div class="form__cell">
                    <label class="input__label" for="emailAddress-l">Email Address</label><br>
                    <input class="input__text" type="text" id="emailAddress-l" name="emailAddress">
                </div>
            </div>
            <div class="form__row">
                <div class="form__cell">
                    <label class="input__label" for="password-l">Password</label><br>
                    <input class="input__text" type="password" id="password-l" name="password">
                </div>
            </div>
            <input type="submit" name="submit_login" class="input__submit input__submit--disabled" data-js-modal="loginSubmitButton" value="Sign In &rarr;" id="submit_login"  title="Complete all fields to sign in" disabled>
        </form>
    </div>
</section>