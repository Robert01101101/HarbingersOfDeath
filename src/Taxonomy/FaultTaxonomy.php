<?php


namespace Taxonomy;

use Entity\Omen\OmenCollection;
use Taxonomy\Aspect;
use Taxonomy\Taxonomy;
use Taxonomy\Term;

class FaultTaxonomy extends Taxonomy
{

    /**
     * @param $slug
     * @param $title
     *
     * Creates a new Taxonomony and adds it to the taxonomies array
     */
    public function createTerm($slug, $title):  Death
    {
        return (new Fault())
            ->setId(count($this->terms))
            ->setSlug($slug)
            ->setTitle($title);
    }

    //TODO: @Sam - confirm whether this change is okay. Original code is commented out
    public function addTerm(Term $fault): array//Fault $fault) : array
    {
        $this->terms[] = $fault;
        return $this->terms;
    }

    protected function processQuery($query) : self
    {
        $result = mysqli_query($this->connection, $query);

        //Print rows
        while($row = mysqli_fetch_array($result))
        {
            $item = (new Fault())
                ->setId($row[0])
                ->setSlug($row[1])
                ->setTitle($row[2]);

            array_push($this->terms, $item);
        }

        // Release returned data
        mysqli_free_result($result);

        // Close database connection
        mysqli_close($this->connection);

        // Return self for chaining
        return $this;
    }


    /**
     * @param string $slug
     * @return Fault
     *
     * This returns a Fault object based on a slug passed to it
     *
     * TODO: error handling
     * TODO: move to parent class
     */
    public static function getTermBySlug(string $slug): Fault
    {
       //SQL query
        // should use "(new self)" which will call the constructor
        // (which sets up the db connection)
        // don't forget to close the database connection "$this->connection = null"
        // return an array of Term objects
        //TODO: MOVE TO CONSTRUCTOR
        //new self();

        include('nopublicaccess/auth.php');
        $connection = mysqli_connect($DBHOST, $DBUSER_HOD, $DBPASS, $DBNAME_HOD);
        if(mysqli_connect_errno()) { die("Database connection failed: " . mysqli_connect_error() . " (" . mysqli_connect_errno() . ")" ); }

        // 2. Perform database query
        $query = "SELECT * ";
        $query .= 'FROM '.self::T_FAULT;
        $query .= " WHERE ".self::T_FAULT.".".self::C_SLUG." = '".$slug."';";

        return (new self)->processQuery($query)->terms[0];

    }

    public static function getAllTerms(): self
    {
        // Perform database query
        $query = "SELECT * ";
        $query .= 'FROM '.self::T_FAULT;

        return (new self)->processQuery($query);
    }
}