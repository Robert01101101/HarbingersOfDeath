<?php


namespace Taxonomy;


use Taxonomy\Term;

abstract class Taxonomy
{

    protected array $termArray;

    protected array $terms = array();

    protected PDO $connection;

    public function __construct()
    {
        // TODO: set up PDO connection
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