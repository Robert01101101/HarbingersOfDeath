<?php


namespace Taxonomy;


use Entity\Omen\OmenCollection;

abstract class Term
{
    protected string $id;
    protected string $title;
    protected string $slug;
    protected bool $active = false;

    /**
     * @param mixed $title
     * @return Term
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    public abstract function filterOmensByTaxonomy(?OmenCollection $omens);

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
     * @return Term
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
     * @return Term
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     * @return Term
     */
    public function setActive(bool $active): Term
    {
        $this->active = $active;
        return $this;
    }


}