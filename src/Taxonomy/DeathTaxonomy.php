<?php


namespace Taxonomy;

use Entity\Omen\OmenCollection;
use Taxonomy\Taxonomy;
use Taxonomy\Term;

class DeathTaxonomy extends Taxonomy
{



    public function __construct(bool $loadTermArray = FALSE)
    {
        /*
        *   THIS IS THE TEMPORARY DATA AS AN ARRAY
        *   AND IT IS LOADED INTO THE COLLECTION
        */
        $this->termArray = [
            [
                "slug" => "close-friend",
                "title" => "Close Friend"
            ],
            [
                "slug" => "you",
                "title" => "You"
            ],
            [
                "slug" => "community-member",
                "title" => "Community Member"
            ],
            [
                "slug" => "family-member",
                "title" => "Family Member"
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
        $this->terms[] = (new Death())
            ->setId(count($this->terms))
            ->setSlug($slug)
            ->setTitle($title);
    }

    /**
     * @param string $slug
     * @return Death
     *
     * This returns a Aspect object based on a slug passed to it
     *
     * TODO: error handling
     * TODO: move to parent class
     */
    public static function getTermBySlug(string $slug): Death
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