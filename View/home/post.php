<?php
    include "../../Model/Company.php";
    //include "../../Model/Profession.php";

    use Magenda\Model\Company;
    use Magenda\Model\Profession;

    $comp = new Company();
    $prof = new Profession();
    $res = array();

    if(isset($_POST['search']) && !empty($_POST['search'])){
       //PDO::quote() protège contre les caractères spéciaux
        $search = htmlentities($_POST['search']);
        //Recherche dans la table company
        $reqComp = $comp::selectData("WHERE name LIKE '%$search%'");

        //Recherche d'une profession
        $reqProf = $prof::selectData("WHERE name LIKE '%$search%'");

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
        //Enlever les doublons dans la liste
        //Il faudrait créer une liste puis retirer les doublons
        //Par contre, il faut faire attention au gens qui portent le meme nom
        // Tableau 3 colonnes id nom prof ?

        //Afficher la liste

    }
