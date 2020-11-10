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
        retun (new Fault())
            ->setId(count($this->terms))
            ->setSlug($slug)
            ->setTitle($title);
    }

    public function addTerm(Fault $fault) : array
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
        // should use "(new self)" which will call the constructor
        // (which sets up the db connection)
        // don't forget to close the database connection "$this->connection = null"
        // return an array of Term objects
    }

    public function getTerms(): array
    {
        //TODO: database query
        // don't forget to close the database connection "$this->connection = null"
        // return an array of Term objects
    }


}