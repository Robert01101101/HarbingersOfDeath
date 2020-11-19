<?php

namespace Entity\Omen;

use Entity\Omen\Omen;
use Taxonomy\Aspect;
use Taxonomy\AspectTaxonomy;
use Taxonomy\Death;
use Taxonomy\DeathTaxonomy;
use Taxonomy\Fault;
use Taxonomy\FaultTaxonomy;

class OmenCollection
{
    private $omens = array();

    protected $connection;

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
        //Not in use because I couldn't refer to the connection variable initialized here (due to lack of PHP wizardry)
        /*
        // Set up MySQLi connection
        // Code for connection is from Lab.
        // 1. Create a database connection
        $connection = mysqli_connect(self::DBHOST, self::DBUSER, self::DBPASS, self::DBNAME);

        // Test if connection succeeded
        if(mysqli_connect_errno()) {
        // if connection failed, skip the rest of PHP code, and print an error
        die("Database connection failed: " . 
             mysqli_connect_error() . 
             " (" . mysqli_connect_errno() . ")"
        );
        }*/
    }


    /**
     * Creates new Omen based on parameters and adds it to this OmenCollection
     *
     * @param $slug
     * @param $title
     * @param $fault
     * @param $aspect
     * @param $death
     */

    private function createOmen(string $slug, sting $title, Fault $fault, Aspect $aspect, Death $death){
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
        $theseOmens = $this->omens;
        $userOmens = $userOmens->getOmens();
        foreach ($userOmens as $uo) {
            foreach ($theseOmens as $to) {
                if ($to->getID() == $uo->getID()) $to->setUserExperience(TRUE);
            }
        }

        $output = new OmenCollection();
        $output->setOmens($theseOmens);
        return $output;
    }


    /**
     * @return array
     */
    public static function findAllOmens()
    {
        //SQL query
        //TODO: use constructor
        // Set up MySQLi connection
        // Code for connection is from Lab.
        // 1. Create a database connection
        $connection = mysqli_connect(self::DBHOST, self::DBUSER, self::DBPASS, self::DBNAME);
        if(mysqli_connect_errno()) { die("Database connection failed: " . mysqli_connect_error() . " (" . mysqli_connect_errno() . ")" ); }

        // 2. Perform database query
        //Select all from the table that is created by performing inner joins. Tables joined: omen, aspect, death & fault.
        $query = "SELECT * FROM ";
        //Join omen with aspect
        $query .= "(((".self::T_OMEN." INNER JOIN ".self::T_ASPECT." ON ".self::T_OMEN.".".self::C_ASPECT." = ".self::T_ASPECT.".".self::C_TERM.")";
        //Join result with death
        $query .= " INNER JOIN ".self::T_DEATH." ON ".self::T_OMEN.".".self::C_DEATH." = ".self::T_DEATH.".".self::C_TERM.")";
        //Join result with fault
        $query .= " INNER JOIN ".self::T_FAULT." ON ".self::T_OMEN.".".self::C_FAULT." = ".self::T_FAULT.".".self::C_TERM.")";

        //DEBUG
        //echo $query;

        $result = mysqli_query($connection, $query);

        // 3. Use returned data
        //prepare output
        $output = array();

        //Print rows
        while($row = mysqli_fetch_array($result))
        {
            array_push($output, self::buildOmenFromData($row));
        }
        // 4. Release returned data
        mysqli_free_result($result);
        // 5. Close database connection
        mysqli_close($connection);
        return $output;
    }

    /**
     * @return array
     */
    public static function findSomeOmens() : OmenCollection
    {
        //SQL query
        //TODO: use constructor
        // Set up MySQLi connection
        // Code for connection is from Lab.
        // 1. Create a database connection
        $connection = mysqli_connect(self::DBHOST, self::DBUSER, self::DBPASS, self::DBNAME);
        if(mysqli_connect_errno()) { die("Database connection failed: " . mysqli_connect_error() . " (" . mysqli_connect_errno() . ")" ); }

        // 2. Perform database query
        //Select all from the table that is created by performing inner joins. Tables joined: omen, aspect, death & fault.
        $query = "SELECT * FROM ";
        //Join omen with aspect
        $query .= "(((".self::T_OMEN." INNER JOIN ".self::T_ASPECT." ON ".self::T_OMEN.".".self::C_ASPECT." = ".self::T_ASPECT.".".self::C_TERM.")";
        //Join result with death
        $query .= " INNER JOIN ".self::T_DEATH." ON ".self::T_OMEN.".".self::C_DEATH." = ".self::T_DEATH.".".self::C_TERM.")";
        //Join result with fault
        $query .= " INNER JOIN ".self::T_FAULT." ON ".self::T_OMEN.".".self::C_FAULT." = ".self::T_FAULT.".".self::C_TERM.")";
        //Pick a number of random records ***
        $query .= " ORDER BY RAND() LIMIT 6;";

        //DEBUG
        //echo $query;
        
        $result = mysqli_query($connection, $query);

        // 3. Use returned data
        //prepare output
        $omensCollection = new OmenCollection();
        //Print rows
        while($row = mysqli_fetch_array($result))
        {
            $omensCollection->addOmen(self::buildOmenFromData($row));
        }
        // 4. Release returned data
        mysqli_free_result($result);
        // 5. Close database connection
        mysqli_close($connection);
        return $omensCollection;
    }

    /**
     * @return array
     */
    public static function findOmensByFilter(array $search) : OmenCollection //(Fault $fault, Aspect $aspect, Death $death) : array
    {
        //SQL query
        //TODO: use constructor
        // Set up MySQLi connection
        // Code for connection is from Lab.
        // 1. Create a database connection
        $connection = mysqli_connect(self::DBHOST, self::DBUSER, self::DBPASS, self::DBNAME);
        if(mysqli_connect_errno()) { die("Database connection failed: " . mysqli_connect_error() . " (" . mysqli_connect_errno() . ")" ); }

        // 2. Perform database query
        //Select all from the table that is created by performing inner joins. Tables joined: omen, aspect, death & fault.
        $query = "SELECT * FROM ";
        //Join omen with aspect
        $query .= "(((".self::T_OMEN." INNER JOIN ".self::T_ASPECT." ON ".self::T_OMEN.".".self::C_ASPECT." = ".self::T_ASPECT.".".self::C_TERM.")";
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

        //original if statement: if(isset($death) && !is_null($death)){  }

        //echo $query;

        $result = mysqli_query($connection, $query);
        //prepare omensCollection
        $omensCollection = new OmenCollection();
        //Print rows
        while($row = mysqli_fetch_array($result))
        {
            //echo print_r($row);
            $omensCollection->addOmen(self::buildOmenFromData($row));
        }
        // 4. Release returned data
        mysqli_free_result($result);
        // 5. Close database connection
        mysqli_close($connection);
        return $omensCollection;

    }

    /**
     * @return Omen
     */
    public static function getOmenBySlug(string $slug) : Omen
    {
        //SQL query
        //TODO: use constructor
        // Set up MySQLi connection
        // Code for connection is from Lab.
        // 1. Create a database connection
        $connection = mysqli_connect(self::DBHOST, self::DBUSER, self::DBPASS, self::DBNAME);
        if(mysqli_connect_errno()) { die("Database connection failed: " . mysqli_connect_error() . " (" . mysqli_connect_errno() . ")" ); }

        // 2. Perform database query
        //Select all from the table that is created by performing inner joins. Tables joined: omen, aspect, death & fault.
        $query = "SELECT * FROM ";
        //Join omen with aspect
        $query .= "(((".self::T_OMEN." INNER JOIN ".self::T_ASPECT." ON ".self::T_OMEN.".".self::C_ASPECT." = ".self::T_ASPECT.".".self::C_TERM.")";
        //Join result with death
        $query .= " INNER JOIN ".self::T_DEATH." ON ".self::T_OMEN.".".self::C_DEATH." = ".self::T_DEATH.".".self::C_TERM.")";
        //Join result with fault
        $query .= " INNER JOIN ".self::T_FAULT." ON ".self::T_OMEN.".".self::C_FAULT." = ".self::T_FAULT.".".self::C_TERM.")";
        //Filter result by omen slug
        $query .= " WHERE ".self::T_OMEN.".".self::C_SLUG." = '".$slug."';";

        //DEBUG
        //echo $query;

        $result = mysqli_query($connection, $query);

        // 3. Use returned data
        //prepare output
        $output;

        //Print rows
        while($row = mysqli_fetch_array($result))
        {
            //echo print_r($row);
            $output = self::buildOmenFromData($row);
        }

        // 4. Release returned data
        mysqli_free_result($result);
        // 5. Close database connection
        mysqli_close($connection);
        return $output;
    }

    /**
     * @return Omen
     */
    public static function getOmenById(int $id) : Omen
    {
        //SQL query
        //TODO: use constructor
        // Set up MySQLi connection
        // Code for connection is from Lab.
        // 1. Create a database connection
        $connection = mysqli_connect(self::DBHOST, self::DBUSER, self::DBPASS, self::DBNAME);

        // Test if connection succeeded
        if(mysqli_connect_errno()) { die("Database connection failed: " . mysqli_connect_error() . " (" . mysqli_connect_errno() . ")" ); }

        // 2. Perform database query
        //Select all from the table that is created by performing inner joins. Tables joined: omen, aspect, death & fault.
        $query = "SELECT * FROM ";
        //Join omen with aspect
        $query .= "(((".self::T_OMEN." INNER JOIN ".self::T_ASPECT." ON ".self::T_OMEN.".".self::C_ASPECT." = ".self::T_ASPECT.".".self::C_TERM.")";
        //Join result with death
        $query .= " INNER JOIN ".self::T_DEATH." ON ".self::T_OMEN.".".self::C_DEATH." = ".self::T_DEATH.".".self::C_TERM.")";
        //Join result with fault
        $query .= " INNER JOIN ".self::T_FAULT." ON ".self::T_OMEN.".".self::C_FAULT." = ".self::T_FAULT.".".self::C_TERM.")";
        //Filter result by omen slug
        $query .= " WHERE ".self::T_OMEN.".".self::C_ID." = '".$id."';";

        //DEBUG
        //echo $query;

        $result = mysqli_query($connection, $query);

        // 3. Use returned data
        //prepare output
        $output;

        //Print rows
        while($row = mysqli_fetch_array($result))
        {
            //echo print_r($row);
            $output = self::buildOmenFromData($row);
        }

        // 4. Release returned data
        mysqli_free_result($result);
        // 5. Close database connection
        mysqli_close($connection);
        return $output;
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

