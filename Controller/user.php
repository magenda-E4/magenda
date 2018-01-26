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
    $action = "connect";
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

    /**
     * Permet de se connecter
     > on vérifie si l'user n'est pas déjà connecté
     > on vérifie si l'email et le password sont bien entrés
     > on vérifie si ils correspondent dans la BDD
     > on le connecte (creation de session)
     */
    case "connect":
        $errors = [];

        if(!is_null($userConnected)) header("Location: index.php");

        if(isset($_POST["email"]) && isset($_POST["password"])) {
            if(!empty($_POST["email"]) || !empty($_POST["password"])){
                $password = User::hashPassword($_POST["password"]);
                $searchUserByUsernameAndPassword = User::selectWhere(array(
                   "email" => strtolower($_POST["email"]),
                    "password" => $password
                ));
                $numberOfUserWith = count($searchUserByUsernameAndPassword);
                if($numberOfUserWith > 0){
                    /** @var User $currentUser */
                    $currentUser = $searchUserByUsernameAndPassword[0];
                    $_SESSION["id"] = $currentUser->getId();
                }else{
                    $errors[] = "L'email ou le mot de passe sont incorrects.";
                }
            }
            else{
                $errors[] = "Veuillez entrer un email ET un mot de passe.";
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

    /**
     * Permet d'ouvrir le form de connexion
     */

    case "signUpForm":
        $errors = [];
        if(is_null($userConnected)) $view = "connectForm";
        else header("Location: index.php");
        break;

    /**
     * Une fois que l'utilisateur clique sur "S'inscrire"
     > on vérifie le firstname (bien entré, regex)
     > idem avec le lastname
     > idem avec l'email + verif si déjà existant
     > on vérfie le password
     > on vérifie le numéro de telephone (bien entré, regex)
     > idem pour adresse, code postal, ville...
     > si il n'y a aucune erreur, on entre l'utilisateur dans la BDD

     */
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
                $searchUserByEmail = User::selectWhere(array("email" => strtolower($_POST["email"])));
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

        if (isset($_POST["phonenumber"])) {
            if (!preg_match("#^(?:(?:\+|00)33[\s.-]{0,3}(?:\(0\)[\s.-]{0,3})?|0)[1-9](?:(?:[\s.-]?\d{2}){4}|\d{2}(?:[\s.-]?\d{3}){2})$#", $_POST["phonenumber"])) {
                $errors['phonenumber']='Veuillez entrer un numéro de téléphone valide';
            }
        }
        else {
            $errors['phonenumber'] = 'Veuillez entrer votre numéro de téléphone';
        }

        if (!array_key_exists("password", $errors) AND !array_key_exists("password_conf", $errors)) {
            {
                if ($_POST["password"] != $_POST["password_conf"]) {
                    $errors['password_conf'] = 'Le mot de passe et la confirmation ne sont pas identiques !';
                }
            }
        }

        if (!isset($_POST["address"]) OR empty($_POST["address"])) 
            $errors['adress']='Veuillez entrer votre adresse.';
            

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
                "email" => strtolower($_POST["email"]),
                "password" => $password,
                "phonenumber" => $_POST["phonenumber"],
                "datebirth" => $_POST["datebirth"],
                "address" => $_POST["address"],
                "city" => $_POST["city"],
                "postalcode" => $_POST["postalcode"]
            ));

            header("Location: index.php");
        }
        $view= "connectForm";

        break;

     /**
     * Permet d'ouvrir la page "Mon profil" en envoyant les données du compte courant
     */   
    case "seeProfile":
        if(!is_null($userConnected)) 
        {
            $searchUserByID = User::selectWhere(array("id" => $_SESSION["id"]));
            $currentUser = $searchUserByID[0];
            $view = "profile";
        }
        else header("Location: index.php");
        break;

    /**
     * Permet de changer le mot de passe de l'utilisateur après l'avoir vérifié
     */
    case "changePass":
        $errors = [];
        $success=[];
        if(!is_null($userConnected))
        {
            $password = User::hashPassword($_POST["previousPwd"]);

            if ($userConnected->getPassword() != $password) $errors['prevPwd']='Votre ancien mot de passe est incorrect';
            if ($_POST["newPwd"] != $_POST["newPwd_conf"]) $errors['newPwd']='Les mots de passes ne correspondent pas';
            if (!count($errors)>0)
            {
                $newPassword = User::hashPassword($_POST["newPwd"]);
                $userConnected->update(array("password" => $newPassword));
                $success['newPwd']="Votre mot de passe a bien été modifié !";
            }
            $view="profile";
            $currentUser=$userConnected;
        }
        else header("Location: index.php");
        break;

     /**
     * Deconnexion (détruit la session)
     */
    case "disconnect":
        if(!is_null($userConnected)){
            session_destroy();
        }
        header("Location: index.php");
        break;

    case "team":
        $view = "team";
        break;

    /**
    * Vue par défaut
    */
    default :
        $view = "list";
        break;
}