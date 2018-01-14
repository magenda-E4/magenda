<?php
namespace Magenda\Model;
require_once "autoload.php";
class User extends Model{
    protected static $TABLE = "user";

    /** @var string */
    private $firstname;
    /** @var string */
    private $lastname;
    /** @var string */
    private $email;
    /** @var string */
    private $password;
    /** @var string */
    private $phonenumber;

    /** @var string */
    private $datebirth;

    /** @var string */
    private $city;
    /** @var string */
    private $postalcode;

    /** @var int */
    private $company_id;
    /** @var Company */
    private $company;

    /**
     * User constructor.
     */
    public function __construct(){}

    public function getCompany(){
        if(is_null($this->company) && $this->company_id > 0){
            $this->company = Company::select($this->company_id);
        }
        return $this->company;
    }

    /**
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getPhonenumber()
    {
        return $this->phonenumber;
    }

    /**
     * @return string
     */
    public function getDatebirthString()
    {
        return $this->datebirth;
    }

    /**
     * @return \DateTime
     */
    public function getDatebirthDateTime()
    {
        return new \DateTime($this->getDatebirthString());
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @return string
     */
    public function getPostalcode()
    {
        return $this->postalcode;
    }

    /**
     * @return int
     */
    public function getCompanyId(){
        return $this->company_id;
    }
}