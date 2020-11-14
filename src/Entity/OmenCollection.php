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
//    private $omenArray = [
//        [
//            "slug" => "cracked-bread",
//            "title" => "Have you baked bread, that has cracks upon its top?",
//            "fault" => "you",
//            "aspect" => "domestic-life",
//            "death" => "close-friend"
//        ],
//        [
//            "slug" => "ringing-ears",
//            "title" => "Is there a ringing in your ears?",
//            "fault" => "you",
//            "aspect" => "vitality",
//            "death" => "you"
//        ],
//        [
//            "slug" => "lighted-carptenters-shop",
//            "title" => "Has a light suddenly and unaccountably been seen in a carpenter’s shop?",
//            "fault" => "the-public",
//            "aspect" => "industry",
//            "death" => "community-member"
//        ],
//        [
//            "slug" => "umbrella",
//            "title" => "Have you opened an umbrella in your house?",
//            "fault" => "you",
//            "aspect" => "domestic-life",
//            "death" => "community-member"
//        ],
//        [
//            "slug" => "bell-ringing",
//            "title" => "Has a bell rung of its own accord?",
//            "fault" => "god",
//            "aspect" => "religion",
//            "death" => "community-member"
//        ],
//        [
//            "slug" => "funeral-procession",
//            "title" => "Did anyone arrive at the funeral, after the procession had begun?",
//            "fault" => "the-public",
//            "aspect" => "death",
//            "death" => "community-member"
//        ],
//        [
//            "slug" => "hair-pin",
//            "title" => "Has a hairpin fallen from your hair?",
//            "fault" => "you",
//            "aspect" => "domestic-life",
//            "death" => "you"
//        ],
//        [
//            "slug" => "funeral-procession",
//            "title" => "Did anyone arrive at the funeral, after the procession had begun?",
//            "fault" => "the-public",
//            "aspect" => "death",
//            "death" => "community-member"
//        ]
//    ];

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
        }
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


    /*
     * MAYBE USE seperate function for the database calls
     * I don't know yet if I will need the same methods
     * in a non-static form.. so to avoid duplication of code
     * it might be good of it to be a wrapper
     *
     * <3
     */


    /**
     * @return array
     */
    public static function findAllOmens()
    {
        //TODO: database query
        //SQL query
        // should use "(new self)" which will call the constructor
        // (which sets up the db connection)
        // don't forget to close the database connection "$this->connection = null"
        // return an array of Omen object


        //return (new self)->omens;




        //TODO: use constructor
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
        }

        //SQL query
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
            //echo print_r($row);
            
            //TODO: ensure all columns have a unique name so that we can use associative values instead of column nums
            $omen_id = $row[0];
            $omen_slug = $row[1];
            $omen_title = $row[2];
            $omen_image = $row[3];

            $aspect_id = $row[7];
            $aspect_slug = $row[8];
            $aspect_title = $row[9];

            $death_id = $row[10];
            $death_slug = $row[11];
            $death_title = $row[12];

            $fault_id = $row[13];
            $fault_slug = $row[14];
            $fault_title = $row[15];
            

            //TODO: Set omen image path
            //TODO: Set poem
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

            $item = (new Omen($omen_slug, $omen_title))
            ->setFault($omenFault)
            ->setAspect($omenAspect)
            ->setDeath($omenDeath)
            ->setTitle($omen_title)
            ->setSlug($omen_slug);

            array_push($output, $item);
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
    public static function findOmensByFilter(array $search) : OmenCollection //(Fault $fault, Aspect $aspect, Death $death) : array
    {
        //TODO: database query
        //SQL query

        $connection = mysqli_connect(self::DBHOST, self::DBUSER, self::DBPASS, self::DBNAME);
        if(mysqli_connect_errno()) { die("Database connection failed: " . mysqli_connect_error() . " (" . mysqli_connect_errno() . ")" ); }

        //Select all from the table that is created by performing inner joins. Tables joined: omen, aspect, death & fault.
        $query = "SELECT * FROM ";
        //Join omen with aspect
        $query .= "(((".self::T_OMEN." INNER JOIN ".self::T_ASPECT." ON ".self::T_OMEN.".".self::C_ASPECT." = ".self::T_ASPECT.".".self::C_TERM.")";
        //Join result with death
        $query .= " INNER JOIN ".self::T_DEATH." ON ".self::T_OMEN.".".self::C_DEATH." = ".self::T_DEATH.".".self::C_TERM.")";
        //Join result with fault
        $query .= " INNER JOIN ".self::T_FAULT." ON ".self::T_OMEN.".".self::C_FAULT." = ".self::T_FAULT.".".self::C_TERM.")";


        // should use "(new self)" which will call the constructor
        // (which sets up the db connection)
        // don't forget to close the database connection "$this->connection = null"
        // return an array of Omen object
        // TODO: update so it works for multiple values

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
        //TODO: use constructor
        // Set up MySQLi connection
        // Code for connection is from Lab.
        // 1. Create a database connection
        $connection = mysqli_connect(self::DBHOST, self::DBUSER, self::DBPASS, self::DBNAME);

        // Test if connection succeeded
        if(mysqli_connect_errno()) { die("Database connection failed: " . mysqli_connect_error() . " (" . mysqli_connect_errno() . ")" ); }

        //SQL query
        // should use "(new self)" which will call the constructor
        // (which sets up the db connection)
        // don't forget to close the database connection "$this->connection = null"
        // needs to do an inner join with the taxonomies
        // and then build them as objects
        // return a single Omen object (Error handling to make sure the result returned is a single item)
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

    private static function buildOmenFromData(array $row) : Omen {
        //TODO: ensure all columns have a unique name so that we can use associative values instead of column nums
        $omen_id = $row[0];
        $omen_slug = $row[1];
        $omen_title = $row[2];
        $omen_image = $row[3];

        $aspect_id = $row[7];
        $aspect_slug = $row[8];
        $aspect_title = $row[9];

        $death_id = $row[10];
        $death_slug = $row[11];
        $death_title = $row[12];

        $fault_id = $row[13];
        $fault_slug = $row[14];
        $fault_title = $row[15];
        
        /*
        //DEBUG
        echo "<br>Omen ID: ".$omen_id;
        echo "<br>Omen Slug: ".$omen_slug;
        echo "<br>Omen Title: ".$omen_title;
        echo "<br>Omen Image: ".$omen_image;

        echo "<br>Aspect ID: ".$aspect_id;
        echo "<br>Aspect Slug: ".$aspect_slug;
        echo "<br>Aspect Title: ".$aspect_title;

        echo "<br>Death ID: ".$death_id;
        echo "<br>Death Slug: ".$death_slug;
        echo "<br>Death Title: ".$death_title;

        echo "<br>Fault ID: ".$fault_id;
        echo "<br>Fault Slug: ".$fault_slug;
        echo "<br>Fault Title: ".$fault_title;
        */

        //TODO: Set omen image path
        //TODO: Set poem
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
        ->setSlug($omen_slug);

        return $output;
    }

}

