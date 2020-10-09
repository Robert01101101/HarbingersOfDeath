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

require "src/User/User.php";

require "src/Util/Tags.php";
require "src/Util/SelectInputs.php";
require "src/Util/TextParser.php";

require "src/Route/Route.php";

require "src/View/Page.php";
require "src/View/Partial.php";

use Entity\Omen\Omen;
use Entity\Omen\OmenCollection;
use Taxonomy\Fault\FaultCollection;
use Taxonomy\Death\DeathCollection;
use Taxonomy\Aspect\AspectCollection;

use User\User;

use Route\Route;
use View\Page;
use View\Partial;

$faults = new FaultCollection();
$deaths = new DeathCollection();
$aspects = new AspectCollection();

$omens = new OmenCollection();


session_start();


// Add the individual omen route
Route::add('/omen/([a-z0-9]+(?:-[a-z0-9]+)*)', function($slug) {
    $omen = OmenCollection::getOmenBySlug($slug);
    Page::build('omen', ["omen" => $omen]);
}, 'get');

// Add omen list route
// TODO: confirm (it should be) that the routes are processed in order, so that this one shouldn't override the previous
Route::add('/omen', function($query) {
    echo "You're on the omen list page";
}, 'get', true);

Route::add('/', function (){
    Page::build('home');

});

// Handles register and login form submissions
Route::add('/', function (){
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
        var_dump($_POST, $user);
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
}, 'post');

// Run the router
Route::run('/');
