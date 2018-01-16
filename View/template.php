<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Magenda</title>

    <!-- Bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

</head>
<body>
	<?php
	var_dump($_SESSION);
	?>
	<?php
	    require_once __DIR__ ."/".$controller."/".$view.".php";
	?>
</body>

	<!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <!-- Javascript de Bootstrap -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

</html>