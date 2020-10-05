<?php

namespace Entity\Omen;

use Entity\Omen\Omen;

class OmenCollection
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
        foreach ($this->omenArray as $individualOmen) {
            $this->createOmen($individualOmen["slug"], $individualOmen["title"],$individualOmen["fault"],$individualOmen["aspect"],$individualOmen["death"]);

        }
    }

    public function createOmen($slug, $title, $fault, $aspect, $death){
        $this->omens[] = (new Omen())
            ->setId(count($this->omens))
            ->setSlug($slug)
            ->setTitle($title)
            ->setFault($fault)
            ->setAspect($aspect)
            ->setDeath($death);
    }

    /**
     * @return array
     */
    public function getOmens()
    {
        return $this->omens;
    }


}

