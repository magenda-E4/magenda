<?php

use Magenda\Model\Company;
use Magenda\Model\Profession;

$indicerandphoto = rand(1,3);

$photopath = "include/img/devanture_0".$indicerandphoto.".jpg";

$professionString = "";
/** @var Company $company */
/** @var Profession $profession */
foreach ($company->getProfession() AS $profession){
    $professionString .= $profession->getName()." ";
}
if(strlen($professionString) <= 0){
    $professionString = "Aucune profession";
}
?>

<h2><?= $professionString;?> : <?= $company->getName();?></h2>
<div class="row">
  <div class="col-lg-5">
    <img src=<?php echo $photopath; ?> style="width:100%" alt="Mountain View">
  </div>
  <div class="col-lg-4" style="text-align: justify; text-justify: inter-word;">
    <?php echo $company->getDescription(); ?>
  	<br><br>
    <a class="btn btn-default" href="<?php echo "index.php?controller=event&action=seeCalendar&idcompany=".$company->getId(); ?>"><i class="glyphicon glyphicon-calendar"></i> Prendre un rendez-vous</a>
  </div>
  <div class="col-lg-3">
    Téléphone : <a href="tel:"<?php echo $company->getPhonenumber(); ?>><?php echo $company->getPhonenumber(); ?></a>
  </div>
</div>

    