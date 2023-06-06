<?php


namespace Taxonomy;


use Taxonomy\Term;

abstract class Taxonomy
{
    //@Sam what's the difference between termArray & terms?
    protected array $termArray;

    protected array $terms = array();

    protected $connection;

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
        // Create a database connection
        include('nopublicaccess/auth.php');
        $this->connection = mysqli_connect($DBHOST, $DBUSER, $DBPASS, $DBNAME_HOD);

        // Test if connection succeeded
        if(mysqli_connect_errno()) {
            // if connection failed, skip the rest of PHP code, and print an error
            die("Database connection failed: " . mysqli_connect_error() . " (" . mysqli_connect_errno() . ")" );
        }
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
    public abstract static function getAllTerms(): self;

    public function getTerms(): array
    {
        return $this->terms;
    }

}