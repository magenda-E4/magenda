<?php
use Magenda\Model\User;
?>
<div>

    <h1>Liste des utilisateurs du site</h1>
    <?php
    // J'arrive ici avec la variable $users
    // qui m'a était indiqué dans le contrôleur
    // Controller/user.php

    // Nous verifions que nous avons bien des utilisateurs
    if(count($users) > 0){

        // Si il y a des utilisateurs
        // alors nous affichons une liste
        // avec leur nom et prénom
        echo "<ul>";
        /** @var User $user */
        foreach ($users as $user) {
            echo "<li>".$user->getFirstname()." ".$user->getLastname()."</li>";
        }
        echo "</ul>";

    } else{
        // Si il n'y a pas d'utilisateurs
        // alors nous affichons un message
        echo "Il n'existe aucun utilisateur dans la base de données";
    }
    ?>

</div>
