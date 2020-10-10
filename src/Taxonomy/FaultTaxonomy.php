<?php


namespace Taxonomy;

use Entity\Omen\OmenCollection;
use Taxonomy\Aspect;
use Taxonomy\Taxonomy;
use Taxonomy\Term;

class FaultTaxonomy extends Taxonomy
{


    public function __construct(bool $loadTermArray = FALSE)
    {
        /*
        *   THIS IS THE TEMPORARY DATA AS AN ARRAY
        *   AND IT IS LOADED INTO THE COLLECTION
        */
        $this->termArray = [
            [
                "slug" => "you",
                "title" => "You"
            ],
            [
                "slug" => "god",
                "title" => "God"
            ],
            [
                "slug" => "the-public",
                "title" => "The Public"
            ]

        ];

        if ($loadTermArray === TRUE){
            $this->loadArray();
        }
    }





    /**
     * @param $slug
     * @param $title
     *
     * Creates a new Taxonomony and adds it to the taxonomies array
     */
    public function createTerm($slug, $title){
        $this->terms[] = (new Fault())
            ->setId(count($this->terms))
            ->setSlug($slug)
            ->setTitle($title);
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
        return (new self)->loadArray()->terms;
    }
//    public function getTaxonomies(): array
//    {
//        return $this->loadArray()->taxonomies;
//    }
}