<?php
use View\Partial;
?>
    <?= Partial::build('omenGrid', ["omenCollection" => $omens, "columns" => 4, "oilPaintings" => TRUE]); ?>
