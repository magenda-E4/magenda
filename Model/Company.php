<?php

namespace Magenda\Model;
require_once "autoload.php";
class Company extends Model
{
    protected static $TABLE = "company";
    /** @var string */
    private $name;
    /** @var string */
    private $description;
    /** @var string */
    private $phonenumber;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescription(){
        return $this->description;
    }

    /**
     * @return string
     */
    public function getPhonenumber(){
        return $this->phonenumber;
    }
    public function getProfession(){
        $professions = [];
        $allCompanyHasProfession = CompanyHasProfession::selectWhere(["company_id" => $this->getId()]);
        /** @var CompanyHasProfession $comapnyhasprofession */
        foreach($allCompanyHasProfession AS $comapnyhasprofession){
            $professions[] = $comapnyhasprofession->getProfession();
        }
        return $professions;
    }

    /**
     * Retourne un tableau de "User"
     * avec l'ensemble des employées
     * de l'entreprises
     * @return array
     */
    public function getEmployes(){
        return User::selectWhere(["company_id" => $this->getId()]);
    }

    public function getFavoriesUser(){
        $favories = Favory::selectWhere(["favory" => $this]);
        $users = [];
        /** @var Favory $favory */
        foreach($favories AS $favory){
            $users[] = User::select($favory->getUserId());
        }
        return $users;
    }
}