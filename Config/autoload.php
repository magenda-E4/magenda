<?php
$configPath = __DIR__ . "/Config.php";
if(file_exists($configPath)){
    require_once $configPath;
}else{
    require_once __DIR__."/Config.default.php";
}
?>