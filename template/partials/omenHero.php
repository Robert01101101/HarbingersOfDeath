<?php
use Taxonomy\Taxonomy\AspectTaxonomy;
use Taxonomy\Death\DeathTaxonomy;
use Taxonomy\Fault\FaultTaxonomy;
use Entity\Omen\OmenCollection;
use Entity\Omen;


//Get omens for members
if (isset($_SESSION['user'])){
    $user = $_SESSION['user'];

    //user has added omen already
    if (OmenCollection::isOmenUserSelected($omen, $user)){
        $addOmenString = "I have not experienced this omen &larr;";
        $nameString = "submit_user_omen_remove";
        $style = "input__submit--destructive";
    } else {
        $style = "";
        $addOmenString = "I have experienced this omen &rarr;";
        $nameString = "submit_user_omen";
    }
}
?>

<section class="hero--omen">
    <div class="layout layout--distant">

        <?php if(isset($_SESSION['user']) && OmenCollection::isOmenUserSelected($omen, $user)): ?>
            <h1><span class="omenTitle"><?= $omen->getStatement() ?></span> <?= $omen->generateSemanticDeath() ?></h1>
        <?php else: ?>
            <h1><span class="omenTitle"><?= $omen->getTitle() ?></span> <?= $omen->generateSemanticDeath() ?></h1>
        <?php endif; ?>

        <?php if(isset($_SESSION['user'])): ?>
            <form method="post">
                <input type="submit" name="<?php echo $nameString ?>" value="<?php echo $addOmenString ?>" class="input__submit input__submit--omen <?php echo $style ?>">
            </form>
        <?php endif ?>
        <br>
    </div>

</section>
