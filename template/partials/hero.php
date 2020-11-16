<?php

// SANITIZE all page variables before using them
$heroText  = (isset($heroText)) ? htmlspecialchars($heroText) : "Is it time to die?";
$large  = (isset($large)) ? $large : FALSE;
$callToActionText = (isset($callToActionText)) ? htmlspecialchars($callToActionText) : null;
?>

<section class="hero">
    <div class="layout layout--distant">
        <h1><?= $heroText; ?></h1>
<!--        NO CTA IF NO VARIABLE IS PASSED             -->
<!--        BIG CTA TEXT IF VARIABLE TRUE IS PASSED     -->
        <?php if(!is_null($callToActionText)): ?>
        <a data-js-modal="buttonLoginAlt" href="#0"><span class="callToAction <?php if($large == true) echo "callToAction--large" ?>"> <?= $callToActionText; ?></span></a>
        <?php endif; ?>
    </div>
</section>
