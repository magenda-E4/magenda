<?php

if(strlen($action) <= 0){
    $action = "search";
}
switch ($action){
    case "search":
        $view = "search";
        break;
}
