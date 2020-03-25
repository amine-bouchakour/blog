<?php
    require_once('libraries/config.php');
    if(isset($_SESSION['user'])){
        header('Location: index.php');
    }
    $error = false;
    $msg = "";
    if(isset($_POST['login_button'])){
        if($_POST['login_mail'] != "" && $_POST['login_password'] != ""){
            $mail = trim(htmlspecialchars($_POST['login_mail']));
            $password = trim(htmlspecialchars($_POST['login_password']));
            $user = new User;
            $error = $user->login($mail, $password);
            if($error == true){
                $user = null;
            }else{
                $_SESSION['user'] = $user;
            }
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
    <link rel="stylesheet" href="css/blog.css">
    <title>Connexion</title>
</head>
<body>
    <header id="form">
        <a href="" id="home-link"><h1>Music'n blog</h1></a>
        <a href="inscription.php" id="login-link-button"><button>Inscription</button></a>
    </header>
    <main id="login">
        <div id="content">
            <div class="part title-part">
                <p>Connexion</p>
            </div>
            <div class="part form-part">
                <form method="post">
                    <input type="email" name="login_mail" placeholder="Adresse e-mail" required>
                    <input type="password" name="login_password" placeholder="Mot de passe" required>
                    <?php if($msg != ""){ ?>
                    <p class="error"><?php echo $msg; ?></p>
                   <?php }elseif($error == true){ ?>
                    <p class="error">Identifiant ou mot de passe incorrecte</p>
                  <?php } ?>
                    <input type="submit" name="login_button" value="Connexion">
                    <p>Pas encore inscrit ? <a href="inscription.php">Inscription</a></p>
                </form>
            </div>
        </div>
    </main>







</body>
</html>