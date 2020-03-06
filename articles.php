<html>

<head>
<title>All Articles</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="bloog.css">
</head>

Sur cette page, les utilisateurs peuvent voir l’ensemble des articles, triés du
plus récents au plus anciens. S’il y a plus de 5 articles, seuls les 5 premiers
sont affichés et un système de pagination permet d’afficher les 5 suivants
(ou les 5 précédents). Pour cela, il faut utiliser l’argument GET “start”.
ex : https://localhost/blog/articles.php/?start=5 affiche les articles 6 à 10.
La page articles peut également filtrer les articles par catégorie à l’aide de
l’argument GET “categorie” qui utilise les id des categories.
ex : https://localhost/blog/articles.php/?categorie=1&start=10 affiche les
articles 11 à 15 ayant comme id_categorie 1).




<?php
session_start();

if(isset($_SESSION['login']) and !empty($_SESSION['login'])){

    $categorie=$_GET["categorie"];

    if(!isset($categorie)){
        $categorie=$id_categorie[3];
    }
    else{
        $categorie=$_GET["categorie"];
    }



    // CONNEXION BASE DE DONNEE
    $connexion=mysqli_connect("localhost","root","","blog");
    $requetetoutarticles="SELECT * from articles where id_categorie='".$categorie."' ORDER BY date ASC";
    $query=mysqli_query($connexion,$requetetoutarticles);
    $resultattoutarticles=mysqli_fetch_all($query);
    var_dump($resultattoutarticles);
    echo $requetetoutarticles;

    $requetelien_nom_id="SELECT nom,id_categorie from articles INNER JOIN categories where articles.id_categorie=categories.id";
    $query=mysqli_query($connexion,$requetelien_nom_id);
    $resultatlien_nom_id=mysqli_fetch_all($query);
    var_dump($resultatlien_nom_id);

    $j=0;
    // if(isset($resultatlien_nom_id)){
    //     $titrecategorie=$resultatlien_nom_id[$j][0];
    // }
   
    // echo $titrecategorie
    

    ?>



    <table>
        <th>
        <ul id="menu-accordeon">
            <li><a href="#"> <?php if(isset($_GET['categorie'])) {echo $_GET['categorie'];} else echo 'Choisir catégories'; ?></a>
            <ul>
<?php
            foreach($resultatlien_nom_id as $titrecategorie){
               ?> <li><a href="articles.php?categorie=<?php echo $titrecategorie[0] ?>"><?php echo $titrecategorie[0] ?></a></li> 
               
               <?php
            }
?>
            <!-- <li><a href="articles.php?categorie=1">1</a></li>
            <li><a href="articles.php?categorie=<?php echo $resultatlien_nom_id[0][0] ?>"><?php echo $resultatlien_nom_id[0][0] ?></a></li>
            <li><a href="articles.php?categorie=3">3</a></li>
            <li><a href="articles.php?categorie=4">4</a></li> -->
        </ul>
            </li>
        </th>
            
            <?php 

    foreach($resultattoutarticles as $article){
        ?> 
            <tr><td><?php echo $article[1] ?></td></tr>
        <?php
    }
        ?>

    </table>



    <?php




}
else{
    header("location:index.php");
}


?>


</html>