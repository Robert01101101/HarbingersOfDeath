<?php


namespace Taxonomy\Fault;

use Entity\Omen\OmenCollection;

class FaultCollection
{
    private $faults = array();

    private $faultArray = [
        [
            "slug" => "you",
            "title" => "You"
        ],
        [
            "slug" => "god",
            "title" => "God"
        ],
        [
            "slug" => "the-public",
            "title" => "The Public"
        ]

    ];

    public function __construct()
    {
        foreach ($this->faultArray as $individualFault) {
            $this->createFault($individualFault["slug"], $individualFault["title"]);
        }
    }

    /**
     * @param $slug
     * @param $title
     *
     * Creates a new Fault and adds it to the faults array
     */
    public function createFault($slug, $title){
        $this->faults[] = (new Fault())
            ->setId(count($this->faults))
            ->setSlug($slug)
            ->setTitle($title);
    }

    /**
     * @return array
     */
    public function getFaults(): array
    {
        return $this->faults;
    }

    /**
     * @param string $slug
     * @return Fault
     *
     * This returns a Fault object based on a slug passed to it
     *
     * TODO: error handling
     */
    public static function getFaultBySlug(string $slug): Fault
    {
        foreach ((new self)->faults as $fault){
            if ($fault->getSlug() == $slug) return $fault;
        }
    }
}