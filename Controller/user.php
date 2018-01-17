<?php

use Magenda\Model\User;

// Nous commencons par
// verifier si une action
// existe, sinon nous
// en indicons une par defaut
if(strlen($action) <= 0){
    // Aucune action n'est indiqué
    // Nous chargeons par defaut
    // l'action list
    $action = "list";
}
switch ($action){
    // Si l'action est list alors nous devons
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
            if(!preg_match("#^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð '-]+$#", $_POST["firstname"])) {
                $errors['firstname']='Veuillez entre un prénom valide';
            }
        }
        else {
                $errors['firstname']='Veuillez entre un prénom';
        }   

        if (isset($_POST["lastname"])) {
            if(!preg_match("#^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð '-]+$#", $_POST["lastname"])) {
                $errors['lastname']='Veuillez entre un nom valide';
            }
        }
        else {
                $errors['lastname']='Veuillez entre un nom';
        } 

        if (isset($_POST["email"])) {
            if (preg_match( "#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['email']))
            {
                $searchUserByEmail = User::selectWhere(array("email" => $_POST["email"]));
                $numberOfUserWith = count($searchUserByEmail);
                if($numberOfUserWith > 0){
                    $errors['email'] = "L'email est déjà utilisé !";
                }
            }
            else {
                $errors['email']='Veuillez entrer un email !';
            }
        }

        if (!isset($_POST["password"]) OR empty($_POST["password"]) ) {
            $errors['password'] = 'Veuillez entrer un mot de passe';
        }

        if (!isset($_POST["password_conf"]) OR empty($_POST["password_conf"]) ) {
            $errors['password_conf'] = 'Veuillez confirmer votre mot de passe';
        }

        if (!array_key_exists("password", $errors) AND !array_key_exists("password_conf", $errors)) {
            {
                if ($_POST["password"] != $_POST["password_conf"]) {
                    $errors['password_conf'] = 'Le mot de passe et la confirmation ne sont pas identiques !';
                }
            }
        }

        //Inutile pour l'instant, voir une regex qui fonctionne

        if (isset($_POST["datebirth"])) {
            if (!preg_match("#^(0[1-9]|1[012])[-/.](0[1-9]|[12][0-9]|3[01])[-/.](19|20)\\d\\d$#",  $_POST["datebirth"])) {
            }
        }
        else {
            $errors['datebirth']='Veuillez entrer une date de naissance.';
        }
            

        if (isset($_POST["city"])) {
            if (!preg_match("#^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð '-]+$#", $_POST['city']))
            {   
                $errors['city']='Veuillez entrer un nom de ville valide.';
            }
        }
        else {
            $errors['city']='Veuillez entrer votre ville.';
        }

        if (!count($errors)>0)
        {
            $password = User::hashPassword($_POST["password"]);
            User::insert(array(
                "firstname" => $_POST["firstname"],
                "lastname" => $_POST["lastname"],
                "email" => $_POST["email"],
                "password" => $password,
                "phonenumber" => $_POST["phonenumber"],
                "datebirth" => $_POST["datebirth"],
                "city" => $_POST["city"],
                "postalcode" => $_POST["postalcode"]
            ));
        }
        $view= "connectForm";

        break;

       

    case "disconnect":
        if(!is_null($userConnected)){
            session_destroy();
        }
        header("Location: index.php");
        break;

    default :
        $view = "list";
        break;
}