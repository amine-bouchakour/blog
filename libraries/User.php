<?php
    class User{
        public $id = "";
        public $username = "";
        public $mail = "";
        public $avatar = "";
        public $rights = "";

        private function connectdb(){
            try{
                $db = new PDO('mysql:host=localhost;dbname=blog', 'root', '');
                return($db);
            }
            catch(PDOException $e){
                print "Erreur !: " . $e->getMessage();
                die();
            }
        }

        public function register($username, $mail, $password, $cpassword){
            $db = $this->connectdb();
            $msg = "";
            if($password === $cpassword){
                $requete = $db->prepare("SELECT id FROM utilisateurs WHERE email = '$mail'");
                $requete->execute();
                $checkmail = $requete->rowCount();

                if($checkmail == 1){
                    $msg = "L'adresse email est déjà utilisée";
                }
                else{
                    $requete = $db->prepare("SELECT id FROM utilisateurs WHERE login = '$username'");
                    $requete->execute();
                    $checkuser = $requete->rowCount();
                    if($checkuser == 1){
                        $msg = "Le nom d'utilisateur existe déjà";
                    }
                    else{
                        $password = password_hash($password, PASSWORD_BCRYPT);
                        $requete = $db->prepare("INSERT INTO utilisateurs (login, password, email) VALUES ('$username', '$password', '$mail')");
                        $requete->execute();
                        header('Location: connexion.php');
                    }
                }
            }
            else{
                $msg = "Les mots de passe ne se correspondent pas";
            }
            return($msg);
            $db = null;
        }

        public function login($mail, $password){
            $db = $this->connectdb();
            $error = false;
            $requete = $db->prepare("SELECT id FROM utilisateurs WHERE email = '$mail'");
            $requete->execute();
            $checkmail = $requete->rowCount();
            if($checkmail == 1){
                $requete = $db->prepare("SELECT password FROM utilisateurs WHERE email = '$mail'");
                $requete->execute();
                $result = $requete->fetchAll();
                $cryptedpass = $result[0][0];
                $checkpass = password_verify($password, $cryptedpass);
                if($checkpass == 1){
                    $requete = $db->prepare("SELECT id FROM utilisateurs WHERE email = '$mail'");
                    $requete->execute();
                    $results = $requete->fetchAll();
                    $this->id = $results[0][0];
                    $this->getUserInfos();
                    header("Location: index.php");
                }
                else{
                    $error = true;
                }
            }
            else{
                $error = true;
            }
            $db = null;
            return($error);
        }
        public function getUserInfos(){
            $id = $this->id;
            $db = $this->connectdb();
            $requete = $db->prepare("SELECT login, email, avatar, id_droits FROM utilisateurs WHERE id = '$id'");
            $requete->execute();
            $results = $requete->fetchAll();
            $username = $results[0][0];
            $mail = $results[0][1];
            $avatar = $results[0][2];
            $droits = $results[0][3];

            $this->username = $username;
            $this->mail = $mail;
            $this->avatar = $avatar;
            $this->droits = $droits;

            $db = null;
        }

        public function modify($username, $mail, $password, $cpassword){
            $db = $this->connectdb();
            $msg = "";
            $id = $this->id;
            if($password === $cpassword){
                $requete = $db->prepare("SELECT id FROM utilisateurs WHERE email = '$mail'");
                $requete->execute();
                $checkmail = $requete->rowCount();

                if($checkmail == 2){
                    $msg = "L'adresse email est déjà utilisée";
                }
                else{
                    $requete = $db->prepare("SELECT id FROM utilisateurs WHERE login = '$username'");
                    $requete->execute();
                    $checkuser = $requete->rowCount();
                    if($checkuser == 2){
                        $msg = "Le nom d'utilisateur existe déjà";
                    }
                    else{
                        $password = password_hash($password, PASSWORD_BCRYPT);
                        $requete = $db->prepare("UPDATE utilisateurs SET login = '$username', email = '$mail', password = '$password' WHERE id = '$id'");
                        $requete->execute();
                        header('Location: profil.php');
                    }
                }
            }
            else{
                $msg = "Les mots de passe ne se correspondent pas";
            }
            return($msg);
            $db = null;
        }
        public function changeAvatar($file){
            $msg = "";
            $db = $this->connectdb();
            $filename = $file['name'];
            $fileTmpName = $file['tmp_name'];
            $fileType = $file['type'];
            $fileError = $file['error'];
            $fileSize = $file['size'];
            $fileExt = explode(('.'), $filename);
            $fileActualExt = strtolower(end($fileExt));
            $allowed = array('jpg', 'jpeg', 'png');
            if(in_array($fileActualExt, $allowed))
            {
                if($fileError === 0)
                {
                    if($fileSize < 1000000)
                    {
                        $fileNameNew = uniqid('', true).'.'.$fileActualExt;
                        $fileDestination = "avatars/$fileNameNew";
                        move_uploaded_file($fileTmpName, $fileDestination);
                        $id = $this->id;
                        $requete = $db->prepare("UPDATE utilisateurs SET avatar = '$fileDestination' WHERE id = '$id'");
                        $requete->execute();
                        header('Location: profil.php');
                    }
                    else
                    {
                        $msg = "Le fichier est trop volumineux";
                    }
                }
                else
                {
                    $msg = "Une erreur est survenue avec votre fichier";
                }
            }
            else
            {
                $msg = "L'extension n'est pas gérée par le site";
            }
            $db = null;
            return($msg);
        }
        public function disconnect(){
            session_destroy();
            header('Location: index.php');
        }



        // User Global
            public function getNormalUsers(){
                $db = $this->connectdb();
                $requete = $db->prepare("SELECT id, login, email, id_droits FROM utilisateurs WHERE id_droits = '1'");
                $requete->execute();
                $result = $requete->fetchAll();
                $db = null;
                return($result);
            }
            public function getModerate(){
                $db = $this->connectdb();
                $requete = $db->prepare("SELECT id, login, email, id_droits FROM utilisateurs WHERE id_droits = '42'");
                $requete->execute();
                $result = $requete->fetchAll();
                $db = null;
                return($result);
            }
            public function getAdmins(){
                $db = $this->connectdb();
                $requete = $db->prepare("SELECT id, login, email, id_droits FROM utilisateurs WHERE id_droits = '1337'");
                $requete->execute();
                $result = $requete->fetchAll();
                $db = null;
                return($result);
            }

            public function deleteUser($id){
                $db = $this->connectdb();
                $requete = $db->prepare("DELETE FROM utilisateurs WHERE id = '$id'");
                $requete->execute();
                $db = null;
                header('Location: admin.php');
            }

            public function promoteUser($id, $droits){
                $db = $this->connectdb();
                if($droits == "1"){
                    $requete = $db->prepare("UPDATE utilisateurs SET id_droits = '42' WHERE id = '$id'");
                    $requete->execute();
                }
                elseif($droits == "42"){
                    $requete = $db->prepare("UPDATE utilisateurs SET id_droits = '1337' WHERE id = '$id'");
                    $requete->execute();
                }
                $db = null;
                header('Location: admin.php');
            }
            public function demoteUser($id, $droits){
                $db = $this->connectdb();
                if($droits == "42"){
                    $requete = $db->prepare("UPDATE utilisateurs SET id_droits = '1' WHERE id = '$id'");
                    $requete->execute();
                }
                elseif($droits == "1337"){
                    $requete = $db->prepare("UPDATE utilisateurs SET id_droits = '42' WHERE id = '$id'");
                    $requete->execute();
                }
                $db = null;
                header('Location: admin.php');
            }
    }
?>