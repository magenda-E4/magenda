<?php

use Magenda\Model\User;

// Nous commencons par
// verifier si une action
// existe, sinon nous
// en indicons une par defaut
if(strlen($action) <= 0){
    // Aucune action n'est indiqué
    // Nous chargeons par defaut
    // l'action 404
    $action = "list";
}
switch ($action){
    // Si l'action est 404 alors nous devons
    // faire ...
    case "list":
        // Nous chargeons l'ensemble des utilisateurs
        // pour que la vue puisse les afficher
        // Pour cela nous utilisons la class
        // User, et la method selectAll()
        // qui se chargera de retourner
        // directement un tableau avec
        // l'ensemble des utilisateurs
        $users = User::selectAll();
        // Nous indiquons la vue à charger
        $view = "list";
        break;
}


?>