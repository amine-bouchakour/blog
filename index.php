<?php
    require_once('api/config.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php if(isset($_SESSION['user'])){
        echo $_SESSION['user']->username; ?>
            <a href="?disconnect">Se deconnecter</a>
   <?php } ?>
</body>
</html>