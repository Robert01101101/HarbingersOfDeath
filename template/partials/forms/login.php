<section class="form">
    <div class="layout layout--distant">
        <form method="post" action="/login/ajax/">
            <div class="form__row">
                <div class="form__cell">
                    <label class="input__label" for="emailAddress">Email Address</label><br>
                    <input class="input__text" type="text" id="emailAddress-l" name="emailAddress">
                </div>
            </div>
            <div class="form__row">
                <div class="form__cell">
                    <label class="input__label" for="password">Password</label><br>
                    <input class="input__text" type="password" id="password-l" name="password">
                </div>
            </div>
            <input type="submit" name="submit_login" class="input__submit" data-js-modal="loginSubmitButton" value="Sign In &rarr;">
        </form>
    </div>
</section>