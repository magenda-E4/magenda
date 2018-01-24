<?php
    include "../../Model/Company.php";

    use Magenda\Model\Company;

    $comp = new Company();


    if(isset($_POST['search']) && !empty($_POST['search'])){
       //PDO::quote() protège contre les caractères spéciaux
        $search = htmlentities($_POST['search']);
        //Recherche dans la table company
        $reqComp = $comp::selectData("WHERE name LIKE '%$search%'");

        foreach($reqComp as $row){
            $name = $row->getName();
            echo "<li><a href ='#'>".$name."</a></li>";

        }

    }