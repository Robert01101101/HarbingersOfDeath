<?php
use Util\HTML\SelectInputs;
?>

<section data-js="modal-l" class="modal modal--register">
    <header>
        <nav class="nav nav--modal layout g-flex">
            <ul class="nav__left">
                <li class="nav__link">Harbingers of Death</li>
                <li aria-hidden="true" class="nav__divider">//</li>
                <li class="nav__link">Login</li>
            </ul>
            <ul class="nav__right">
                <li class="nav__link">Register</li>
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
                            <input class="input__text" type="text" id="emailAddress" name="emailAddress">
                        </div>
                    </div>
                    <div class="form__row">
                        <div class="form__cell">
                            <label class="input__label" for="password">Password</label><br>
                            <input class="input__text" type="password" id="password" name="password">
                        </div>
                    </div>
                    <input type="submit" name="submit" class="input__submit" data-js="buttonSubmitRegisterForm" value="Register">
                </form>
            </div>
        </section>
    </div>

</section>


<?php
//________________________________________________________ REGISTER - Process form data & save ______________________________________//
/*if(isset($_POST['submit']))
{
    $data="Name: ".$_POST['name'];
    $data.="\nEmailAddress: ".$_POST['emailAddress'];
    $data.="\nPassword: ".$_POST['password'];
    $data.="\nDOB: d:".$_POST['birthday__day'].", m:".$_POST['birthday__month'].", y:".$_POST['birthday__year'];
    $data.="\nCountry: ".$_POST['country'];
    $fp = fopen('data.txt', 'r');

    fclose($fp);
}*/

//________________________________________________________ LOGIN - Process form data & read ______________________________________//
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
$readName = get_string_between($fullstring, "EmailAddress: ", "\n");
$readPW = get_string_between($fullstring, "Password: ", "\n");

?>