<?php
?>

<section class="hero">
    <div class="layout layout--distant">
        <h1><?= $arguments["heroText"]; ?></h1>
<!--        BIG CTA TEXT IF VARIABLE TRUE IS PASSED-->
        <span class="callToAction <?php if($arguments["large"] == true) echo "callToAction--large" ?>"> <?= $arguments["callToActionText"]; ?></span>
    </div>
</section>
