<?php

use Magenda\Model\Company;
use Magenda\Model\Profession;

$indicerandphoto = rand(1,3);

$photopath = "include/img/devanture_0".$indicerandphoto.".jpg";


$res = array();
    if(isset($_GET['ID']) && !empty($_GET['ID'])){
       //PDO::quote() protège contre les caractères spéciaux
        $compid = htmlentities($_GET['ID']);
        //Recherche dans la table company
        $reqComp = Company::selectData("WHERE id LIKE '%$compid%'");

        foreach($reqComp as $row){
                $name = $row->getName();
                $desc = $row->getDescription();
                $tel = $row->getPhonenumber();
                $profession = $row->getProfession();
                foreach ($profession as $p){
                    $profName = $p->getName();
                }
            }
    }

?>

<h2><?php echo $profName." : ".$name; ?></h2>
<div class="row">
  <div class="col-lg-5">
    <img src=<?php echo $photopath; ?> style="width:100%" alt="Mountain View">
  </div>
  <div class="col-lg-4" style="text-align: justify; text-justify: inter-word;">
    <?php echo $desc; ?>
  	<br><br>
    <a class="btn btn-default" href="#"><i class="glyphicon glyphicon-calendar"></i> Prendre un rendez-vous</a>
  </div>
  <div class="col-lg-3">
    Téléphone : <a href="tel:"<?php echo $tel; ?>><?php echo $tel; ?></a>
  </div>
</div>

    