<?php

// TODO: look into implementing something like this: https://www.sitepoint.com/flexible-view-manipulation-1/

// TODO: replace with composer ASAP, to autoload php files


require "src/Entity/Omen.php";
require "src/Entity/OmenCollection.php";

require "src/Taxonomy/Term.php";
require "src/Taxonomy/Taxonomy.php";
require "src/Taxonomy/Fault.php";
require "src/Taxonomy/FaultTaxonomy.php";
require "src/Taxonomy/Death.php";
require "src/Taxonomy/DeathTaxonomy.php";
require "src/Taxonomy/Aspect.php";
require "src/Taxonomy/AspectTaxonomy.php";

require "src/User/User.php";

require "src/Util/Tags.php";
require "src/Util/SelectInputs.php";
require "src/Util/TextParser.php";

require "src/Route/Route.php";

require "src/View/Page.php";
require "src/View/Partial.php";

use Entity\Omen\Omen;
use Entity\Omen\OmenCollection;
use Taxonomy\FaultTaxonomy;
use Taxonomy\DeathTaxonomy;
use Taxonomy\AspectTaxonomy;

use Taxonomy\Fault;
use Taxonomy\Death;
use Taxonomy\Aspect;

use User\User;

use Route\Route;
use View\Page;
use View\Partial;

//$faults = new FaultTaxonomy();
//$deaths = new DeathTaxonomy();
//$aspects = new AspectTaxonomy();

$omens = new OmenCollection();


// start session so that we can store logged in cookie
session_start();

/*************************************************
 **  INDIVIDUAL OMEN ROUTE
 *************************************************/
// Add the individual omen route
Route::get('/omen/([a-z0-9]+(?:-[a-z0-9]+)*)', function($slug) {
    $omen = OmenCollection::getOmenBySlug($slug);
    Page::build('omen', ["omen" => $omen]);
});


/*************************************************
 **  OMEN LIST ROUTE
 *************************************************/
// Add omen list route
// TODO: confirm (it should be) that the routes are processed in order, so that this one shouldn't override the previous
Route::get('/omen', function($query) {
    $taxonomies = [];

    // TODO: REFACTOR & PUT ELSEWHERE https://gph.is/g/aN3YOMZ
    foreach ($query as $taxonomy => $term){
        switch ($taxonomy){
            case "aspect":
                if(!isset($taxonomies["aspect"]))  $taxonomies["aspect"] = new AspectTaxonomy();
                $taxonomies["aspect"]->addTerm(AspectTaxonomy::getTermBySlug($term));

                break;

            case "death":
                if(!isset($taxonomies["death"]))  $taxonomies["death"] = new DeathTaxonomy();
                $taxonomies["death"]->addTerm(DeathTaxonomy::getTermBySlug($term));

                break;
            case "fault":
                if(!isset($taxonomies["fault"]))  $taxonomies["fault"] = new FaultTaxonomy();
                $taxonomies["fault"]->addTerm(FaultTaxonomy::getTermBySlug($term));
                break;
        }
    }

    $omensCollection = new OmenCollection();

    foreach ($taxonomies as $taxonomy){
        foreach ($taxonomy as $key => $tag){
            $tempOmensCollection = $tag->filterOmensByTaxonomy($omensCollection);
            $omensCollection = $tempOmensCollection;
        }
    }


    Page::build('omen-list', ["taxonomies" => $taxonomies, "omens" => $omensCollection]);
}, true);


/*************************************************
**  HOMEPAGE ROUTE
 *************************************************/
Route::get('/', function (){
    Page::build('home');
});


/*************************************************
 **  HOMEPAGE FORM SUBMISSION ROUTE
 *************************************************/
// Handles register and login form submissions
Route::post('/', function (){
    // TODO: move data processing to it's own place
    // if Register Form has  been submitted
    // create new User object and write it to a text file
    if(isset($_POST['submit_register'])) {
        $user = (new User())
            ->setName($_POST['name'])
            ->setEmailAddress($_POST['emailAddress'])
            ->setPassword($_POST['password'])
            ->setBirthdayDay($_POST['birthday__day'])
            ->setBirthdayMonth($_POST['birthday__month'])
            ->setBirthdayYear($_POST['birthday__year'])
            ->setCountry($_POST['country'])
            ->writeToFile('data.txt');
    }

    // if Login Form is submitted
    // create new User object from the text file and
    // compare it against the post values
    if (isset($_POST['submit_login'])){
        $user = User::buildFromFile('data.txt');
        //var_dump($_POST, $user);

        if(
            (isset($_POST['emailAddress']) && isset($_POST['password'])) &&
            ($_POST['emailAddress'] == $user->getEmailAddress() && $_POST['password'] == $user->getPassword())
        ){
            $_SESSION['user'] = $user;
        } else {
            unset($_SERVER['user']);
        }
    }

    Page::build('home');
});

// Run the router
Route::run('/');
