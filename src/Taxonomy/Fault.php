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



    /* Deprecated (pre-Database) <---------------------------------------------
    public function filterOmensByTaxonomy(?OmenCollection $omensCollection)
    {
        echo ">>_______________________________>><br>";
        echo "CLASS: Fault   |   METHOD: filterOmensByTaxonomy(param)   |   MY SLUG: ".$this->slug."<br>";

        //var_dump($omensCollection);
        //echo "<br>";

        if (!isset($omensCollection) && (is_null($omensCollection) || !is_a($omensCollection, 'Entity\Omen\OmenCollection'))){
            $omensCollection = new OmenCollection();
        }

        $omens = $omensCollection->findAllOmens();

        //var_dump($omens);
        //echo "<br>";

        $filteredOmens = [];

        foreach ($omens as $omen) {
            if ($omen->getFault()->getSlug() == $this->slug) {
                $filteredOmens[] = $omen;
                //echo "Hit: Omen".$omen->getSlug()." matches, with fault: ".$omen->getFault()->getSlug()."<br>";
            }
        }

        

        $omensCollection->setOmens($filteredOmens);

        //var_dump($filteredOmens);
        foreach ($omensCollection->getOmens() as $v) {
            echo $v->getSlug().'<br>';
        }
        echo "<<_______________________________<<<br>";
        return $omensCollection;
    }*/

}