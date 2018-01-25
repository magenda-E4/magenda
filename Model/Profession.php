<?php
/**
 * Created by IntelliJ IDEA.
 * User: jeremyfornarino
 * Date: 14/01/2018
 * Time: 03:15
 */

namespace Magenda\Model;


class Profession extends Model
{
    protected static $TABLE = "profession";
    /** @var string */
    private $name;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    public function getCompanies(){
        $companies = [];
        $allCompanyHasProfession = CompanyHasProfession::selectWhere(["profession_id" => $this->getId()]);
        /** @var CompanyHasProfession $comapnyhasprofession */
        foreach($allCompanyHasProfession AS $comapnyhasprofession){
            $companies[] = $comapnyhasprofession->getCompany();
        }
        return $companies;
    }
}
