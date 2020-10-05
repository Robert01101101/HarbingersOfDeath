<?php


namespace Taxonomy\Aspect;

use Entity\Omen\OmenCollection;
use Taxonomy\Taxonomy;


class Aspect extends Taxonomy
{

    public function __construct()
    {
        return $this;
    }

    public function getOmensByTaxonomy($taxonomy)
    {
        $omens = array();
        foreach (OmenCollection::getOmens() as $omen) {
            if ($omen->getAspect()->getId() == $taxonomy->getId()) {
                $omens[] = $omen;
            }
        }
        return $omens;
    }


}