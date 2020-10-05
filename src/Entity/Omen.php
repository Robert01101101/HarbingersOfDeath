<?php

namespace Entity\Omen;

use Util\HTML\Tags;
use Taxonomy\Fault\Fault;
class Omen
{
    protected $id;
    protected $slug;
    protected $title;
    protected Fault $fault;
    protected $aspect;
    protected $death;

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
     * @return Omen
     */
    public function setId($id)
    {
        $this->id = $id;
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
     * @return Omen
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
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
     * @return Omen
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return Fault
     */
    public function getFault()
    {
        return $this->fault;
    }

    /**
     * @param Fault $fault
     * @return Omen
     */
    public function setFault($fault)
    {
        $this->fault = $fault;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAspect()
    {
        return $this->aspect;
    }

    /**
     * @param mixed $aspect
     * @return Omen
     */
    public function setAspect($aspect)
    {
        $this->aspect = $aspect;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDeath()
    {
        return $this->death;
    }

    /**
     * @param mixed $death
     * @return Omen
     */
    public function setDeath($death)
    {
        $this->death = $death;
        return $this;
    }

    /**
     * @return string
     *
     * TODO: Move to a View/Template class.
     */
    public function generateSemanticDeath(){
        $formattedDeath = Tags::tag('span', $this->death, ['class' => 'italics']);
        $semanticDeath = "A " . $formattedDeath . " will die";
        return $semanticDeath;
    }

}
