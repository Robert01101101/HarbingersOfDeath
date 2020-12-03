<?php


namespace Taxonomy;

use Entity\Omen\OmenCollection;
use Taxonomy\Term;

class AspectTaxonomy extends Taxonomy
{


    /**
     * @param $slug
     * @param $title
     *
     * Creates a new Taxonomony and adds it to the taxonomies array
     */
    public function createTerm($slug, $title) : Aspect
    {
        return (new Aspect())
            ->setId(count($this->terms))
            ->setSlug($slug)
            ->setTitle($title);
    }

    //TODO: @Sam - confirm whether this change is okay. Original code is commented out
    public function addTerm(Term $aspect): array//Aspect $aspect): array
    {
        $this->terms[] = $aspect;
        return $this->terms;
    }

    protected function processQuery($query) : self
    {
        $result = mysqli_query($this->connection, $query);

        //Print rows
        while($row = mysqli_fetch_array($result))
        {
            $item = (new Aspect())
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
     * @return Aspect
     *
     * This returns a Aspect object based on a slug passed to it
     *
     * TODO: error handling
     * TODO: move to parent class
     */
    public static function getTermBySlug(string $slug): Aspect
    {
        // Perform database query
        $query = "SELECT * ";
        $query .= 'FROM '.self::T_ASPECT;
        $query .= " WHERE ".self::T_ASPECT.".".self::C_SLUG." = '".$slug."';";

        return (new self)->processQuery($query)->terms[0];
    }

    public static function getAllTerms(): self
    {
        // Perform database query
        $query = "SELECT * ";
        $query .= 'FROM '.self::T_ASPECT;

        return (new self)->processQuery($query);
    }
}