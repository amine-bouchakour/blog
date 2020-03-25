<?php

require_once("libraries/utilities.php");
require_once("libraries/functions.php");

$idArticle = $_GET["id"];
// var_dump($_GET);
require("templates/header.phtml");
?>
    <main id="main-art">
        <?php

////////// ARTICLES //////////

        $requete = "SELECT * FROM articles WHERE id = \"$idArticle\"";
        $query = mysqli_query($connexion,$requete);
        $resultat = mysqli_fetch_all($query, MYSQLI_ASSOC);
        
////////// COMMENTAIRES //////////

        $requete_com = "SELECT u.id, u.login, c.commentaire, c.date FROM utilisateurs AS u INNER JOIN `commentaires` AS c ON u.id = c.id_utilisateur WHERE id_article = \"$idArticle\"";
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
        <section>
            <article>
                <p id="pgp-art"><?php echo $resultat[0]["article"]; ?></p>
                <span>créé le <?php echo $sJour2 ?> <?php echo $jour?>.<?php echo $mois2?>.<?php echo $annee?> à <?php echo $heure ?></span>
            </article>
            <aside>
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
                <p><?php echo $com[2] ?></p>
                <span>#Posté le <?php echo $sJour_com2 ?> <?php echo $jour_com ?> <?php echo $mois_com2 ?> <?php echo $annee_com ?> à <?php echo $heure_com ?>  par <?php echo $com[1]; ?> </span>
            <?php endforeach; ?>
            </aside>





            <article>
                <h2>Laisser un commentaire</h2>
                <form action="<?php echo "article.php?id=$idArticle" ?>" method="post">
                    <textarea name="commentaire" id="" cols="30" rows="10"></textarea>
                    <button type="submit" name="envoyer">Envoyer le commentaire</button>
                </form>

                <?php
                    
                    if(isset($_POST["envoyer"])){

                    $comment = extractSafeFromPost("commentaire");

                    $requete_user = "SELECT id FROM utilisateurs WHERE login = '".$_SESSION['login']."'";
                    $query_user = mysqli_query($connexion,$requete_user);
                    $resultat_user= mysqli_fetch_all($query_user);

                    $requete = "INSERT INTO `commentaires`(`id`, `commentaire`, `id_article`, `id_utilisateur`, `date`) VALUES (null,\"$comment\",\"$idArticle\",'".$resultat_user[0][0]."',now())";
                    $query = mysqli_query($connexion,$requete);

                    }
                ?>
            </article>
        </section>
    </main>
<?php require("templates/footer.phtml"); ?>