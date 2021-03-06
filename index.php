<?php

// Permet de voir toutes les
// erreurs de php directement
// sur la page
//declare(strict_types=1);


namespace Magenda;
use Magenda\Model\User;

session_start();


include __DIR__ . "/autoload.php";
// Valeur par defaut du contrôleur
$controller = "company";
// Nous verifions si un controller
// est indiqué dans la variable $_GET
if(array_key_exists("controller", $_GET)){
    // Nous verifions que le controller indiqué n'est
    // pas vide
    if(!empty($_GET["controller"])){
        // Nous changeons la valeur
        // de la variable controller
        // par la valeur indiqué
        // par la variable $_GET
        $controller = $_GET["controller"];
    }
}

// Valeur par defaut de l'action
// C'est elle qui indiquera au controller
// ce qu'il doit faire
$action = "";
// Nous verifions si une action
// est indiqué dans la variable $_GET
if(array_key_exists("action", $_GET)){
    // Nous verifions que l'action indiqué n'est
    // pas vide
    if(!empty($_GET["action"])){
        // Nous changeons la valeur
        // de la variable action
        // par la valeur indiqué
        // par la variable $_GET
        $action = $_GET["action"];
    }
}

// Valeur par defaut de l'api
// C'est elle qui indiquera au routeur
// si nous devons utiliser les controller
// de type API
// ou les controller dit 'normaux'
$api = false;
// Nous verifions si une action
// est indiqué dans la variable $_GET
if(array_key_exists("api", $_GET)){
    // Nous verifions que l'action indiqué n'est
    // pas vide
    if(!empty($_GET["api"]) && $_GET["api"] == '1'){
        // Nous changeons la valeur
        // de la variable action
        // par la valeur indiqué
        // par la variable $_GET
        $api = (bool) $_GET["api"];
    }
}

/** @var User $userConnected */
$userConnected = User::whoIsConnected();


// Nous chargeons le controller depuis le dossier
//  Controller
$controllerFilePath = __DIR__ . "/Controller/".(($api)?"api/":"").$controller.".php";
// Nous verifions si le fichier est existant
if(!file_exists($controllerFilePath)){
    // Si le fichier n'existe pas alors nous chargeons
    // le controller d'erreur
    $controller = "error";
    $controllerFilePath = __DIR__ . "/Controller/" .$controller.".php";
}
// Si le fichier est existant nous le chargeons.
// il doit maintenant renvoyer la vue à afficher
// en l'indiquant dans la variable $view;
// Par exemple :
// <code>
//  <?php
//      $controller = "User";
//          Alors nous chargeons le fichier "User.php" dans
//          Le dossier "Controller" tel que : "Controller/User.php"
//      Ce fichier aura une variable $view qui nous permettra
//          de savoir qu'elle view nous devons charger
//           depuis le template.php
//  \?\>
// </code>
$view = "";
require_once $controllerFilePath;

// Nous chargeons maintenant le template
// Il se chargera lui même d'inclure
// la vue souhaitée directement à l'interieur
// du template.
// La Vue est indiquée dans la variable $view
// que le controller doit remplir pour appeler
// la bonne vue dans le template.
// Si nous souhaitons voir l'API, il ne faut pas charger le template
// Nous laissons le controller renvoyer lui même directement les jsons
// correspondant, la vue est alors géré par le Javascript.
if(!$api) require_once __DIR__ . "/View/template.php";
?>