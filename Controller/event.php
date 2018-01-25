<?php

use Magenda\Model\Company;
use Magenda\Model\User;

// Nous commencons par
// verifier si une action
// existe, sinon nous
// en indicons une par defaut
if(strlen($action) <= 0){
    $action = "list";
}

switch ($action){
    case "seeCalendar":
        if($userConnected instanceof User){
            $currentUser = null;
            $currentCompany = null;
            if(array_key_exists("iduser", $_GET) && is_numeric($_GET["iduser"]) && $_GET["iduser"] > 0){
                $currentUser = User::select($_GET["iduser"]);
            }elseif(array_key_exists("idcompany", $_GET)) {
                $currentCompany = Company::select($_GET["idcompany"]);
            }
            $view = "calendar";
        }else{
            header("Location: index.php");
        }
        break;
}