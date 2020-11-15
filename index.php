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
 **  AJAX OMEN LIST ROUTE
 *  TODO: refactor so code isn't duplicated
 *
 *************************************************/
// Add omen list route
// TODO: confirm (it should be) that the routes are processed in order, so that this one shouldn't override the previous
Route::get('/omen/ajax', function($query) {
    //print_r($query);

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


    //var_dump();

    /*
    foreach ($taxonomies as $taxonomy){
        foreach ($taxonomy->getTerms() as $key => $tag){
            $tempOmensCollection = $tag->filterOmensByTaxonomy($omensCollection);
            $omensCollection = $tempOmensCollection;
        }
    }
    */

    $omensCollection = OmenCollection::findOmensByFilter($query);

    Page::build('js-omen-list', ["taxonomies" => $taxonomies, "omens" => $omensCollection]);
}, true);

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
    /*
    $omensCollection = new OmenCollection();
    $debugCount = 0;
    foreach ($taxonomies as $taxonomy){
        $debugCount++;
        echo $debugCount;
        echo "<br>";
        print_r($taxonomy->getTerms());
        foreach ($taxonomy->getTerms() as $key => $tag){
            $tempOmensCollection = $tag->filterOmensByTaxonomy($omensCollection);
            $omensCollection = $tempOmensCollection;
        }
    }
    var_dump($taxonomies);
    echo "<br>";
    echo "<br>";
    print_r($taxonomies);
    echo "<br>";
    echo "_____________________________________________________________________<br>";
    */

    $omensCollection = OmenCollection::findOmensByFilter($query);

    Page::build('omen-list', ["taxonomies" => $taxonomies, "omens" => $omensCollection]);
}, true);


/*************************************************
**  HOMEPAGE ROUTE
 *************************************************/
Route::get('/', function (){
    Page::build('home');
});


/*************************************************
 **  REGISTER FORM SUBMISSION ROUTE
 *************************************************/
// Handles register and login form submissions
Route::post('/register/ajax', function (){
    // TODO: move data processing to it's own place
    ////////////////////////////////// REGISTER
    if(isset($_POST['submit_register'])) {
        $user = (new User())
            ->setName($_POST['name'])
            ->setEmailAddress($_POST['emailAddress'])
            ->setPassword(sha1($_POST['password']))
            ->setBirthdayDay($_POST['birthday__day'])
            ->setBirthdayMonth($_POST['birthday__month'])
            ->setBirthdayYear($_POST['birthday__year'])
            ->setCountry($_POST['country'])
            ->writeToDB();
    }
	Page::build('home');
});

	
/*************************************************
 **  LOGIN FORM SUBMISSION ROUTE
 *************************************************/
// Handles register and login form submissions
Route::post('/login/ajax', function (){

	
	Page::build('js-formSuccess', ["user" => "user"]);
    ////////////////////////////////// LOGIN
    // create new User object from the text file and
    // compare it against the post values
    if (isset($_POST['submit_login'])){
        
        $formEmail = $_POST['emailAddress'];
        $formPassword = $_POST['password'];

        if (isset($formEmail) && isset($formPassword)){
            $user = User::authenticateUser($formEmail, $formPassword);

            if(isset($user)){
                //echo "Successful Login";
                $_SESSION['user'] = $user;
				//Page::build('js-formSuccess', ["user" => $user]);
            } else {
                //echo "Login Failed - try again with correct credentials";
                unset($_SERVER['user']);
            }
        } else {
            //echo "please fill all fields";
        }
    }

    
});


/*************************************************
 **  OMEN FORM SUBMISSION ROUTE
 *************************************************/
// Handles omen submissions
Route::post('/omen/([a-z0-9]+(?:-[a-z0-9]+)*)', function($slug) {
    $omen = OmenCollection::getOmenBySlug($slug);

    ////////////////////////////////// OMEN
    if (isset($_POST['submit_user_omen'])){
          //echo "user added omen";
          $user = $_SESSION['user']; 
          //echo get_class($user);
          //echo $user->get

          $user->addOmenToUser($omen);
    }

    
    Page::build('omen', ["omen" => $omen]);
});





// Run the router
Route::run('/');
