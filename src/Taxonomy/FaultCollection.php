<?php


namespace Taxonomy\Fault;

use Entity\Omen\OmenCollection;
use Taxonomy\Aspect\Aspect;
use Taxonomy\TaxonomyCollection;

class FaultCollection extends TaxonomyCollection
{

    private $faultArray = [
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

    public function __construct()
    {
        foreach ($this->faultArray as $individualFault) {
            $this->createTaxonomy($individualFault["slug"], $individualFault["title"]);
        }
    }

    /**
     * @param $slug
     * @param $title
     *
     * Creates a new Taxonomony and adds it to the taxonomies array
     */
    public function createTaxonomy($slug, $title){
        $this->taxonomies[] = (new Fault())
            ->setId(count($this->taxonomies))
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
    public static function getTaxonomyBySlug(string $slug): Fault
    {
        foreach ((new self)->taxonomies as $taxonomy){
            if ($taxonomy->getSlug() == $slug) return $taxonomy;
        }
    }

    public static function getTaxonomies(): array
    {
        return (new self)->taxonomies;
    }
}