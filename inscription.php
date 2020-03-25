<?php
    require_once('api/config.php');
    if(isset($_SESSION['user'])){
        header('Location: index.php');
    }


    $msg = "";
    if(isset($_POST['register_button'])){
        if($_POST['register_username'] != "" && $_POST['register_mail'] != "" && $_POST['register_password'] != "" && $_POST['register_cpassword'] != ""){
            $username = trim(htmlspecialchars($_POST['register_username']));
            $mail = trim(htmlspecialchars($_POST['register_mail']));
            $password = trim(htmlspecialchars($_POST['register_password']));
            $cpassword = trim(htmlspecialchars($_POST['register_cpassword']));
            $user = new User;
            $msg = $user->register($username, $mail, $password, $cpassword);
        }
        else{
            $msg = "Veuillez remplir tous les champs";
        }
    }

?>




<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="blog.css">
    <link rel="stylesheet" href="api/animations.css">
    <title>Inscription</title>
</head>
<body>
    <header id="form">
        <a href="" id="home-link"><h1>Music'n blog</h1></a>
        <a href="connexion.php" id="login-link-button"><button>Connexion</button></a>
    </header>
    <main id="login">
        <div id="content">
            <div class="part title-part">
                <p>Inscription</p>
            </div>
            <div class="part form-part">
                <form method="post">
                    <input type="text" name="register_username" placeholder="Nom d'utilisateur" required>
                    <input type="email" name="register_mail" placeholder="Adresse e-mail" required>
                    <input type="password" name="register_password" placeholder="Mot de passe" required>
                    <input type="password" name="register_cpassword" placeholder="Confirmer le mot de passe" required>
                    <?php if($msg != ""){
                    ?>
                    <p class="error"><?php echo $msg; ?></p>
                    <?php } ?>
                    <input type="submit" name="register_button" value="S'inscrire">
                    <p>Déjà inscrit ? <a href="connexion.php">Connexion</a></p>
                </form>
            </div>
        </div>
    </main>







    <?php require_once('footer.php'); ?>
</body>
</html>