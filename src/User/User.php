<?php


namespace User;


use Util\TextParser\TextParser;

class User
{
    private string $name, $emailAddress, $password, $birthdayDay, $birthdayMonth, $birthdayYear, $country;

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
    }

    public function writeToDB(){
        //TMP
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

        // 2. Write to DB
        //TODO: Verify user doesn't already exist
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
        
        if (mysqli_query($connection, $query)) {
            //echo "New record created successfully";
        } else {
            echo "Error with the query: <br>" . $query . "<br><br>Error Message:<br>" . mysqli_error($connection);
        }
  
        // 5. Close database connection
        mysqli_close($connection);
    }

    // TODO: consider this method.. OOB doesn't feel like this belongs here
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
    }
}
