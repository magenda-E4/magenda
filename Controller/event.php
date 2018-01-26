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
        $title = "Calendrier de : ";
        if($userConnected instanceof User){
            $currentUser = null;
            $currentCompany = null;
            if(array_key_exists("iduser", $_GET) && is_numeric($_GET["iduser"]) && $_GET["iduser"] > 0){
                /** @var User $currentUser */
                $currentUser = User::select($_GET["iduser"]);
                $title .= $currentUser->getFirstname()." ".$currentUser->getLastname();
            }elseif(array_key_exists("idcompany", $_GET)) {
                /** @var Company $currentCompany */
                $currentCompany = Company::select($_GET["idcompany"]);
                $title .= $currentCompany->getName();
            }
            $view = "calendar";
        }else{
            header("Location: index.php?controller=user");
        }
        break;
}