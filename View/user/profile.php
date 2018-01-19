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

<button class="btn btn-info" id = "showForm" value=""><span class="glyphicon glyphicon-ok-sign"></span>  Changer de mot de passe </button> <br> <br>

<div class = "show-onclick">
    <form class = form-horizontal action="" method="POST">
        <div class="form-group">
            <label class="control-label col-sm-2" name="previousPwd">Ancien mot de passe :</label>
            <div class="col-sm-10">
              <input type="password" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" name = "newPwd">Nouveau mot de passe : </label>
            <div class="col-sm-10">
              <input type="password" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" name = "newPwd_conf">Confirmez votre mot de passe</label>
            <div class="col-sm-10">
              <input type="password" class="form-control">
            </div>
        </div>

        <button class="btn btn-success" type="submit" value=""><span class="glyphicon glyphicon-ok-sign"></span> Valider le nouveau mot de passe</button> <br> 
    </form>
</div>

