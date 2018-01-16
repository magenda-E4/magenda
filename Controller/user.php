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
            $view = "connectForm";
            break;
        }


        if(count($errors) > 0){
            $view = "connectForm";
        }else{
            header("Location: index.php");
        }
        break;

    case "signUpForm":
        $errors = [];
        if(is_null($userConnected)) $view = "connectForm";
        else header("Location: index.php");
        break;


    case "signUp":
        $errors = [];

        //On vérifie une à une la validité des champs rentrés
        if (isset($_POST["firstname"])) {
            if(!preg_match("#^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð '-]+$#"), $_POST["fistname"])) {
                $errors['firstname']='Veuillez entre un prénom valide';
            }
        }
        else {
                $errors['firstname']='Veuillez entre un prénom';
        }   

        if (isset($_POST["name"])) {
            if(!preg_match("#^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð '-]+$#"), $_POST["name"])) {
                $errors['name']='Veuillez entre un nom valide';
            }
        }
        else {
                $errors['name']='Veuillez entre un nom';
        } 

        if (isset($_POST["email"])) {
            if (preg_match( "#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['mail']))
            {
                $searchUserByEmail = User::selectWhere(array("email" => $_POST["email"]));
                $numberOfUserWith = count($searchUserByUserEmail);
                if($numberOfUserWith > 0){
                    $errors['email'] = "L'email est déjà utilisé !";
                }
            }
            else {
                $errors['email']='Veuillez entre un email !';
            }
        }

        if (isset($_POST["password"])) {
            if (!empty($_POST["password"]))
            {
                
            }
        }

        if (isset($_POST["password_conf"])) {
            if (!empty($_POST["password_conf"]))
            {

            }
        }

        if (isset($_POST["phonenumber"])) {
            if (!empty($_POST["phonenumber"]))
            {

            }
        }

        if (isset($_POST["datebirth"]))
             {
            if (!empty($_POST["datebirth"]))
            {

            }
        }

        if (isset($_POST["city"])) {
            if (!empty($_POST["city"]))
            {

            }
        }


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