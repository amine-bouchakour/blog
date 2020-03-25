<?php
    require_once('libraries/config.php');
    if(empty($_SESSION['user'])){
        header('Location: connexion.php');
    }
    if($_SESSION['user']->droits != "1337"){
        header('Location: profil.php');
    }
    $user = new User;
    $users = $user->getNormalUsers();
    $moderates = $user->getModerate();
    $admins = $user->getAdmins();

    if(isset($_POST['delete_user'])){
        $usertodelete = new User;
        $iduser = $_POST['user_id'];
        $usertodelete->deleteUser($iduser); 
    }
    if(isset($_POST['promote_user'])){
        $usertodelete = new User;
        $iduser = $_POST['user_id'];
        $droits = $_POST['user_droits'];
        $usertodelete->promoteUser($iduser, $droits); 
    }
    if(isset($_POST['demote_user'])){
        $usertodelete = new User;
        $iduser = $_POST['user_id'];
        $droits = $_POST['user_droits'];
        $usertodelete->demoteUser($iduser, $droits); 
    }
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="blog.css">
    <title>Admin tool | Music'n Blog</title>
</head>
<body>
    <?php require_once('templates/header.phtml'); ?>
    <main class="admin_profil" id="admin">
        <nav>
            <div class="nav-link"><a href="profil.php">Infos</a></div>
            <?php
            if($_SESSION['user']->droits == "1337"){
            ?>
                <div class="nav-link current"><a href="admin.php">Administrateur</a></div>
            <?php } ?>
        </nav>
        <section>
            <article>
                <p class="title">Lecteurs</p>
                <table>
                    <th>ID</th>
                    <th>Pseudo</th>
                    <th>Mail</th>
                </table>
                <?php
                    foreach($users as $user){ ?>
                    <div class="user">
                        <p><?php echo $user[0]; ?></p>
                        <p><?php echo $user[1]; ?></p>
                        <p><?php echo $user[2]; ?></p>
                        <form method="post">
                            <input type="hidden" name="user_id" value="<?php echo $user[0]; ?>">
                            <input type="hidden" name="user_droits" value="<?php echo $user[3]; ?>">
                            <input type="submit" name="promote_user" value="Droit +">
                            <input type="submit" name="delete_user" value="X" class="remove">
                        </form>
                    </div>
                <?php    }
                ?>
            </article>
            <article>
                <p class="title">Modérateurs</p>
                <table>
                    <th>ID</th>
                    <th>Pseudo</th>
                    <th>Mail</th>
                </table>
                <?php
                    foreach($moderates as $user){ ?>
                    <div class="user">
                        <p><?php echo $user[0]; ?></p>
                        <p><?php echo $user[1]; ?></p>
                        <p><?php echo $user[2]; ?></p>
                        <form method="post">
                            <input type="hidden" name="user_id" value="<?php echo $user[0]; ?>">
                            <input type="hidden" name="user_droits" value="<?php echo $user[3]; ?>">
                            <input type="submit" name="demote_user" value="Droit -">
                            <input type="submit" name="promote_user" value="Droit +">
                            <input type="submit" name="delete_user" value="X" class="remove">
                        </form>
                    </div>
                <?php    }
                ?>
            </article>
            <article>
                <p class="title">Administrateurs</p>
                <table>
                    <th>ID</th>
                    <th>Pseudo</th>
                    <th>Mail</th>
                </table>
                <?php
                    foreach($admins as $user){ ?>
                    <div class="user">
                        <p><?php echo $user[0]; ?></p>
                        <p><?php echo $user[1]; ?></p>
                        <p><?php echo $user[2]; ?></p>
                        <form method="post">
                            <input type="hidden" name="user_id" value="<?php echo $user[0]; ?>">
                            <input type="hidden" name="user_droits" value="<?php echo $user[3]; ?>">
                            <input type="submit" name="demote_user" value="Droit -">
                            <input type="submit" name="delete_user" value="X" class="remove">
                        </form>
                    </div>
                <?php    }
                ?>
            </article>
        </section>
    </main>
</body>
</html>

<?php




?>