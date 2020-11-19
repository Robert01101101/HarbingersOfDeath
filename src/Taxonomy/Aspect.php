<?php


namespace Taxonomy;

use Entity\Omen\OmenCollection;
use Taxonomy\Term;


class Aspect extends Term
{

    public function __construct()
    {
        return $this;
    }

    /* Deprecated (pre-Database) <---------------------------------------------
    public function filterOmensByTaxonomy(?OmenCollection $omensCollection)
    {
        echo "filterOmensByTaxonomy - Aspect<br>";

        if (!is_null($omensCollection)){
            $omensCollection = new OmenCollection();
        }

        $omens = $omensCollection->getOmens();

        $filteredOmens = [];

        foreach ($omens as $omen) {
            if ($omen->getAspect()->getSlug() == $this->slug) {
                $filteredOmens[] = $omen;
            }
        }

        $omensCollection->setOmens($filteredOmens);
        return $omensCollection;
    }*/


}