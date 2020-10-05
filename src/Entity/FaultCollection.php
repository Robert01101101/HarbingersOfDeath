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
     */
    public static function getFaultBySlug(string $slug): Fault
    {
        foreach ((new self)->faults as $fault){
            if ($fault->getSlug() == $slug) return $fault;
        }
    }
}