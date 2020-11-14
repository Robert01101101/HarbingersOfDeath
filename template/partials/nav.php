<?php
use User\User;
use Util\HTML\Tags;

if (isset($_SESSION['user']) && is_object($_SESSION['user'])){
    $user = $_SESSION['user'];
    //echo "USER IS LOGGED IN BUT THE CODE DOES NOT WORK YET";
};

$breadcrumb  = (isset($breadcrumb)) ? htmlspecialchars($breadcrumb) : null;

?>

<div data-js="content" class="content">
<header>
    <nav class="nav layout g-flex">
        <ul data-js="breadcrumbs" class="nav__left">
            <li class="nav__link"><a href="/">Harbingers of Death</a></li>
            <?php if(!is_null($breadcrumb)): ?>
            <li aria-hidden="true" class="nav__divider">//</li>
            <li class="nav__link"><?= $breadcrumb?></li>
            <?php endif; ?>
        </ul>
        <ul class="nav__right">
            <?php if (isset($user)): ?>
            <li class="nav__text">Oi, <?= Tags::tag('span', $user->getName(), ['class' => 'italics']); ?>, it's time to die!</li>
            <?php else: ?>
            <li class="nav__link"><a data-js-modal="registerButton" href="#0">Register</a></li>
            <li aria-hidden="true" class="nav__divider">||</li>
            <!-- TODO: confirm whether the #0 is correct? -->
            <li class="nav__link"><a data-js-modal="loginButton" href="#0">Login</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>