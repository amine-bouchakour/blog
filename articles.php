<<<<<<< HEAD
<html>

<head>
<title>All Articles</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="css/blog.css">

</head>


<body>
    
<?php
session_start();
=======
<?php

require_once("libraries/utilities.php");
require_once("libraries/functions.php");

// $idArticle = $_GET["id"];
// var_dump($_GET);
require("templates/header.phtml");
?>
    
<?php
>>>>>>> master

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
    $requetetoutarticles="SELECT * from articles where id_categorie='".$categorie."' ORDER BY date DESC";
    $query=mysqli_query($connexion,$requetetoutarticles);
    $resultattoutarticles=mysqli_fetch_all($query);
    //var_dump($resultattoutarticles);
    // echo $requetetoutarticles;


    $requetelien_nom_id="SELECT nom,id from categories";
    $query1=mysqli_query($connexion,$requetelien_nom_id);
    $resultatlien_nom_id=mysqli_fetch_all($query1);
    
    //var_dump($resultatlien_nom_id);

    $j=0;
    // if(isset($resultatlien_nom_id)){
    //     $titrecategorie=$resultatlien_nom_id[$j][0];
    // }
   
    // echo $titrecategorie

    $nombre_titres=count($resultatlien_nom_id);


    // for ($i=0; $i<$nombre_titres; $i++){ 
    //     echo $resultatlien_nom_id[$i][0].'<br/>';
    //     echo $resultatlien_nom_id[$i][1].'<br/>';
    // }
    

    ?>
                                                                                    <!-- Lien a recuperer pour venir sur cette page -->
                                                                                    <!-- "articles.php?categorie=&titre=&start=" -->

<<<<<<< HEAD
<main id="main_articles">

=======
<main id="main-articles">
    <section  id="section_articles">
>>>>>>> master
    <table>

        <th>
        <ul id="menu-accordeon">
            <li><a href="#" class="titrePrincipal"> <?php if(isset($_GET['titre']) && !empty($_GET['titre'])) {echo $_GET['titre'];} else echo 'Choisir catégories'; ?></a>
            <ul>
            
            <?php 

                for ($i=0; $i<$nombre_titres; $i++){ 
                    if($_GET['titre']!=$resultatlien_nom_id[$i][0]){
                    ?> 
                <li><a href="articles.php?categorie=<?php echo $resultatlien_nom_id[$i][1] ?>&amp;titre=<?php echo $resultatlien_nom_id[$i][0] ?>&amp;start=<?php echo $start=0 ?>"><?php  echo $resultatlien_nom_id[$i][0] ?></a></li> 
                    <?php } $compte=0; } ?>

            <!-- <li><a href="articles.php?categorie=1">1</a></li>
            <li><a href="articles.php?categorie=</a></li>
            <li><a href="articles.php?categorie=3">3</a></li>
            <li><a href="articles.php?categorie=4">4</a></li> -->
        </ul>
            </li>
<<<<<<< HEAD
=======
        </ul>
>>>>>>> master
        </th>
            
            <?php for($k=$_GET['start']; $k<count($resultattoutarticles); $k++){
                ?> 

            <tr><td class="articles"> <a href="article.php?id=<?php echo $resultattoutarticles[$k][0]; ;?>"> <?php echo $resultattoutarticles[$k][1]; $compte++; ?></a></td></tr>

            <?php if($compte==5){break;}  }?>

    </table>


    <?php 
    if($_GET['start']>1){
        
       ?> 
    <section id="pagination">
       
       <a href="articles.php?categorie=<?php echo $_GET['categorie'] ?>&amp;titre=<?php echo $_GET['titre'] ?>&amp;start=<?php echo $start= $_GET['start'] - 5;?>"> Articles précédents</a> 
       <?php }?>

   <?php if(count($resultattoutarticles)>5 && $compte>4){

       ?> 
    <section id="pagination">
       
       <a href="articles.php?categorie=<?php echo $_GET['categorie'] ?>&amp;titre=<?php echo $_GET['titre'] ?>&amp;start=<?php echo $start= $_GET['start'] + 5;?>"> Articles suivants</a>
       <?php }?>
       </section>
<<<<<<< HEAD
=======
       </section>
>>>>>>> master
       </main>                                                                   

    <?php

}
else{
    header("location:index.php");
}


?>
<<<<<<< HEAD

</body>



</html>
=======
<?php require("templates/footer.phtml"); ?>
>>>>>>> master
