<!-- Form connection and form inscription -->
    <div class = "row">
        <div class = "col-md-6 col-sm-12">
            <h4> Se créer un compte est simple et rapide avec Magenda ! </h4>
            <form action="?controller=user&action=signUp" method="POST">
                <p>
                    <label>Prénom : </label> <br>   
                    <input class="form-control" type="text" name="firstname" value= "<?php if (isset($_POST["firstname"])){ echo $_POST["firstname"];}?>" />  
                    <?php if (isset($errors['firstname'])) { ?> 
                        <p class="errors"><?= $errors['firstname']?></p>
                    <?php } ?>
                </p>
                <p>
                    <label>Nom : </label> <br>
                    <input class="form-control" type="text" name="lastname" value="<?php if (isset($_POST["lastname"])){ echo $_POST["lastname"];}?>" />
                    <?php if (isset($errors['lastname'])) { ?> 
                        <p class="errors"><?= $errors['lastname']?></p>
                    <?php } ?>
                </p>
                <p>
                    <label>Email : </label> <br>
                    <input class="form-control" type="email" name="email" value="<?php if (isset($_POST["email"])){ echo $_POST["email"];}?>" />
                    <?php if (isset($errors['email'])) { ?> 
                        <p class="errors"><?= $errors['email']?></p>
                    <?php } ?>
                </p>
                <p>
                    <label>Password : </label> <br>
                    <input class="form-control" type="password" name="password" />
                    <?php if (isset($errors['password'])) { ?> 
                        <p class="errors"><?= $errors['password']?></p>
                    <?php } ?>
                </p>
                <p>
                    <label>Confirmez votre password : </label> <br>
                    <input class="form-control" type="password" name="password_conf" />
                    <?php if (isset($errors['password_conf'])) { ?> 
                        <p class="errors"><?= $errors['password_conf']?></p>
                    <?php } ?>
                </p>
                <p>
                    <label>N° téléphone : </label> <br>
                    <input class="form-control" type="text" name="phonenumber" value="<?php if (isset($_POST["phonenumber"])){ echo $_POST["phonenumber"];}?>"/>
                    <?php if (isset($errors['phonenumber'])) { ?> 
                        <p class="errors"><?= $errors['phonenumber']?></p>
                    <?php } ?>
                </p>
                <p>
                    <label>Date de naissance : </label> <br>
                    <input class="form-control" type="date" name="datebirth" value="<?php if (isset($_POST["datebirth"])){ echo $_POST["datebirth"];}?>"/>
                    <?php if (isset($errors['datebirth'])) { ?> 
                        <p class="errors"><?= $errors['datebirth']?></p>
                    <?php } ?>
                </p>
                 <p>
                    <label>Adresse : </label> <br>
                    <input class="form-control" type="text" name="address" value="<?php if (isset($_POST["address"])){ echo $_POST["address"];}?>"/>
                    <?php if (isset($errors['address'])) { ?> 
                        <p class="errors"><?= $errors['address']?></p>
                    <?php } ?>
                </p>
                <p>
                    <label>Ville : </label> <br>
                    <input class="form-control" type="text" name="city" value="<?php if (isset($_POST["city"])){ echo $_POST["city"];}?>"/>
                    <?php if (isset($errors['city'])) { ?> 
                        <p class="errors"><?= $errors['city']?></p>
                    <?php } ?>
                </p>
                <p>
                    <label>Code postal : </label> <br>
                    <input class="form-control" type="text" name="postalcode" value="<?php if (isset($_POST["postalcode"])){ echo $_POST["postalcode"];}?>"/>
                    <?php if (isset($errors['postalcode'])) { ?> 
                        <p class="errors"><?= $errors['postalcode']?></p>
                    <?php } ?>
                </p>
                <button class="btn btn-primary" type="submit" value=""><span class="glyphicon glyphicon-ok-sign"></span> S'inscrire</button> <br>
            </form>
        </div>
        <div class = "col-md-6 col-sm-12">
            <h4>Vous possédez déjà un compte ? Connectez-vous !</h4>
            <form action="?controller=user&action=connect" method="POST">
                <?php if (isset($errors[0])) { ?> 
                    <p class="errors"><?= $errors[0] ?></p>
                <?php } ?>
                <p>
                    <label>Email : </label> <br>
                    <input class="form-control" type="email" name="email" value="<?php if (isset($_POST["email"])){ echo $_POST["email"];}?>" />
                </p>
                <p>
                    <label>Password : </label> <br>
                    <input class="form-control" type="password" name="password" />

                </p>
                <button class="btn btn-primary" type="submit" value=""><span class="glyphicon glyphicon-ok-sign"></span> Se connecter</button> <br>
            </form>
        </div>
    </div>
