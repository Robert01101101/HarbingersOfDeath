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
    public function addTerm(Term $aspect): array//Fault $fault) : array
    {
        $this->terms[] = $fault;
        return $this->terms;
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
        foreach ((new self)->loadArray()->terms as $taxonomy){
            if ($taxonomy->getSlug() == $slug) return $taxonomy;
        }
    }

    public static function getAllTerms(): array
    {
        //TODO: database query
        //SQL query
        // should use "(new self)" which will call the constructor
        // (which sets up the db connection)
        // don't forget to close the database connection "$this->connection = null"
        // return an array of Term objects
        
        //TODO: MOVE TO CONSTRUCTOR
        //new self();

        //TMP
        // Set up MySQLi connection
        // Code for connection is from Lab.
        // 1. Create a database connection
        $connection = mysqli_connect(self::DBHOST, self::DBUSER, self::DBPASS, self::DBNAME);

        // Test if connection succeeded
        if(mysqli_connect_errno()) {
        // if connection failed, skip the rest of PHP code, and print an error
        die("Database connection failed: " . 
             mysqli_connect_error() . 
             " (" . mysqli_connect_errno() . ")"
        );
        }

        // 2. Perform database query
        $query = "SELECT * ";

        $query .= 'FROM '.self::T_FAULT;

        $result = mysqli_query($connection, $query);

        // 3. Use returned data
        //Print querie
        //echo $query;
        //prepare array
        $output = array();
        //Print rows
        while($row = mysqli_fetch_array($result))
        {
            //print_r($row);

            $item = (new Fault())
            ->setId($row[0])
            ->setSlug($row[1])
            ->setTitle($row[2]);

            array_push($output, $item);
        }



        // 4. Release returned data
        mysqli_free_result($result);
  
        // 5. Close database connection
        mysqli_close($connection);

        return $output;
    }

    public function getTerms(): array
    {
        //TODO: database query
        //SQL query
        // don't forget to close the database connection "$this->connection = null"
        // return an array of Term objects

        return self::getAllTerms();
    }


}