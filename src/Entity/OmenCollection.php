<?php

namespace Entity\Omen;

use Entity\Omen\Omen;
use Taxonomy\Aspect\AspectCollection;
use Taxonomy\Death\DeathCollection;
use Taxonomy\Fault\FaultCollection;

class OmenCollection
{
    private $omenArray = [
        [
            "slug" => "cracked-bread",
            "title" => "Have you baked bread, that has cracks upon its top?",
            "fault" => "you",
            "aspect" => "domestic-life",
            "death" => "close-friend"
        ],
        [
            "slug" => "ringing-ears",
            "title" => "Is there a ringing in your ears?",
            "fault" => "you",
            "aspect" => "vitality",
            "death" => "you"
        ],
        [
            "slug" => "lighted-carptenters-shop",
            "title" => "Has a light suddenly and unaccountably been seen in a carpenter’s shop?",
            "fault" => "the-public",
            "aspect" => "industry",
            "death" => "community-member"
        ],
        [
            "slug" => "umbrella",
            "title" => "Have you opened an umbrella in your house?",
            "fault" => "you",
            "aspect" => "domestic-life",
            "death" => "community-member"
        ],
        [
            "slug" => "bell-ringing",
            "title" => "Has a bell rung of its own accord?",
            "fault" => "god",
            "aspect" => "religion",
            "death" => "community-member"
        ],
        [
            "slug" => "funeral-procession",
            "title" => "Did anyone arrive at the funeral, after the procession had begun?",
            "fault" => "the-public",
            "aspect" => "death",
            "death" => "community-member"
        ],
        [
            "slug" => "hair-pin",
            "title" => "Has a hairpin fallen from your hair?",
            "fault" => "you",
            "aspect" => "domestic-life",
            "death" => "you"
        ],
        [
            "slug" => "funeral-procession",
            "title" => "Did anyone arrive at the funeral, after the procession had begun?",
            "fault" => "the-public",
            "aspect" => "death",
            "death" => "community-member"
        ],



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
            ->setFault(FaultCollection::getTaxonomyBySlug($fault))
            ->setAspect(AspectCollection::getTaxonomyBySlug($aspect))
            ->setDeath(DeathCollection::getTaxonomyBySlug($death));
    }

    /**
     * @return array
     */
    public static function getOmens()
    {
        return (new self)->omens;
    }


    public static function getOmenBySlug(string $slug) : Omen
    {
        foreach ((new self)->omens as $omen){
            if ($omen->getSlug() == $slug) return $omen;
        }
    }


}

