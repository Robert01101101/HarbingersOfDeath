<?php
use View\Partial;
?>
    <?= Partial::build('omenGrid', ["omenCollection" => $omenCollection, "columns" => 4, "oilPaintings" => TRUE]); ?>
