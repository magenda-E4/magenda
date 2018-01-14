<?php
foreach (glob(__DIR__."/*.php") as $phpFile){
    require_once $phpFile;
}
?>