<?php


namespace User;


use Util\TextParser\TextParser;
use Entity\Omen\Omen;
use Entity\Omen\OmenCollection;

class User
{
    private string $name, $emailAddress, $password, $birthdayDay, $birthdayMonth, $birthdayYear, $country, $id;

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

    public function __constringuct()
    {
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return User
     */
    public function setName(string $name): User
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmailAddress(): string
    {
        return $this->emailAddress;
    }

    /**
     * @param string $emailAddress
     * @return User
     */
    public function setEmailAddress(string $emailAddress): User
    {
        $this->emailAddress = $emailAddress;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return User
     */
    public function setPassword(string $password): User
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return string
     */
    public function getBirthdayDay(): string
    {
        return $this->birthdayDay;
    }

    /**
     * @param string $birthdayDay
     * @return User
     */
    public function setBirthdayDay(string $birthdayDay): User
    {
        $this->birthdayDay = $birthdayDay;
        return $this;
    }

    /**
     * @return string
     */
    public function getBirthdayMonth(): string
    {
        return $this->birthdayMonth;
    }

    /**
     * @param string $birthdayMonth
     * @return User
     */
    public function setBirthdayMonth(string $birthdayMonth): User
    {
        $this->birthdayMonth = $birthdayMonth;
        return $this;
    }

    /**
     * @return string
     */
    public function getBirthdayYear(): string
    {
        return $this->birthdayYear;
    }

    /**
     * @param string $birthdayYear
     * @return User
     */
    public function setBirthdayYear(string $birthdayYear): User
    {
        $this->birthdayYear = $birthdayYear;
        return $this;
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @param string $country
     * @return User
     */
    public function setCountry(string $country): User
    {
        $this->country = $country;
        return $this;
    }

    /**
     * @return string
     */
    public function getID(): string
    {
        return $this->id;
    }

    /**
     * @param string $country
     * @return User
     */
    public function setID(int $id): User
    {
        $this->id = $id;
        return $this;
    }

    //Deprecated
    /*
    public function writeToFile($filePath){
        $data = "";
        if (isset($this->name)){ ($data .= "Name: " . $this->name); };
        if (isset($this->emailAddress)){ ($data .= PHP_EOL . "emailAddress: " . $this->emailAddress); };
        if (isset($this->password)){ ($data .= PHP_EOL . "Password: " . $this->password); };
        
        if (isset($this->birthdayDay)){ ($data .= PHP_EOL . "Birthday: " . $this->birthdayDay); };
        if (isset($this->birthdayMonth)){ ($data .= ", " . $this->birthdayMonth); };
        if (isset($this->birthdayYear)){ ($data .= ", " . $this->birthdayYear); };

        if (isset($this->country)){ ($data .= PHP_EOL . "Password: " . $this->country); };

        $fp = fopen($filePath, 'w');
        fwrite($fp, $data);
        fclose($fp);
    }*/

    public function writeToDB(){
        // Set up MySQLi connection
        // 1. Create a database connection
        $connection = mysqli_connect(self::DBHOST, self::DBUSER, self::DBPASS, self::DBNAME);

        // Test if connection succeeded
        if(mysqli_connect_errno()) { die("Database connection failed: ".mysqli_connect_error()." (".mysqli_connect_errno().")");}

        //Ensure user doesn't exist already
        $query = "SELECT * FROM `user` WHERE user.email_address = '".$this->emailAddress."';";
        $result = mysqli_query($connection, $query);
        if (mysqli_num_rows($result)>0){
            //User already exists
            echo "USER ALREADY EXISTS";
        } else {
            //User doesn't exist yet -> add entry
            // 2. Write to DB
            //TODO: Lock & Unlock tables (caused error message, only if performed thru PHP. Locking & Unlocking works fine if queries launched from PHPAdmin)
            //Address
            //$query = "LOCK TABLES `address` WRITE; ";
            $query = "insert into `address`(`country`,`province`,`city`,`postal_code`,`street_address`,`street_address_2`) values ";
            $query .= "('".$this->country."', 'testProvince', 'testCity', 'testPC', 'testAddress', 'testAddress2'); ";
            //$query .= "UNLOCK TABLES;";

            if (mysqli_query($connection, $query)) {
                //echo "New record created successfully<br>";
            } else {
                echo "Error with the query: <br>" . $query . "<br><br>Error Message:<br>" . mysqli_error($connection);
            }

            //User
            //$query = "LOCK TABLES `user` WRITE; ";
            $query = "insert  into `user`(`user_name`,`password`,`created_at`,`phone_number`,`address_id`,`full_name`,`email_address`,`image_path`) values ";
            $query .= "('testUsername', '".$this->password."', ".time().", 0123456789, ".$connection->insert_id.", '".$this->name."', '".$this->emailAddress."', 'testImage'); ";
            //$query .= "UNLOCK TABLES;";
        }
        
        if (mysqli_query($connection, $query)) {
            //echo "New record created successfully";
        } else {
            echo "Error with the query: <br>" . $query . "<br><br>Error Message:<br>" . mysqli_error($connection);
        }
  
        // 5. Close database connection
        mysqli_close($connection);
    }

    // Deprecated
    /*
    public static function buildFromFile($filePath) : self
    {
        // gobble full text file
        $fullString = file_get_contents("data.txt");

        // Error handling if it is empty
        if ($fullString === FALSE){
            // TODO: error handling
        }

        // find the required values within the file
        $name = TextParser::get_string_between($fullString, "Name: ", PHP_EOL);
        $emailAddress = TextParser::get_string_between($fullString, "emailAddress: ", PHP_EOL);
        $password = TextParser::get_string_between($fullString, "Password: ", PHP_EOL);

        // TODO: Birthday & Country.. but doesn't really matter right now.

        // make new user
        return (new self)->setName($name)->setPassword($password)->setEmailAddress($emailAddress);
    }*/

    public static function authenticateUser(string $formEmail, string $formPassword)
    {
        // 1. Set up MySQLi connection
        $DBHOST = "localhost";
        $DBUSER = "root";
        $DBPASS = "";
        $DBNAME = "robert_michels";
        $connection = mysqli_connect($DBHOST, $DBUSER, $DBPASS, $DBNAME);
        // Test if connection succeeded
        if(mysqli_connect_errno()) { die("Database connection failed: " . mysqli_connect_error() . " (" . mysqli_connect_errno() . ")" ); }

        //2. Query
        //TODO: Change from sha1() to a more secure encryption system
        $query = "SELECT * FROM `user` WHERE user.email_address = '".$formEmail."' AND user.password = '".sha1($formPassword)."'";
        $result = mysqli_query($connection, $query);

        //prepare output
        $output;

        if($result->num_rows == 1){
            //echo "Successful Login";
            $row = mysqli_fetch_array($result);

            //echo print_r($row);  //<-- print names of all fields

            $output = (new self)->setPassword($formPassword)->setEmailAddress($formEmail)->setName($row["full_name"])->setID($row["user_id"]);
        }

        // 4. Release returned data
        mysqli_free_result($result);
        // 5. Close database connection
        mysqli_close($connection);
        if (isset($output)) return $output;
    }

    public function addOmenToUser(Omen $omen){
        // 1. Set up MySQLi connection
        $DBHOST = "localhost";
        $DBUSER = "root";
        $DBPASS = "";
        $DBNAME = "robert_michels";
        $connection = mysqli_connect($DBHOST, $DBUSER, $DBPASS, $DBNAME);
        // Test if connection succeeded
        if(mysqli_connect_errno()) { die("Database connection failed: " . mysqli_connect_error() . " (" . mysqli_connect_errno() . ")" ); }

        //Ensure association doesn't exist already (refer to user authentication)
        //Ensure user doesn't exist already
        $query = "SELECT * FROM `user_omen` WHERE user_omen.user_id = '".$this->id."' AND user_omen.omen_id = '".$omen->getId()."';";
        $result = mysqli_query($connection, $query);
        if (mysqli_num_rows($result)>0){
            //Omen already exists
            //echo "OMEN ALREADY EXISTS";
        } else {
            // 2. Write to DB
            //TODO: Lock & Unlock tables (caused error message, only if performed thru PHP. Locking & Unlocking works fine if queries launched from PHPAdmin)
            //Address
            //$query = "LOCK TABLES `address` WRITE; ";
            $query = "insert into `user_omen`(`user_id`,`omen_id`) values ";
            $query .= "('".$this->id."', '".$omen->getId()."'); ";
            //$query .= "UNLOCK TABLES;";

            if (mysqli_query($connection, $query)) {
                //echo "New record created successfully<br>";
            } else {
                echo "Error with the query: <br>" . $query . "<br><br>Error Message:<br>" . mysqli_error($connection);
            }

            //User
            //$query = "LOCK TABLES `user` WRITE; ";
            $query = "insert  into `user`(`user_name`,`password`,`created_at`,`phone_number`,`address_id`,`full_name`,`email_address`,`image_path`) values ";
            $query .= "('testUsername', '".$this->password."', ".time().", 0123456789, ".$connection->insert_id.", '".$this->name."', '".$this->emailAddress."', 'testImage'); ";
            //$query .= "UNLOCK TABLES;";
        }
        
        // 5. Close database connection
        mysqli_close($connection);
    }

    public function getUserOmens() : OmenCollection
    {
        // 1. Set up MySQLi connection
        $DBHOST = "localhost";
        $DBUSER = "root";
        $DBPASS = "";
        $DBNAME = "robert_michels";
        $connection = mysqli_connect($DBHOST, $DBUSER, $DBPASS, $DBNAME);
        // Test if connection succeeded
        if(mysqli_connect_errno()) { die("Database connection failed: " . mysqli_connect_error() . " (" . mysqli_connect_errno() . ")" ); }

        //Ensure association doesn't exist already (refer to user authentication)
        //Ensure user doesn't exist already
        $query = "SELECT * FROM `user_omen` WHERE user_omen.user_id = '".$this->id."';";
        $result = mysqli_query($connection, $query);

        //prepare omensCollection
        $omensCollection = new OmenCollection();

        //row by row
        while($row = mysqli_fetch_array($result))
        {
            //echo print_r($row);
            $omensCollection->addOmen(OmenCollection::getOmenById($row["omen_id"]));
        }
        
        // 5. Close database connection
        mysqli_close($connection);

        //echo $query;

        return $omensCollection;
    }
}
