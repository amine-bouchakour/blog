<?php
    require_once('libraries/config.php');
    if(empty($_SESSION['user'])){
        header('Location: connexion.php');
    }
    $msg = "";
    if(isset($_POST['modify_button'])){
        if($_POST['modify_username'] != "" && $_POST['modify_mail'] != "" && $_POST['modify_password'] != "" && $_POST['modify_cpassword'] != ""){
            $username = trim(htmlspecialchars($_POST['modify_username']));
            $mail = trim(htmlspecialchars($_POST['modify_mail']));
            $password = trim(htmlspecialchars($_POST['modify_password']));
            $cpassword = trim(htmlspecialchars($_POST['modify_cpassword']));
            $msg = $_SESSION['user']->modify($username, $mail, $password, $cpassword);
        }
        else{
            $msg = "Veuillez remplir tous les champs";
        }
    }
    if(isset($_POST['change_avatar'])){
        $file = $_FILES['avatar_file'];
        $msg = $_SESSION['user']->changeAvatar($file);
    }
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/blog.css">
    <title><?php echo $_SESSION['user']->username; ?> | Music'n Blog</title>
</head>
<body>
    <?php require_once('templates/header.phtml'); ?>
    <main class="admin_profil" id="profil">
        <nav>
            <div class="nav-link current"><a href="profil.php">Infos</a></div>
            <?php
            if($_SESSION['user']->droits == "1337"){
            ?>
                <div class="nav-link"><a href="admin.php">Administrateur</a></div>
            <?php } ?>
        </nav>
        <section>
            <article>
                <div class="content" id="two">
                    <img src="<?php echo $_SESSION['user']->avatar; ?>"/>
                    <p><?php echo $_SESSION['user']->username; ?></p>
                    <p><?php echo $_SESSION['user']->mail; ?></p>
                    <p>
                    <?php
                        if($_SESSION['user']->droits == "1337"){
                            echo "Administrateur";
                        }elseif($_SESSION['user']->droits == "42"){
                            echo "Modérateur";
                        }
                        elseif($_SESSION['user']->droits == "1"){
                            echo "Lecteur";
                        }
                    ?>
                    </p>
                    <a href="?disconnect">Se déconnecter</a>
                </div>
                <div class="content" id="three">
                    <form method="post">
                        <input type="text" name="modify_username" value="<?php echo $_SESSION['user']->username; ?>">
                        <input type="email" name="modify_mail" value="<?php echo $_SESSION['user']->mail; ?>">
                        <input type="password" name="modify_password" placeholder="Mot de passe">
                        <input type="password" name="modify_cpassword" placeholder="Confirmer mot de passe">
                        <input type="submit" value="Modifier" name="modify_button">
                        <?php if($msg != ""){
                        ?>
                        <p class="error"><?php echo $msg; ?></p>
                        <?php } ?>
                    </form>
                </div>
                <div class="content" id="four">
                    <p>Changer d'avatar</p>
                    <form method="post" enctype="multipart/form-data">
                        <input type="file" name="avatar_file">
                        <input type="submit" name="change_avatar" value="Upload">
                    </form>
                </div>
            </article>
        </section>
    </main>
    <?php require_once('templates/footer.phtml'); ?>
</body>
</html>