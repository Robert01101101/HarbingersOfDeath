<?php

use View\Partial;

// if columns don't exist, set it to 3
$columns  = (isset($arguments["columns"])) ? $arguments["columns"] : 3;

// this assumes omen columns will always span two columns of the grid
?>

<div data-js="grid" class="tile__panel js-panel g-span<?= $columns * 2 ?>of9 g-last g-flex">
    <?php for($i = 0; $i < $columns; $i++): ?>
    <?php
        //generate grid class
        $columnClass = "g-span2of".$columns * 2;

        // if last column add class ".g-last" to remove right padding
        if ($i === $columns-1){
            $columnClass .= " g-last";
        }
        ?>
    <div data-js="column" class="tile__panel__column <?= $columnClass ?>"></div>

    <?php endfor; ?>

    <?= Partial::build('omens'); ?>

</div>
