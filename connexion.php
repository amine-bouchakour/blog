<?php
    require_once('api/config.php');
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
    <link rel="stylesheet" href="blog.css">
    <link rel="stylesheet" href="api/animations.css">
    <title>Connexion</title>
</head>
<body>
    <header>
        <a href="" id="home-link"><h1>blog_name</h1></a>
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
                    <input type="submit" name="login_button" value="S'inscrire">
                    <p>Pas encore inscrit ? <a href="inscription.php">Inscription</a></p>
                </form>
            </div>
        </div>
    </main>







    <?php require_once('footer.php'); ?>
</body>
</html>

<style>
header{
    width: 100%;
    height: 5%;
    background-color: #444;
    display: flex;
    justify-content: space-between;
    align-items: center;
    color: white;
    font-family: 'Roboto', sans-serif;
}
header a{
    color: inherit;
    text-decoration: none;
}
header a button{
    cursor: pointer;
}
header #home-link{
    margin-left: 10px;
}
header #login-link-button{
    margin-right: 10px;
    height: 80%;
    width: 100px;
}
header #login-link-button button{
    width: 100%;
    height: 100%;
    background: none;
    color: white;
    border: 2px solid white;
}

main#login{
    background-color: #111;
    display: flex;
    align-items: center;
    justify-content: center;
}
main#login p{
    margin: 0;
}
main#login #content{
    width: 45%;
    height: 65%;
    background-color: #555;
    border-radius: 5px;
    display: flex;
}
main#login #content .part{
    width: 50%;
    height: 100%;
}

main#login #content .part.title-part{
    border-top-left-radius: 5px;
    border-bottom-left-radius: 5px;
    background-image: url('background-form.jpg');
    background-size: cover;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: space-around;
}
main#login #content .part.title-part p{
    font-size: 2vw;
    font-family: 'Pacifico', cursive;
    color: white;
    margin: 0;
}
main#login #content .part.form-part form{
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: space-evenly;
    align-items: center;
}
main#login #content .part.form-part form p:not(.error){
    color: white;
}
main#login #content .part.form-part form a{
    color: black;
}
main#login #content .part.form-part form input:not([type="submit"]){
    width: 70%;
    height: 35px;
    border-radius: 5px;
    border: 3px solid #333;
    background-color: white;
    outline: none;
    padding-left: 5px;
    padding-right: 5px;
    font-size: 0.8vw;
}
main#login #content .part.form-part form input[type="submit"]{
    width: 50%;
    height: 50px;
    font-size: 0.8vw;
    background-color: green;
    border: none;
    color: white;
    border-radius: 5px;
    cursor: pointer;
    outline: none;
}
main#login #content .part.form-part form input[type="submit"]:focus{
    background-color: darkgreen;
}
</style>