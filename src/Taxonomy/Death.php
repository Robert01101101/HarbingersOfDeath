<?php


namespace Taxonomy\Death;

use Entity\Omen\OmenCollection;
use Taxonomy\Taxonomy;


class Death extends Taxonomy
{

    public function __construct()
    {
        return $this;
    }

    public function getOmensByTaxonomy($taxonomy)
    {
        $omens = array();
        foreach (OmenCollection::getOmens() as $omen) {
            if ($omen->getFault()->getId() == $taxonomy->getId()) {
                $omens[] = $omen;
            }
        }
        return $omens;
    }


}