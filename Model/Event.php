<?php
namespace Magenda\Model;
require_once "autoload.php";


class Event extends Model
{
    protected static $TABLE = "event";

    /** @var string */
    private $startdatetime;
    /** @var string */
    private $enddatetime;

    /** @var int */
    private $company_id;
    /** @var Company */
    private $company;

    /** @var float */
    private $price;
    /** @var int */
    private $user_id;
    /** @var User */
    private $user;
    /** @var float */
    private $promotion;

    public function __construct(){
        $this->company = null;
        $this->user = null;
    }

    public function getUser(){
        if(is_null($this->user) && $this->user_id > 0){
            $this->user = User::select($this->user_id);
        }
        return $this->user;
    }

    public function getCompany(){
        if(is_null($this->company) && $this->company_id > 0){
            $this->company = Company::select($this->company_id);
        }
        return $this->company;
    }

    /**
     * @return string
     */
    public function getStartdatetimeString()
    {
        return $this->startdatetime;
    }

    public function getStartdatetimeDateTime(){
        return new \DateTime($this->getStartdatetimeString());
    }
    /**
     * @return string
     */
    public function getEnddatetimeString()
    {
        return $this->enddatetime;
    }
    public function getEnddatetimeDateTime(){
        return new \DateTime($this->getEnddatetimeString());
    }

    /**
     * @return int
     */
    public function getCompanyId()
    {
        return $this->company_id;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @return float
     */
    public function getPromotion()
    {
        return $this->promotion;
    }
}