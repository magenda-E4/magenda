<?php
    $res = array();
    if(isset($_POST['search']) && !empty($_POST['search'])){
       //PDO::quote() protège contre les caractères spéciaux
        $search = htmlentities($_POST['search']);
        //Recherche dans la table company
        $reqComp = Company::selectData("WHERE name LIKE '%$search%'");

        //Recherche d'une profession
        $reqProf = Profession::selectData("WHERE name LIKE '%$search%'");

        foreach($reqComp as $row){
            $name = $row->getName();
            $profession = $row->getProfession();
            foreach ($profession as $p){
                $profName = $p->getName();
                echo "<li><a href ='#'>".$name.", ".$profName."</a></li>";
                //array_push($res,$name,$profName);
            }
        }

        foreach($reqProf as $p){
            $companies = $p->getCompanies();
            //var_dump($companies);
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
