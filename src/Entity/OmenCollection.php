<?php

namespace Entity\Omen;

use Entity\Omen\Omen;
use Taxonomy\Aspect;
use Taxonomy\AspectTaxonomy;
use Taxonomy\Death;
use Taxonomy\DeathTaxonomy;
use Taxonomy\Fault;
use Taxonomy\FaultTaxonomy;
use User\User;
use View\JSON;

class OmenCollection
{
    private $omens = array();

    protected $connection;
    protected $query;

    //Connection Variables
    const DBHOST = "localhost";
    const DBUSER = "root";
    const DBPASS = "";
    const DBNAME = "robert_michels";

    //Table Names
    const T_ADDRESS = "address";
    const T_ASPECT = "aspect";
    const T_DEATH = "death";
    const T_FAULT = "fault";
    const T_OMEN = "omen";
    const T_USER = "user";
    const T_USER_OMEN = "user_omen";

    //Column Names
    const C_ID = "omen_id";
    const C_SLUG = "slug";
    const C_TITLE = "title";
    const C_IMAGE = "image_path";
    const C_ASPECT = "aspect_id";
    const C_DEATH = "death_id";
    const C_FAULT = "fault_id";
    const C_TERM = "term_id";

    public function __construct()
    {
        // Create a database connection
        $this->connection = mysqli_connect(self::DBHOST, self::DBUSER, self::DBPASS, self::DBNAME);

        // Test if connection succeeded
        if(mysqli_connect_errno()) {
            // if connection failed, skip the rest of PHP code, and print an error
            die("Database connection failed: " . mysqli_connect_error() . " (" . mysqli_connect_errno() . ")" );
        }
    }


    private function processQuery($query) : self
    {
        $result = mysqli_query($this->connection, $query);

        //Print rows
        while($row = mysqli_fetch_array($result)) {
            array_push($this->omens, self::buildOmenFromData($row));
        }

        // Release returned data
        mysqli_free_result($result);

        // Close database connection
        mysqli_close($this->connection);

        // Return self for chaining
        return $this;
    }


    /**
     * Creates new Omen based on parameters and adds it to this OmenCollection
     *
     * @param $slug
     * @param $title
     * @param $fault
     * @param $aspect
     * @param $death
     * @return \Entity\Omen\Omen
     */
    private function createOmen(string $slug, sting $title, Fault $fault, Aspect $aspect, Death $death) : Omen
    {
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

    public function setStatements(OmenCollection $userOmens) : self
    {
        // get the array of Omens from the userOmens OmenCollection
        $userOmens = $userOmens->getOmens();
        // loop through the userOmen array
        foreach ($userOmens as $userOmen) {
            // loop through this omen array
            foreach ($this->omens as $omen) {
                // if the omens match, set the UserExperience to TRUE
                if ($omen->getID() == $userOmen->getID()) $omen->setUserExperience(TRUE);
            }
        }

        // return self
        return $this;
    }


    /**
     * @return array
     */
    public static function findAllOmens()
    {
        //Select all from the table that is created by performing inner joins. Tables joined: omen, aspect, death & fault.
        $query = "SELECT * FROM";
        //Join omen with aspect
        $query .= " (((".self::T_OMEN." INNER JOIN ".self::T_ASPECT." ON ".self::T_OMEN.".".self::C_ASPECT." = ".self::T_ASPECT.".".self::C_TERM.")";
        //Join result with death
        $query .= " INNER JOIN ".self::T_DEATH." ON ".self::T_OMEN.".".self::C_DEATH." = ".self::T_DEATH.".".self::C_TERM.")";
        //Join result with fault
        $query .= " INNER JOIN ".self::T_FAULT." ON ".self::T_OMEN.".".self::C_FAULT." = ".self::T_FAULT.".".self::C_TERM.")";

        return (new self)->processQuery($query);
    }


    /**
     * @return array
     */
    public static function findSomeOmens() : OmenCollection
    {

        //Select all from the table that is created by performing inner joins. Tables joined: omen, aspect, death & fault.
        $query = "SELECT * FROM";
        //Join omen with aspect
        $query .= " (((".self::T_OMEN." INNER JOIN ".self::T_ASPECT." ON ".self::T_OMEN.".".self::C_ASPECT." = ".self::T_ASPECT.".".self::C_TERM.")";
        //Join result with death
        $query .= " INNER JOIN ".self::T_DEATH." ON ".self::T_OMEN.".".self::C_DEATH." = ".self::T_DEATH.".".self::C_TERM.")";
        //Join result with fault
        $query .= " INNER JOIN ".self::T_FAULT." ON ".self::T_OMEN.".".self::C_FAULT." = ".self::T_FAULT.".".self::C_TERM.")";


        return (new self)->processQuery($query);

    }


    public function generateJSON() : string
    {
        $omenArray = [];
        for ($i = 0; $i < count($this->omens); $i++){
            $omen = $this->omens[$i];
            $omenArray[$i]["slug"] = $omen->getSlug();

            // if user has experienced omen, use statement instead of title
            if ($omen->isExperience()){
                $omenArray[$i]["title"] = $omen->getStatement();
            } else {
                $omenArray[$i]["title"] = $omen->getTitle();
            }
            $omenArray[$i]["path"] = $omen->getPath();
            $omenArray[$i]["semanticDeath"] = $omen->generateSemanticDeath();
            $omenArray[$i]["aspectTitle"] = $omen->getAspect()->getTitle();
            $omenArray[$i]["deathTitle"] = $omen->getDeath()->getTitle();
            $omenArray[$i]["faultTitle"] = $omen->getFault()->getTitle();
            $omenArray[$i]["aspectSlug"] = $omen->getAspect()->getSlug();
            $omenArray[$i]["deathSlug"] = $omen->getDeath()->getSlug();
            $omenArray[$i]["faultSlug"] = $omen->getFault()->getSlug();
        }

        return json_encode($omenArray);
    }


    public static function findOmensBySearch(string $string){

        //Select all from the table that is created by performing inner joins. Tables joined: omen, aspect, death & fault.
        $query = "SELECT * FROM";
        //Join omen with aspect
        $query .= " (((".self::T_OMEN." INNER JOIN ".self::T_ASPECT." ON ".self::T_OMEN.".".self::C_ASPECT." = ".self::T_ASPECT.".".self::C_TERM.")";
        //Join result with death
        $query .= " INNER JOIN ".self::T_DEATH." ON ".self::T_OMEN.".".self::C_DEATH." = ".self::T_DEATH.".".self::C_TERM.")";
        //Join result with fault
        $query .= " INNER JOIN ".self::T_FAULT." ON ".self::T_OMEN.".".self::C_FAULT." = ".self::T_FAULT.".".self::C_TERM.")";
        //Pick a number of random records ***
        $query .= " ORDER BY RAND() LIMIT 6;";

        return (new self)->processQuery($query);
    }

    /**
     * @return array
     */
    public static function findOmensByFilter(array $search) : OmenCollection //(Fault $fault, Aspect $aspect, Death $death) : array
    {
        //Select all from the table that is created by performing inner joins. Tables joined: omen, aspect, death & fault.
        $query = "SELECT * FROM";
        //Join omen with aspect
        $query .= " (((".self::T_OMEN." INNER JOIN ".self::T_ASPECT." ON ".self::T_OMEN.".".self::C_ASPECT." = ".self::T_ASPECT.".".self::C_TERM.")";
        //Join result with death
        $query .= " INNER JOIN ".self::T_DEATH." ON ".self::T_OMEN.".".self::C_DEATH." = ".self::T_DEATH.".".self::C_TERM.")";
        //Join result with fault
        $query .= " INNER JOIN ".self::T_FAULT." ON ".self::T_OMEN.".".self::C_FAULT." = ".self::T_FAULT.".".self::C_TERM.")";

        // TODO: update so it works for multiple values (update: not required since that's handled by Ajax?)

        $searchKeys = array_keys($search);
        $i = 0;

        foreach ($searchKeys as $key) {
            $value = $search[$key];

            if ($i < 1) {
                $query .= " WHERE ";
            } else {
                $query .= " AND ";
            }
            if(strcmp($key, "fault") == 0){
                //Filter result by fault
                $query .= self::T_FAULT.".".self::C_SLUG." = '".$value."'";
            }
            if(strcmp($key, "aspect") == 0){
                //Filter result by aspect
                $query .= self::T_ASPECT.".".self::C_SLUG." = '".$value."'";
            }
            if(strcmp($key, "death") == 0){
                //Filter result by death
                $query .= self::T_DEATH.".".self::C_SLUG." = '".$value."'";
            }

            $i++;
        }
        $query .= ";";

        return (new self)->processQuery($query);
    }

    public static function isOmenUserSelected(Omen $omen, User $user) : bool
    {
        $query = "SELECT * FROM `user_omen` WHERE user_omen.user_id = '".$user->getID()."' AND user_omen.omen_id = '".$omen->getSlug()."';";

        // return true if the query returns anything, false if it does not.
        return ((new self)->processQuery($query)->getOmens()) <= 0;
    }


    /**
     * @return Omen
     */
    public static function getOmenBySlug(string $slug) : Omen
    {
        //Select all from the table that is created by performing inner joins. Tables joined: omen, aspect, death & fault.
        $query = "SELECT * FROM";
        //Join omen with aspect
        $query .= " (((".self::T_OMEN." INNER JOIN ".self::T_ASPECT." ON ".self::T_OMEN.".".self::C_ASPECT." = ".self::T_ASPECT.".".self::C_TERM.")";
        //Join result with death
        $query .= " INNER JOIN ".self::T_DEATH." ON ".self::T_OMEN.".".self::C_DEATH." = ".self::T_DEATH.".".self::C_TERM.")";
        //Join result with fault
        $query .= " INNER JOIN ".self::T_FAULT." ON ".self::T_OMEN.".".self::C_FAULT." = ".self::T_FAULT.".".self::C_TERM.")";
        //Filter result by omen slug
        $query .= " WHERE ".self::T_OMEN.".".self::C_SLUG." = '".$slug."';";

        return (new self)->processQuery($query)->getOmens()[0];
    }


    /**
     * @return Omen
     */
    public static function getOmenById(int $id) : Omen
    {
        //Select all from the table that is created by performing inner joins. Tables joined: omen, aspect, death & fault.
        $query = "SELECT * FROM";
        //Join omen with aspect
        $query .= " (((".self::T_OMEN." INNER JOIN ".self::T_ASPECT." ON ".self::T_OMEN.".".self::C_ASPECT." = ".self::T_ASPECT.".".self::C_TERM.")";
        //Join result with death
        $query .= " INNER JOIN ".self::T_DEATH." ON ".self::T_OMEN.".".self::C_DEATH." = ".self::T_DEATH.".".self::C_TERM.")";
        //Join result with fault
        $query .= " INNER JOIN ".self::T_FAULT." ON ".self::T_OMEN.".".self::C_FAULT." = ".self::T_FAULT.".".self::C_TERM.")";
        //Filter result by omen slug
        $query .= " WHERE ".self::T_OMEN.".".self::C_ID." = '".$id."';";

        return (new self)->processQuery($query)->getOmens()[0];
    }


    /**
     * Creates new Omen based on SQL data row
     *
     * @param $row (from the database)
     * 
     * @return $Omen
     */
    public static function buildOmenFromData(array $row) : Omen {
        //TODO: ensure all columns have a unique name so that we can use associative values instead of column nums
        $omen_id = $row[0];
        $omen_slug = $row[1];
        $omen_title = $row[2];
        $omen_statement = $row[3];
        $omen_image_path = "/assets/images/omens/".$omen_slug.".jpg";
        if (!file_exists($_SERVER["DOCUMENT_ROOT"].$omen_image_path)) $omen_image_path = "/assets/images/omens/default.jpg";
        $omen_image_author = $row[4];
        $omen_poem = $row[5];
        $omen_poem_author = $row[6];

        $aspect_id = $row[10];
        $aspect_slug = $row[11];
        $aspect_title = $row[12];

        $death_id = $row[13];
        $death_slug = $row[14];
        $death_title = $row[15];

        $fault_id = $row[16];
        $fault_slug = $row[17];
        $fault_title = $row[18];
        
        $omenAspect = (new Aspect())
        ->setId($aspect_id)
        ->setSlug($aspect_slug)
        ->setTitle($aspect_title);

        $omenDeath = (new Death())
        ->setId($death_id)
        ->setSlug($death_slug)
        ->setTitle($death_title);

        $omenFault = (new Fault())
        ->setId($fault_id)
        ->setSlug($fault_slug)
        ->setTitle($fault_title);

        $output = (new Omen($omen_slug, $omen_title))
        ->setFault($omenFault)
        ->setAspect($omenAspect)
        ->setDeath($omenDeath)
        ->setTitle($omen_title)
        ->setSlug($omen_slug)
        ->setId($omen_id)
        ->setImage($omen_image_path)
        ->setPoem($omen_poem)
        ->setPoemAuthor($omen_poem_author)
        ->setStatement($omen_statement)
        ->setImageAuthor($omen_image_author);

        return $output;
    }



}

