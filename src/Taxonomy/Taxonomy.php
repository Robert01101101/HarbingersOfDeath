<?php


namespace Taxonomy;


use Entity\Omen\OmenCollection;

abstract class Taxonomy
{
    protected $id;
    protected $title;
    protected $slug;

    /**
     * @param mixed $title
     * @return Taxonomy
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    public abstract function getOmensByTaxonomy($taxonomy);

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $slug
     * @return Taxonomy
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
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
     * @param mixed $id
     * @return Taxonomy
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
}