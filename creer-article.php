<html>

<?php

if(isset($_SESSION['login']) and $_SESSION['login']=='modérateur' or $_SESSION['login']=='administrateur'){

?>

    <head>
        <title>Créer Article</title>
        <link rel="stylesheet" href="style.css">
    </head>

    <header>

    </header>

    <body>

            Une page permettant de créer des articles (creer-article.php) :
        Cette page possède un formulaire permettant aux modérateurs et
        administrateurs de créer de nouveaux articles. Le formulaire contient donc
        le texte de l’article, une liste déroulante contenant les catégories existantes
        en base de données et un bouton submit.

        <?php








        ?>


    </body>

    <footer>

    </footer>


<?php
}
elseif(empty($_SESSION['login'])){
    header("location:connexion.php");
}
else{
    header("location:index.php");

}
?>


</html>