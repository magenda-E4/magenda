<?php
if (isset($errors) AND count($errors) > 0) {
    foreach ($errors as $error) {
        echo $error . "<br />";
    }
}
?>

<!-- Form connection and form inscription -->
<div class = "row">
    <div class = "col-md-6 col-sm-12">
        <form action="?controller=user&action=signUp" method="POST">
            <p>
                <label>Prénom : </label>
                <input type="text" name="firstname" />
            </p>
            <p>
                <label>Nom : </label>
                <input type="text" name="lastname" />
            </p>
            <p>
                <label>Email : </label>
                <input type="email" name="email" />
            </p>
            <p>
                <label>Password : </label>
                <input type="password" name="password" />
            </p>
            <p>
                <label>Confirmez votre password : </label>
                <input type="password" name="password_conf" />
            </p>
            <p>
                <label>N° téléphone : </label>
                <input type="text" name="phonenumber" />
            </p>
            <p>
                <label>Date de naissance : </label>
                <input type="date" name="datebirth" />
            </p>
            <p>
                <label>Ville : </label>
                <input type="text" name="city" />
            </p>
            <p>
                <label>Code postal : </label>
                <input type="text" name="postalcode" />
            </p>
            <p>
                <input type="submit" />
            </p>
        </form>
    </div>
    <div class = "col-md-6 col-sm-12">
        <form action="?controller=user&action=connect" method="POST">
            <p>
                <label>Email : </label>
                <input type="email" name="email" />
            </p>
            <p>
                <label>Password : </label>
                <input type="text" name="password" />
            </p>
            <p>
                <input type="submit" />
            </p>
        </form>
    </div>
</div>
