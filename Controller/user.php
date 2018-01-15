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
    case "connectForm":
        if(is_null($userConnected)) {
            $view = "connectForm";
        }else{
            header("Location: index.php");
        }
        break;
    case "connect":
        $errors = [];

        if(!is_null($userConnected)) header("Location: index.php");

        if(isset($_POST["email"]) && isset($_POST["password"])) {
            if(!empty($_POST["email"]) || !empty($_POST["password"])){
                $password = User::hashPassword($_POST["password"]);
                $searchUserByUsernameAndPassword = User::selectWhere(array(
                   "email" => $_POST["email"],
                    "password" => $password
                ));
                $numberOfUserWith = count($searchUserByUsernameAndPassword);
                if($numberOfUserWith > 0){
                    /** @var User $currentUser */
                    $currentUser = $searchUserByUsernameAndPassword[0];
                    $_SESSION["id"] = $currentUser->getId();
                }else{
                    $errors[] = "L'email ou le mot de passe sont incorrects";
                }
            }
            else{
                $errors[] = "Attention, il manque l'email ou le mot de passe (Elles sont vides)";
            }
        }
        else{
            $errors[] = "Attention, il manque l'email ou le mot de passe";
        }


        if(count($errors) > 0){
            $view = "connectForm";
        }else{
            header("Location: index.php");
        }
        break;

    case "disconnect":
        if(!is_null($userConnected)){
            session_destroy();
        }
        header("Location: index.php");
        break;
    case "":

        break;
}


?>