<?php


namespace Taxonomy;


use Taxonomy\Fault\FaultCollection;

abstract class TaxonomyCollection
{

    protected $taxonomies = array();

    public abstract function createTaxonomy($slug, $title);

    /**
     * @return array
     * // work out how to use/workaround "(new self)" in abstract class
     */
    public abstract static function getTaxonomies(): array;
}