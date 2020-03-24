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
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. <br> Ab vero repellendus, culpa eaque recusandae labore dolore aut <br> sunt ex ipsam nesciunt architecto rerum omnis atque ad. <br> Nulla officia tenetur fugit!</p>
</section>

<h1 class="titre0">Les 3 derniers articles</h1>

<section id="lastnews">
<?php
    $connexion=mysqli_connect("localhost","root","","blog");
    $requetetoutarticles="SELECT article,date,nom,login from articles INNER JOIN categories ON articles.id_categorie=categories.id INNER JOIN utilisateurs ON articles.id_utilisateur=utilisateurs.id ORDER BY date DESC";
    $query1=mysqli_query($connexion,$requetetoutarticles);
    $resultattoutarticles=mysqli_fetch_all($query1);
    // var_dump($resultattoutarticles);

    for($i=0; $i<3; $i++){
        ?>
        <div id="lastarticles"> <?php 
        echo "<div id=titre>".ucfirst($resultattoutarticles[$i][2])."</div><br/>";
        echo "Par ".ucfirst($resultattoutarticles[$i][3])."<br/>";
        echo "Titre : ".ucfirst($resultattoutarticles[$i][0])."<br/>";
        echo ucfirst($resultattoutarticles[$i][1])."<br/>";
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