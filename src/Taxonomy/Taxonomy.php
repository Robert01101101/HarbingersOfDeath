<?php


namespace Taxonomy;


use Taxonomy\Term;

abstract class Taxonomy
{
    //@Sam what's the difference between termArray & terms?
    protected array $termArray;

    protected array $terms = array();

    protected $connection;

    //Connection Variables
    const DBHOST = "localhost";
    const DBUSER = "root";
    const DBPASS = "";
    const DBNAME = "robert_michels";

    //Table Names
    const T_ADDRESS = "address";
    const T_ASPECT = "aspect";
    const T_DEATH = "death";
    const T_FAULT = "fault";
    const T_OMEN = "omen";
    const T_USER = "user";
    const T_USER_OMEN = "user_omen";

    //Column Names
    const C_SLUG = "slug";

    public function __construct()
    {
        // Not in use because I couldn't refer to the connection variable initialized here (due to lack of PHP wizardry)
        // Set up MySQLi connection
        // Code for connection is from Lab.
        // 1. Create a database connection
        /*
        $dbhost = "localhost";
        $dbuser = "root";
        $dbpass = "";
        $dbname = "robert_michels";
        $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

        // Test if connection succeeded
        if(mysqli_connect_errno()) {
        // if connection failed, skip the rest of PHP code, and print an error
        die("Database connection failed: " . 
             mysqli_connect_error() . 
             " (" . mysqli_connect_errno() . ")"
        );
        }*/
    }

    /**
     * @param \Taxonomy\Term $taxonomy
     * @return $this
     *
     * TODO: ERROR HANDLING
     */
    public function addTerm(Term $taxonomy){
        //if(is_a($taxonomy, 'Taxonomy/Taxonomy')){
            $this->terms[] = $taxonomy;
       // }
        return $this;
    }

    public abstract function createTerm($slug, $title);

    public static abstract function getTermBySlug(string $slug);

    protected function loadArray(){
        foreach ($this->termArray as $individualTaxonomy) {
            $this->createTerm($individualTaxonomy["slug"], $individualTaxonomy["title"]);
        }
        return $this;
    }

    /**
     * @return array
     * // work out how to use/workaround "(new self)" in abstract class
     */
    public abstract static function getAllTerms(): array;

    public abstract function getTerms() : array;

}