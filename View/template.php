<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Magenda</title>
</head>
<body>
<?php
var_dump($_SESSION);
?>
<?php
    require_once __DIR__ ."/".$controller."/".$view.".php";
?>
</body>
</html>