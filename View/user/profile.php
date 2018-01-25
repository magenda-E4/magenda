<h2>Mon profil</h2>
      <p>Les informations de mon compte</p>            
      <table class="table table-striped">
        <tbody>
          <tr>
            <td>Prénom</td>
            <td><?= $currentUser->getFirstname();?></td>
          </tr>
          <tr>
            <td>Nom</td>
            <td><?= $currentUser->getLastname();?></td>
          </tr>
          <tr>
            <td>Email</td>
            <td><?= $currentUser->getEmail();?></td>
          </tr>
          <tr>
            <td>Numéro de téléphone</td>
            <td><?= $currentUser->getPhoneNumber();?></td>
          </tr>
          <tr>
            <td>Date de naissance</td>
            <td><?= $currentUser->getDateBirthString();?></td>
          </tr>
          <tr>
            <td>Adresse</td>
            <td><?= $currentUser->getAddress() . ", " . $currentUser->getPostalCode() . " " . $currentUser->getCity() ?></td>
          </tr>
        </tbody>
      </table>

<h2>Changer mon mot de passe </h2>


<button class="btn btn-info" id = "showForm" value=""> <span class="glyphicon glyphicon-edit"></span>  Changer de mot de passe</button> <br> <br>

<?php if (!empty($errors)) { ?> 
    <p class="errors">Une erreur est survenue.</p>
<?php } ?>

<?php
if (isset($success['newPwd'])) { ?>
  <p class = "success"><?= $success['newPwd']; ?></p>
<?php } ?>

<div class = "show-onclick">
    <form class = form-horizontal action="?controller=user&action=changePass" method="POST">
        <div class="form-group">
            <label class="control-label col-sm-2">Ancien mot de passe :</label>
            <div class="col-sm-10">
              <input type="password" class="form-control"  name="previousPwd">
            </div>
            <?php if (isset($errors['prevPwd'])) { ?> 
                  <p class="errors"><?= $errors['prevPwd'];?></p>
            <?php } ?>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2">Nouveau mot de passe : </label>
            <div class="col-sm-10">
              <input type="password" class="form-control"  name = "newPwd">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" >Confirmez votre mot de passe</label>
            <div class="col-sm-10">
              <input type="password" class="form-control" name = "newPwd_conf">
            </div>
            <?php if (isset($errors['newPwd'])) { ?> 
                  <p class="errors"><?= $errors['newPwd'];?></p>
            <?php } ?>
        </div>

        <button class="btn btn-success" type="submit" value=""><span class="glyphicon glyphicon-ok-sign"></span> Valider le nouveau mot de passe</button> <br> 
    </form>
</div>

