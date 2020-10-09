<?php


namespace User;


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

    public function writeToFile(){
        $data = "";
        if (isset($this->name)){ ($data .= "Name: " . $this->name); };
        if (isset($this->emailAddress)){ ($data .= "\nName: " . $this->emailAddress); };
        if (isset($this->password)){ ($data .= "\nPassword: " . $this->password); };
        
        if (isset($this->birthdayDay)){ ($data .= "\nBirthday: " . $this->birthdayDay); };
        if (isset($this->birthdayMonth)){ ($data .= ", " . $this->birthdayMonth); };
        if (isset($this->birthdayYear)){ ($data .= ", " . $this->birthdayYear); };

        if (isset($this->country)){ ($data .= "\nPassword: " . $this->country); };

        $fp = fopen('data.txt', 'w');
        fwrite($fp, $data);
        fclose($fp);
    }
}
