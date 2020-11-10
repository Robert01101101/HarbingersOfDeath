<?php

namespace Entity\Omen;

use Entity\Omen\Omen;
use Taxonomy\AspectTaxonomy;
use Taxonomy\DeathTaxonomy;
use Taxonomy\Fault;
use Taxonomy\FaultTaxonomy;

class OmenCollection
{
//    private $omenArray = [
//        [
//            "slug" => "cracked-bread",
//            "title" => "Have you baked bread, that has cracks upon its top?",
//            "fault" => "you",
//            "aspect" => "domestic-life",
//            "death" => "close-friend"
//        ],
//        [
//            "slug" => "ringing-ears",
//            "title" => "Is there a ringing in your ears?",
//            "fault" => "you",
//            "aspect" => "vitality",
//            "death" => "you"
//        ],
//        [
//            "slug" => "lighted-carptenters-shop",
//            "title" => "Has a light suddenly and unaccountably been seen in a carpenter’s shop?",
//            "fault" => "the-public",
//            "aspect" => "industry",
//            "death" => "community-member"
//        ],
//        [
//            "slug" => "umbrella",
//            "title" => "Have you opened an umbrella in your house?",
//            "fault" => "you",
//            "aspect" => "domestic-life",
//            "death" => "community-member"
//        ],
//        [
//            "slug" => "bell-ringing",
//            "title" => "Has a bell rung of its own accord?",
//            "fault" => "god",
//            "aspect" => "religion",
//            "death" => "community-member"
//        ],
//        [
//            "slug" => "funeral-procession",
//            "title" => "Did anyone arrive at the funeral, after the procession had begun?",
//            "fault" => "the-public",
//            "aspect" => "death",
//            "death" => "community-member"
//        ],
//        [
//            "slug" => "hair-pin",
//            "title" => "Has a hairpin fallen from your hair?",
//            "fault" => "you",
//            "aspect" => "domestic-life",
//            "death" => "you"
//        ],
//        [
//            "slug" => "funeral-procession",
//            "title" => "Did anyone arrive at the funeral, after the procession had begun?",
//            "fault" => "the-public",
//            "aspect" => "death",
//            "death" => "community-member"
//        ]
//    ];

    private $omens = array();

    private PDO $connection;

    public function __construct()
    {
        // TODO: set up PDO connection
    }


    /**
     * Creates new Omen based on parameters and adds it to this OmenCollection
     *
     * @param $slug
     * @param $title
     * @param $fault
     * @param $aspect
     * @param $death
     */

    private function createOmen(string $slug, sting $title, Fault $fault, Aspect $aspect, Death $death){
        return (new Omen($slug, $title))
            ->setFault($fault)
            ->setAspect($aspect)
            ->setDeath($death);
    }

    /**
     * Add an Omen to this OmenCollection
     * @param \Entity\Omen\Omen $omen
     */
    public function addOmen(Omen $omen){
        if(isset($omen)){
            $this->omens[] = $omen;
        }
    }

    public function getOmens() : array
    {
        return $this->omens;
    }


    public function setOmens(array $omens) : self
    {
        $this->omens = $omens;
        return $this;
    }


    /*
     * MAYBE USE seperate function for the database calls
     * I don't know yet if I will need the same methods
     * in a non-static form.. so to avoid duplication of code
     * it might be good of it to be a wrapper
     *
     * <3
     */


    /**
     * @return array
     */
    public static function findAllOmens()
    {
        //TODO: database query
        // should use "(new self)" which will call the constructor
        // (which sets up the db connection)
        // don't forget to close the database connection "$this->connection = null"
        // return an array of Omen object


        return (new self)->omens;
    }

    /**
     * @return array
     */
    public static function findOmensByFilter(Fault $fault, Aspect $aspect, Death $death)
    {
        //TODO: database query
        // should use "(new self)" which will call the constructor
        // (which sets up the db connection)
        // don't forget to close the database connection "$this->connection = null"
        // return an array of Omen object

        if(isset($fault) && !is_null($fault)){

        }
        if(isset($aspect) && !is_null($aspect)){

        }
        if(isset($death) && !is_null($death)){

        }
    }

    /**
     * @return Omen
     */
    public static function findOmenBySlug(string $slug) : Omen
    {
        //TODO: this should be a query
        // should use "(new self)" which will call the constructor
        // (which sets up the db connection)
        // don't forget to close the database connection "$this->connection = null"
        // needs to do an inner join with the taxonomies
        // and then build them as objects
        // return a single Omen object (Error handling to make sure the result returned is a single item)

    }




}

