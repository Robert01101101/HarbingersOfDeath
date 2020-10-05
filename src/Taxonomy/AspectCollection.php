<?php


namespace Taxonomy\Aspect;

use Entity\Omen\OmenCollection;
use Taxonomy\TaxonomyCollection;

class AspectCollection extends TaxonomyCollection
{

    private $aspectArray = [
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

    public function __construct()
    {
        foreach ($this->aspectArray as $individualAspect) {
            $this->createTaxonomy($individualAspect["slug"], $individualAspect["title"]);
        }
    }

    /**
     * @param $slug
     * @param $title
     *
     * Creates a new Taxonomony and adds it to the taxonomies array
     */
    public function createTaxonomy($slug, $title){
        $this->taxonomies[] = (new Aspect())
            ->setId(count($this->taxonomies))
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
    public static function getTaxonomyBySlug(string $slug): Aspect
    {
        foreach ((new self)->taxonomies as $taxonomy){
            if ($taxonomy->getSlug() == $slug) return $taxonomy;
        }
    }
}