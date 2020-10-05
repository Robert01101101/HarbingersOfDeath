<?php


namespace Entity\Fault;

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
            "slug" => "nature",
            "title" => "Nature"
        ],
        [
            "slug" => "the-community",
            "title" => "The Community"
        ]

    ];

    public function __construct()
    {
        foreach ($this->faultArray as $individualFault) {
            $this->createFault($individualFault["slug"], $individualFault["title"]);
        }
    }

    public function createFault($slug, $title){
        $this->faults[] = (new Omen())
            ->setId(count($this->omens))
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
}