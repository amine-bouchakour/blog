<?php require_once('libraries/config.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    
    <title>Index</title>
</head>



<body id="body_index">

<main id="main_index">
<?php

require_once("libraries/utilities.php");
require_once("libraries/functions.php");

// $idArticle = $_GET["id"];
// var_dump($_GET);
require("templates/header.phtml");
?>

<section id="texte_accueil">
    <p>Bienvenue à tous sur notre blog Music'N Blog ! <br> Vous êtes passionnée de musique et vous voulez en parlez ? <br> c'est içi et pas ailleurs que ça se passe :) <br> Merçi de respecter les autres utilisateurs ainsi que l'équipe de modération <br> On vous attend, vous les Zicos et autres ;) !</p>
</section>

<h1 class="titre0">Les 3 derniers articles</h1>

<section id="lastnews">
<?php
    $connexion=mysqli_connect("localhost","root","","blog");
    $requetetoutarticles="SELECT categories.nom, articles.date, utilisateurs.login, articles.id FROM articles INNER JOIN categories ON categories.id = articles.id_categorie INNER JOIN utilisateurs ON utilisateurs.id = articles.id_utilisateur ORDER BY articles.date DESC";
    $query1=mysqli_query($connexion,$requetetoutarticles);
    $resultattoutarticles=mysqli_fetch_all($query1);
    // var_dump($resultattoutarticles);

    
    for($i=0; $i<3; $i++){
        $date = $resultattoutarticles[$i][1];
        $datef= date('Y-m-d', strtotime($date));

        ?>
        <div id="lastarticles"> <?php 
        echo "<div id=titre>".ucfirst($resultattoutarticles[$i][0])."</div><br/>";
        echo "<a href=\"article.php?id=".$resultattoutarticles[$i][3]."\">Voir l'arcticle</a><br/>";
        echo "By ".ucfirst($resultattoutarticles[$i][2]);
        echo " le ".$datef."<br/>";
        ?> </div> <br>
        <?php
    }



?>
</section>

<div class="aligncenter">
<a href="articles.php?categorie=&titre=&start=" >Voir tous les articles</a>
</div>
<br>
</main>
</body>

<?php require("templates/footer.phtml"); ?>


</html>