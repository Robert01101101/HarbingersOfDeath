<?php


namespace Taxonomy;

use Entity\Omen\Omen;
use Entity\Omen\OmenCollection;
use Taxonomy\Term;


class Death extends Term
{

    public function __construct()
    {
        return $this;
    }

    public function filterOmensByTaxonomy(?OmenCollection $omensCollection)
    {
        echo "filterOmensByTaxonomy - Death<br>";

        if (!isset($omensCollection) && (is_null($omensCollection) || !is_a($omensCollection, 'Entity\Omen\OmenCollection'))){
            $omensCollection = new OmenCollection();
        }

        $omens = $omensCollection->getOmens();

        $filteredOmens = [];

        foreach ($omens as $omen) {
            if ($omen->getDeath()->getSlug() == $this->slug) {
                $filteredOmens[] = $omen;
            }
        }

        $omensCollection->setOmens($filteredOmens);
        return $omensCollection;
    }


}