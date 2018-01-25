<?php

// Nous commencons par
// verifier si une action
// existe, sinon nous
// en indicons une par defaut
if(strlen($action) <= 0){
    // Aucune action n'est indiqué
    // Nous chargeons par defaut
    // l'action 404
    $action = "404";
}
switch ($action){
    // Si l'action est 404 alors nous devons
    // faire ...
    case "404":
        // Nous indiquons la vue à charger
        $view = "404";
        break;
}
