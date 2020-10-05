<?php


namespace Taxonomy\Death;

use Entity\Omen\OmenCollection;
use Taxonomy\TaxonomyCollection;

class DeathCollection extends TaxonomyCollection
{

    private $deathArray = [
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

    public function __construct()
    {
        foreach ($this->deathArray as $individualDeath) {
            $this->createTaxonomy($individualDeath["slug"], $individualDeath["title"]);
        }
    }

    /**
     * @param $slug
     * @param $title
     *
     * Creates a new Taxonomony and adds it to the taxonomies array
     */
    public function createTaxonomy($slug, $title){
        $this->taxonomies[] = (new Death())
            ->setId(count($this->taxonomies))
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
    public static function getTaxonomyBySlug(string $slug): Death
    {
        foreach ((new self)->taxonomies as $taxonomy){
            if ($taxonomy->getSlug() == $slug) return $taxonomy;
        }
    }
}