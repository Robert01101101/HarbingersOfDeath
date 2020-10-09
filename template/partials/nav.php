<?php
use User\User;
use Util\HTML\Tags;

if (isset($_SESSION['user']) && is_object($_SESSION['user'])){
    $user = $_SESSION['user'];
};

?>
<header>
    <nav class="nav layout g-flex">
        <ul class="nav__left">
            <li class="nav__link">Harbingers of Death</li>
        </ul>
        <ul class="nav__right">

            <?php if (isset($user)): ?>
            <li class="nav__text">Oi, <?= Tags::tag('span', $user->getName(), ['class' => 'italics']); ?>, it's time to die, yah cunt!</li>
            <?php else: ?>
            <li class="nav__link"><a data-js="buttonRegister" href="#0">Register</a></li>
            <li aria-hidden="true" class="nav__divider">||</li>
            <!-- TODO: confirm whether the #0 is correct? -->
            <li class="nav__link"><a data-js="buttonLogin" href="#0">Login</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
