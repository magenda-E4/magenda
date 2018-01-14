<?php
require_once __DIR__ . "/Model.php";
foreach (glob(__DIR__."/*.php") as $phpFile){
    if(basename($phpFile) != "Model.php"){
        require_once $phpFile;
    }
}
?>