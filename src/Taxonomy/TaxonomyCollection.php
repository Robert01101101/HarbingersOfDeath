<?php


namespace Taxonomy;


use Taxonomy\Fault\FaultCollection;

abstract class TaxonomyCollection
{

    protected $taxonomies = array();

    public abstract function createTaxonomy($slug, $title);

    /**
     * @return array
     */
    public function getTaxonomies(): array
    {
        return $this->taxonomies;
    }
}