<?php

namespace Data\Omens;

use Entity\Omen\Omen;
class OmenArray
{
    private $omenArray = [
        [
            "slug" => "cracked-bread",
            "title" => "Have you baked bread, that has cracks upon its top?",
            "fault" => "you",
            "aspect" => "domestic life",
            "death" => "close friend"
        ],
        [
            "slug" => "ringing-ears",
            "title" => "Is there a ringing in your ears?",
            "fault" => "you",
            "aspect" => "health",
            "death" => "you"
        ]
    ];
    private $omens = array();

    public function __construct()
    {
        foreach ($this->omenArray as $index => $individualOmen) {
            $this->omens[$index] = (new Omen())
                ->setId($index)
                ->setSlug($individualOmen["slug"])
                ->setTitle($individualOmen["title"])
                ->setFault($individualOmen["fault"])
                ->setAspect($individualOmen["aspect"])
                ->setDeath($individualOmen["death"]);
        }
    }

    /**
     * @return array
     */
    public function getOmens()
    {
        return $this->omens;
    }


}

