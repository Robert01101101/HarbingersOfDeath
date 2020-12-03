<?php

use Taxonomy\Taxonomy\AspectTaxonomy;
use Taxonomy\Death\DeathTaxonomy;
use Taxonomy\Fault\FaultTaxonomy;
use View\Partial;

$searchQuery = (isset($searchQuery)) ? htmlspecialchars($searchQuery) : "";

?>

<?= Partial::build('layout/header'); ?>

    <!--THE REGISTRATION MODAL WINDOW-->
<?= Partial::build('modal/register'); ?>

    <!--THE LOGIN MODAL WINDOW-->
<?= Partial::build('modal/login'); ?>

    <!--THE HOMEPAGE WINDOW-->
<?= Partial::build('nav') ?>


<section>
    <div class="layout layout--distant">
<!--        <div class="response" data-js-modal="loginResponse"></div>-->
        <form method="post" action="/search/" data-js-searchForm="searchForm"  id="search_form">
            <div class="form__row">
                <div class="form__cell">
                    <label class="input__label" for="search">Search Omens</label><br>
                    <input data-js-searchForm="searchBar" class="input__text" type="text" id="search" name="search" value="<?= $searchString ?>">
                </div>
            </div>
        </form>
    </div>
</section>

<section>
    <div  class="layout layout--distant g-flex">
        <div class="tile__panel tile__panel--primary g-span3of9">
            <h2>Search Results</h2>
            <h3 data-js-searchForm="queryDisplay" class="form__searchQuery"><?= $searchString ?></h3>
        </div>

        <?= Partial::build('omenGrid', ["omenCollection" => $omenCollection]); ?>

    </div>
</section>



<?= Partial::build('footer'); ?>

