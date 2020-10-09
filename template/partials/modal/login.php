<?php
use Util\HTML\SelectInputs;
?>

<section data-js="modal-l" class="modal modal--login">
    <header>
        <nav class="nav nav--modal layout g-flex">
            <ul class="nav__left">
                <li class="nav__link">Harbingers of Death</li>
                <li aria-hidden="true" class="nav__divider">//</li>
                <li class="nav__link">Login</li>
            </ul>
            <ul class="nav__right">
                <li class="nav__link">Login</li>
                <li aria-hidden="true" class="nav__divider">||</li>
                <li class="nav__link"><a href="" data-js="buttonClose-l">Close</a></li>
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
                            <input class="input__text" type="text" id="emailAddress-l" name="emailAddress-l">
                        </div>
                    </div>
                    <div class="form__row">
                        <div class="form__cell">
                            <label class="input__label" for="password">Password</label><br>
                            <input class="input__text" type="password" id="password-l" name="password-l">
                        </div>
                    </div>
                    <input type="submit" name="submit" class="input__submit" data-js="buttonSubmitLoginForm" value="Sign In &rarr;">
                </form>
            </div>
        </section>
    </div>

</section>


<?php
//________________________________________________________ LOGIN - Process form data & save ______________________________________//
// source: http://www.justin-cook.com/2006/03/31/php-parse-a-string-between-two-strings/
//returns the value of each key (by checking for the string between key & newline)
function get_string_between($string, $start, $end){
    $string = " ".$string;
    $ini = strpos($string,$start);
    if ($ini == 0) return "";
    $ini += strlen($start);   
    $len = strpos($string,$end,$ini) - $ini;
    return substr($string,$ini,$len);
}

$fullstring = file_get_contents("data.txt");
$readMail = get_string_between($fullstring, "EmailAddress: ", "\n");
$readPW = get_string_between($fullstring, "Password: ", "\n");


if(isset($_POST['submit']))
{
    if (isset($_POST['emailAddress-l']) && isset($_POST['password-l'])){
        $userMail = $_POST['emailAddress-l'];
        $userPW = $_POST['password-l'];

        // TODO: fix?
        //fclose($fp);

        if ($readMail == $userMail && $readPW == $userPW){
            //Login
            //TODO: Load Homepage
        } else {
            //Wrong Credentials
        }
    }
}
?>