<?php


namespace Taxonomy;

use Entity\Omen\OmenCollection;
use Entity\Omen\Omen;
use Taxonomy\Term;


class Fault extends Term
{

    public function __construct()
    {
        return $this;
    }

    public function filterOmensByTaxonomy(?OmenCollection $omensCollection)
    {

        if (!isset($omensCollection) && (is_null($omensCollection) || !is_a($omensCollection, 'Entity\Omen\OmenCollection'))){
            $omensCollection = new OmenCollection();
        }

        $omens = $omensCollection->getOmenList();

        $filteredOmens = [];

        foreach ($omens as $omen) {
            if ($omen->getFault()->getSlug() == $this->slug) {
                $filteredOmens[] = $omen;
            }
        }

        $omensCollection->setOmens($filteredOmens);
        return $omensCollection;
    }


}