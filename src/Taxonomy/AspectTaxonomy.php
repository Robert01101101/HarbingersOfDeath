<?php


namespace Taxonomy;

use Entity\Omen\OmenCollection;
use Taxonomy\Term;

class AspectTaxonomy extends Taxonomy
{


    public function __construct(bool $loadTermArray = FALSE)
    {
        /*
        *   THIS IS THE TEMPORARY DATA AS AN ARRAY
        *   AND IT IS LOADED INTO THE COLLECTION
        */
        $this->termArray = [
            [
                "slug" => "domestic-life",
                "title" => "Domestic Life"
            ],
            [
                "slug" => "vitality",
                "title" => "Vitality"
            ],
            [
                "slug" => "industry",
                "title" => "Industry"
            ],
            [
                "slug" => "religion",
                "title" => "Religion"
            ],
            [
                "slug" => "death",
                "title" => "Death"
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
        $this->terms[] = (new Aspect())
            ->setId(count($this->terms))
            ->setSlug($slug)
            ->setTitle($title);
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
        foreach ((new self)->loadArray()->terms as $taxonomy){
            if ($taxonomy->getSlug() == $slug) return $taxonomy;
        }
    }

    public static function getAllTerms(): array
    {
        return (new self)->loadArray()->terms;
    }
}