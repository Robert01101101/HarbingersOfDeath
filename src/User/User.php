<?php


namespace User;


use Util\TextParser\TextParser;

class User
{
    private string $name, $emailAddress, $password, $birthdayDay, $birthdayMonth, $birthdayYear, $country;

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
