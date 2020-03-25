<?php
require_once('libraries/config.php');
require_once("libraries/utilities.php");
require_once("libraries/functions.php");
if(isset($_POST['del_com'])){
    $idcom = $_POST['id_com'];
    $db = mysqli_connect('localhost', 'root', '', 'blog');
    mysqli_query($db, "DELETE FROM commentaires WHERE id = '$idcom'");
    ob_start();
}
$idArticle = $_GET["id"];
// var_dump($_GET);

require("templates/header.phtml");
               
if(isset($_POST["envoyer"])){

    $comment = extractSafeFromPost("commentaire");
    if(isset($_SESSION["user"])){
        if(!empty($comment)){
        $username = $_SESSION['user']->username;
        $requete_user = "SELECT id FROM utilisateurs WHERE login = '$username'";
        $query_user = mysqli_query($connexion,$requete_user);
        $resultat_user= mysqli_fetch_all($query_user);

        $requete = "INSERT INTO `commentaires`(`id`, `commentaire`, `id_article`, `id_utilisateur`, `date`) VALUES (null,\"$comment\",\"$idArticle\",'".$resultat_user[0][0]."',now())";
        $query = mysqli_query($connexion,$requete); ?>
        <meta http-equiv="refresh" content="0;URL=article.php?id=<?php echo $idArticle ?>">
        <?php } else {
            $erreur = "Veuillez entrer un commentaire";
        }
    } else {
        $erreur = "Vous devez être connecté pour poster un commentaire";
    }
}
?>

    <main id="main-art">
        <?php

////////// ARTICLES //////////

        $requete = "SELECT * FROM articles WHERE id = \"$idArticle\"";
        $query = mysqli_query($connexion,$requete);
        $resultat = mysqli_fetch_all($query, MYSQLI_ASSOC);
        
////////// COMMENTAIRES //////////

        $requete_com = "SELECT u.id, u.login, c.commentaire, c.date, c.id FROM utilisateurs AS u INNER JOIN `commentaires` AS c ON u.id = c.id_utilisateur WHERE id_article = \"$idArticle\"";
        $query_com = mysqli_query($connexion,$requete_com);
        $resultat_com = mysqli_fetch_all($query_com);

////////// STOCK ARTICLES //////////

        // var_dump($resultat[0]["article"]);
        $date = $resultat[0]["date"];
        $annee = strftime("%Y", strtotime($date));
        $mois = strftime("%B", strtotime($date));
        $jour = strftime("%d", strtotime($date));
        $sJour = strftime("%w", strtotime($date));
        $heure = strftime("%R", strtotime($date));
        if($sJour == 0){
            $sJour = 7;
        }
        $sJour2 = transDays($sJour);
        $mois2 = transMonths($mois);

//////////

        ?>
        <section id="sec-art">
            <article id="the-article">
                <p id="pgp-art"><?php echo $resultat[0]["article"]; ?></p>
                <span id="creation">créé le <?php echo $sJour2 ?> <?php echo $jour?> <?php echo $mois2?> <?php echo $annee?> à <?php echo $heure ?></span>
            </article>
            <aside id="art-aside">
            <h2 id="title-of-coment">Commentaires</h2>
            <?php foreach($resultat_com as $com):
                $date_com = $com[3];
                $annee_com = strftime("%Y", strtotime($date_com));
                $mois_com = strftime("%B", strtotime($date_com));
                $jour_com = strftime("%d", strtotime($date_com));
                $sJour_com = strftime("%w", strtotime($date_com));
                $heure_com = strftime("%R", strtotime($date_com));
                if($sJour_com == 0){
                    $sJour_com = 7;
                }
                $sJour_com2 = transDays($sJour_com);
                $mois_com2 = transMonths($mois_com);
                
                
                
                ?>
                <div id="one-coment">
                <p id="par-com"><?php echo $com[2] ?></p>
                <span id="sp">
                    <?php if($_SESSION['user']->droits == "42" || $_SESSION['user']->droits == "1337" || $com[0] == $_SESSION['user']->id){ ?>
                        <form method="post" style="margin-right: 50px;"><input type="hidden" name="id_com" value="<?php echo $com[4]; ?>"><input type="submit" style="border: none; cursor: pointer; background-color: red; color: white;" name="del_com" value="X"></form>
                    <?php } ?>
                    #Posté le <?php echo $sJour_com2 ?> <?php echo $jour_com ?> <?php echo $mois_com2 ?> <?php echo $annee_com ?> à <?php echo $heure_com ?>  par <mark> <?php echo $com[1]; ?></mark> </span>
                </div>
            <?php endforeach; ?>
            </aside>

            <article id="coment-container">
                <h2 id="coment-title">Laisser un commentaire</h2>
                <?php
            if(isset($erreur)): ?>
                <div id="error-article"><?php echo $erreur ?></div>    
            <?php endif;?>
                <form action="<?php echo "article.php?id=$idArticle" ?>" method="post" id="form-article">
                    <textarea name="commentaire" id="area-art" cols="30" rows="10" ></textarea>
                    <button type="submit" name="envoyer" id="but-sendart">Envoyer le commentaire</button>
                </form>

               
            </article>
            
        </section>
    </main>
<?php require("templates/footer.phtml"); ?>
<?php ob_end_flush(); ?>