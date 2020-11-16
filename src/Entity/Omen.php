<?php

namespace Entity\Omen;

use Util\HTML\Tags;
use Taxonomy\Fault;
use Taxonomy\Aspect;
use Taxonomy\Death;
class Omen
{
    protected $id;
    protected $slug;
    protected $title;
    protected $imagePath;
    protected Fault $fault;
    protected Aspect $aspect;
    protected Death $death;
    private string $path;
    private string $poem;
    private string $poemAuthor;
    private string $statement;
    private string $imageAuthor;
    private bool $experience = false;

    public function __construct($slug, $title)
    {
        $this->$slug = $slug;
        $this->$title = $title;
        return $this;
        //TODO: fix - the params aren't working for some reason (in OmenCollection/getOmenBySlug())
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
        // TODO: ENSURE the slug & PATH are set
        // TODO: make this more precise
        $this->path = '/omen/' . $this->slug;
        return $this;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
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
     * @return mixed
     */
    public function getImage() : string
    {
        return $this->imagePath;
    }

    /**
     * @param mixed $id
     * @return Omen
     */
    public function setImage($imagePath)
    {
        $this->imagePath = $imagePath;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getImageAuthor() : string
    {
        return $this->imageAuthor;
    }

    /**
     * @param mixed $id
     * @return Omen
     */
    public function setImageAuthor($imageAuthor)
    {
        $this->imageAuthor = $imageAuthor;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPoem() : string
    {
        return $this->poem;
    }

    /**
     * @param mixed $id
     * @return Omen
     */
    public function setPoem($poem)
    {
        $this->poem = $poem;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPoemAuthor() : string
    {
        return $this->poemAuthor;
    }

    /**
     * @param mixed $id
     * @return Omen
     */
    public function setPoemAuthor($poemAuthor)
    {
        $this->poemAuthor = $poemAuthor;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatement() : string
    {
        return $this->statement;
    }

    /**
     * @param mixed $id
     * @return Omen
     */
    public function setStatement($statement)
    {
        $this->statement = $statement;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserExperience() : bool
    {
        return $this->experience;
    }

    /**
     * @param mixed $id
     * @return Omen
     */
    public function setUserExperience($experience)
    {
        $this->experience = $experience;
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
