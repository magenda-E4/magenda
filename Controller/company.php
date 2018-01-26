<?php

use Magenda\Model\Company;

if(strlen($action) <= 0){
    $action = "search";
}
switch ($action){
    case "search":
        $view = "search";
        break;
    case "info":
        if(array_key_exists("ID", $_GET) && isset($_GET["ID"]) &&
            !empty($idcompany = $_GET["ID"]) && is_numeric($idcompany))
        {
            $company = Company::select($idcompany);
            $view = "info";
        }
        break;
}