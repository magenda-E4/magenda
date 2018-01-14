<?php
/**
 * Created by IntelliJ IDEA.
 * User: jeremyfornarino
 * Date: 14/01/2018
 * Time: 03:26
 */

namespace Magenda\Model;


class Favory extends Model
{
    protected static $TABLE = "favory";
    /** @var int */
    private $user_id;
    /** @var int */
    private $company_id;

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @return int
     */
    public function getCompanyId()
    {
        return $this->company_id;
    }


}