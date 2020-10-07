<?php
use Entity\Omen\OmenCollection;
?>


<?php foreach (OmenCollection::getOmens() as $omen): ?>
    <div data-js="tile" class="tile">
                    <span>
                        <span class="tile__text  tile__text--title"><?php echo $omen->getTitle() ?></span>
                        <span class="tile__text"><?php echo $omen->generateSemanticDeath() ?></span>
                    </span>
    </div>
<?php endforeach; ?>