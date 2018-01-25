<?php

use Magenda\Model\Company;
use Magenda\Model\Profession;

if(strlen($action) <= 0){
    $action = "search";
}
switch ($action){
    case "searchBar":
        if(isset($_POST['search']) && !empty($_POST['search'])){
            //PDO::quote() protège contre les caractères spéciaux
            $search = htmlentities($_POST['search']);
            //Recherche dans la table company
            $reqComp = Company::selectData("WHERE name LIKE '%$search%'");

            //Recherche d'une profession
            $reqProf = Profession::selectData("WHERE name LIKE '%$search%'");
            /** @var Company $row */
            foreach($reqComp as $row){
                $name = $row->getName();
                $profession = $row->getProfession();
                foreach ($profession as $p){
                    $profName = $p->getName();
                    echo "<li><a href ='#'>".$name.", ".$profName."</a></li>";
                    //array_push($res,$name,$profName);
                }
            }
            /** @var Profession $p */
            foreach($reqProf as $p){
                $companies = $p->getCompanies();
                //var_dump($companies);
                /** @var Company $c */
                foreach($companies as $c){
                    $name = $c->getName();
                    $profession = $c->getProfession();
                    foreach ($profession as $p){
                        $profName = $p->getName();
                        echo "<li><a href ='#'>".$name.", ".$profName."</a></li>";
                        //array_push($res,$name,$profName);
                    }
                }
            }
        }
        break;
}