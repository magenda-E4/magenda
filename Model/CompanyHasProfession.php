<?php
/**
 * Created by IntelliJ IDEA.
 * User: jeremyfornarino
 * Date: 14/01/2018
 * Time: 03:18
 */

namespace Magenda\Model;


class CompanyHasProfession extends Model
{
    protected static $TABLE = "company_has_profession";
    /** @var int */
    private $company_id;
    /** @var int */
    private $profession_id;

    public function  getCompany(){
        return Company::select($this->getCompanyId());
    }

    public function getProfession(){
        return Profession::select($this->getProfessionId());
    }
    /**
     * @return int
     */
    public function getCompanyId()
    {
        return $this->company_id;
    }

    /**
     * @return int
     */
    public function getProfessionId()
    {
        return $this->profession_id;
    }

}