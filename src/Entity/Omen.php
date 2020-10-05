<?php

namespace Entity\Omen;

use Util\HTML\Tags;
use Taxonomy\Fault\Fault;
use Taxonomy\Aspect\Aspect;
use Taxonomy\Death\Death;
class Omen
{
    protected $id;
    protected $slug;
    protected $title;
    protected Fault $fault;
    protected Aspect $aspect;
    protected Death $death;

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
    public function setFault(Fault $fault)
    {
        $this->fault = $fault;
        return $this;
    }

    /**
     * @return Aspect
     */
    public function getAspect() : Aspect
    {
        return $this->aspect;
    }

    /**
     * @param Aspect $aspect
     * @return Omen
     */
    public function setAspect(Aspect $aspect) : Omen
    {
        $this->aspect = $aspect;
        return $this;
    }

    /**
     * @return Death
     */
    public function getDeath() : Death
    {
        return $this->death;
    }

    /**
     * @param Death $death
     * @return Omen
     */
    public function setDeath(Death $death) : Omen
    {
        $this->death = $death;
        return $this;
    }

    /**
     * @return string
     *
     * TODO: Move to a View/Template class.
     * Creates the sentence with itallics span for omen tile
     */
    public function generateSemanticDeath(){
       // $formattedDeath = Tags::tag('span', strtolower($this->death->getTitle()), ['class' => 'italics']);

        if ($this->death->getSlug() == "you"){
            $formattedDeath = Tags::tag('span', $this->death->getTitle(), ['class' => 'italics']);
            $semanticDeath = $formattedDeath . " will die.";

        } else {
            $formattedDeath = Tags::tag('span', strtolower($this->death->getTitle()), ['class' => 'italics']);
            $semanticDeath = "A " . $formattedDeath . " will die.";
        }

        return $semanticDeath;
    }

}
