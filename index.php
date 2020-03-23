<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    
    <title>Index</title>
</head>



<body>





<h1>Les 3 derniers articles</h1>


<?php
    $connexion=mysqli_connect("localhost","root","","blog");
    $requetetoutarticles="SELECT article,date,nom,login from articles INNER JOIN categories ON articles.id_categorie=categories.id INNER JOIN utilisateurs ON articles.id_utilisateur=utilisateurs.id ORDER BY date DESC";
    $query1=mysqli_query($connexion,$requetetoutarticles);
    $resultattoutarticles=mysqli_fetch_all($query1);
    // var_dump($resultattoutarticles);

    for($i=0; $i<3; $i++){
        ?>
        <div> <?php 
        echo "Catégorie = ".ucfirst($resultattoutarticles[$i][2])."<br/>";
        echo "Login = ".ucfirst($resultattoutarticles[$i][3])."<br/>";
        echo "Articles = ".ucfirst($resultattoutarticles[$i][0])."<br/>";
        echo "Date de parution = ".ucfirst($resultattoutarticles[$i][1])."<br/>";
        ?> </div> <br>
        <?php
    }



?>






</body>



</html>