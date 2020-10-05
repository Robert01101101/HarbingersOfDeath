<?php


namespace Entity\Fault;

use Entity\Omen\OmenCollection;


class Fault
{
    private $id;
    private $title;
    private $slug;

    public function __construct()
    {
        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Fault
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     * @return Fault
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param mixed $slug
     * @return Fault
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
        return $this;
    }


    public function getOmensByFault(){
        $omens = array();
        foreach (OmenCollection::getOmens() as $omen){

        }
        return $omens;
    }

}