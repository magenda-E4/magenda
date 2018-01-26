<div class="carousel fade-carousel slide" data-ride="carousel" data-interval="4000" id="bs-carousel">
  <!-- Overlay -->
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#bs-carousel" data-slide-to="0" class="active"></li>
    <li data-target="#bs-carousel" data-slide-to="1"></li>
    <li data-target="#bs-carousel" data-slide-to="2"></li>
  </ol>
  
  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    <div class="item slides active">
      <div class="slide-1"></div>
      <div class="hero">
        <hgroup>
            <h1>We are creative</h1>        
            <h3>
                <?php echo ($userConnected instanceof \Magenda\Model\User)?"Let's see your Magenda !":"Create an account to start the adventure";?>
            </h3>
        </hgroup>
        <a href="index.php?controller=<?php echo ($userConnected instanceof \Magenda\Model\User)?"event&action=seeCalendar&iduser=".$userConnected->getId():"user&action=signUpForm";?>" class="btn btn-hero btn-lg" role="button">
            <?php echo ($userConnected instanceof \Magenda\Model\User)?"Personnal Magenda":"Create an account";?>
        </a>
      </div>
    </div>
    <div class="item slides">
      <div class="slide-2"></div>
      <div class="hero">        
        <hgroup>
            <h1>We are smart</h1>        
            <h3>Just search in the bar bellow for an appointment</h3>
        </hgroup>       
        <a href="#bar" class="btn btn-hero btn-lg" role="button">Go to the bar</a>
      </div>
    </div>
    <div class="item slides">
      <div class="slide-3"></div>
      <div class="hero">        
        <hgroup>
            <h1>We are magenda</h1>        
            <h3>Just click, and that's it.</h3>
        </hgroup>
      </div>
    </div>
  </div> 
</div>


<h1> Bienvenue sur Magenda !</h1>
<hr>

<p>Magenda est une application regroupant toutes les prises de rendez-vous du quotidien : médecin, vétérinaire, dentiste, coiffeur, esthéticienne...
Le principe est simple :
<ul>
	<li>entrez une bonne fois pour toutes vos adresses/contacts favoris</li>
<li>ou choisissez parmi les professionnels près de vous grâce à la localisation GPS.</li>
</ul>

Vous pouvez aller sur la page du service demandé et choisir parmi les horaires de rendez-vous disponibles en fonction de votre besoin (ex : détartrage (~20min) ou soin dentaire (~1h).
Le professionnel recevra une notification, et vous recevrez un message de confirmation (email, sms, notif pop-up...)</p>

<hr>

<h2 id="bar">Faites une recherche...</h1>
<form method="POST" action="">
    <p>
        <input type="text" name="search" id="search" class="form-control"/>
    </p>
</form>
<div id="result">
    <ul>

    </ul>
</div>
<script src="include/js/func.js"></script>