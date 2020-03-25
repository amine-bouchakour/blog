<?php

require_once("libraries/utilities.php");

// if(!isLoged()){
//     if($_SESSION["login"] != "admin" || $_SESSION["login"] != "modo"){
//         redirect("index.php");
//     }
// }

require("templates/header.phtml"); ?>
<main id="main-creart">
<?php

////////// UTILISATEURS //////////

$connexion = getCo();
$requete = "SELECT * FROM `utilisateurs` WHERE login = '".$_SESSION['login']."'";
$query = mysqli_query($connexion,$requete);
$resultat = mysqli_fetch_all($query);

////////// CATEGORIES //////////

$requete_cat = "SELECT * FROM categories";
$query_cat = mysqli_query($connexion, $requete_cat);
$resultat_cat = mysqli_fetch_all($query_cat,MYSQLI_ASSOC);
// var_dump($resultat[0][0]);
// var_dump($resultat_cat);

//////////

$nb_cat = 0;

if(!empty($_SESSION['login'] && $_SESSION['id_droits'] == 42 || $_SESSION['id_droits'] == 1337)): ?>
    <article id="art-of-creart">
        <div id="block-creart">

        </div>
        <div id="block-creart2">
            <h1 id="creart-title">Créer un artilcle</h1>
            <form action="#" method="post" id="form-creart">
                <div id="block-form-creart">
                    <textarea name="textArt" id="textArt" placeholder="Exprimez-vous..."></textarea>
                    <div id="select-containt">
                        <label for="selCat">Choisissez une catégorie !</label>
                        <select name="selCat" id="selCat">
                        <?php foreach($resultat_cat as $cat): ?>
                                <option value="<?php echo $nb_cat ?>"><?php echo $cat["nom"] ?></option>
                        <?php echo $nb_cat++;
                        endforeach ?>
                        </select>
                    </div>
                    <button type="submit" name="creer" id="button-creart">Créer</button>
                </div>
            </form>
        </div>
    </article>
<?php elseif(empty($_SESSION["login"]) && $_SESSION["id_droits"] == 1):

    $erreur = "Vous devez être connecté en tant qu'administrateur ou modérateur pour accéder a cette page";

endif;


if(isset($_POST["creer"])){
    
    $art_txt = extractSafeFromPost("textArt");
    $categorie = filter_input(INPUT_POST, "selCat") +1;

    if($art_txt != ""){

    $requete_insert = "INSERT INTO articles(`id`,`article`,`id_utilisateur`,`id_categorie`,`date`)VALUES(null,'".$art_txt."','".$resultat[0][0]."',$categorie,now())";
    $query_insert = mysqli_query($connexion,$requete_insert); ?>
    <meta http-equiv="refresh" content="0;URL=index.php">
<?php    }else {

    $erreur = "Veuillez inclure du texte a votre article";
    }
    
}
if(isset($erreur)): ?>
    <div id="error-txt-creart"><?php echo $erreur ?></div>
<?php endif; ?>

</main>
<?php
require("templates/footer.phtml");
?>
