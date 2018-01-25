<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Magenda</title>

    <!-- Bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- Stylesheet -->
    <link href="include/css/style.css" rel="stylesheet" />

    <link rel="icon" type="image/png" href="include/img/favicon.png" />

</head>
<body>  
    <nav class="navbar navbar-default" role="navigation">
      <div class = "container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
             <a class="navbar-brand <?php if(!isset($_GET['action']) OR $_GET['action']=='home' OR empty($_GET['action'])) { echo 'brandactive';} ?>"  href="index.php"><img src ="include/img/Magenda_logo_wide.png" alt="Magenda"></a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar">
              <li <?php if(isset($_GET['action'])) if ($_GET['action']=='page1') { echo 'class="active"'; } ?>><a href="index.php">Page 1</a></li>
              <li <?php if(isset($_GET['action'])) if ($_GET['action']=='page2') { echo 'class="active"'; } ?>><a href="index.php">Page 2</a></li>
            </ul>
        <?php if(is_null($userConnected)) { ?>
            <ul class="nav navbar-nav navbar-right">
              <li <?php if(isset($_GET['action'])) if ($_GET['action']=='signUpForm' OR $_GET['action']=='signUp' OR $_GET['action']=='connect') { echo 'class="active"'; } ?>><a href="index.php?controller=user&action=signUpForm"><span class="glyphicon glyphicon-user"></span>     S'inscrgire</a></li>
            </ul>
        <?php } else { ?>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="index.php?controller=user&action=seeProfile"><span class="glyphicon glyphicon-user"></span>     Mon profil</a></li>
          <li><a href="index.php?controller=user&action=disconnect"><span class="glyphicon glyphicon-log-out"></span>     Déconnexion</a></li>
        </ul>
        <?php } ?>
        </div>
      </div>
    </nav>

    <div class = "container">
	<?php
	    require_once __DIR__ ."/".$controller."/".$view.".php";
	?>
    </div>
</body>

	<!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <!-- Javascript de Bootstrap -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

    <script> 
      $(document).ready(function() {
        $('#showForm').click(function() {
          $('.show-onclick').fadeToggle(1000);
        });
      });
    </script>

</html>