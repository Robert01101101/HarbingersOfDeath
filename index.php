<?php

// TODO: look into implementing something like this: https://www.sitepoint.com/flexible-view-manipulation-1/

// TODO: replace with composer ASAP, to autoload php files


require "src/Entity/Omen.php";
require "src/Entity/OmenCollection.php";

require "src/Taxonomy/Taxonomy.php";
require "src/Taxonomy/TaxonomyCollection.php";
require "src/Taxonomy/Fault.php";
require "src/Taxonomy/FaultCollection.php";
require "src/Taxonomy/Death.php";
require "src/Taxonomy/DeathCollection.php";
require "src/Taxonomy/Aspect.php";
require "src/Taxonomy/AspectCollection.php";

require "src/Util/Tags.php";
require "src/Util/SelectInputs.php";

require "src/Route/Route.php";

require "src/View/Page.php";
require "src/View/Partial.php";

use Entity\Omen\Omen;
use Entity\Omen\OmenCollection;
use Taxonomy\Fault\FaultCollection;
use Taxonomy\Death\DeathCollection;
use Taxonomy\Aspect\AspectCollection;


use Route\Route;
use View\Page;
use View\Partial;

$faults = new FaultCollection();
$deaths = new DeathCollection();
$aspects = new AspectCollection();

$omens = new OmenCollection();


// Add the individual omen route
Route::add('/omen/([a-z0-9]+(?:-[a-z0-9]+)*)', function($slug) {
    echo "the individual omen route";

    var_dump($slug);

//    OmenCollection::getOmenBySlug($slug);
}, 'get');

// Add omen list route
// TODO: confirm (it should be) that the routes are processed in order, so that this one shouldn't override the previous
Route::add('/omen', function($query) {
    echo "omen list route";
    var_dump($query);
//    var_dump($slug);
//    var_dump($query);
//    echo "SLUG: " . $slug;
//    OmenCollection::getOmenBySlug($slug);
}, 'get', true);

Route::add('/', function (){
    Page::build('home');
});

// Run the router
Route::run('/');
