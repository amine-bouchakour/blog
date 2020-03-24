<?php
    class User{
        private $id = "";
        public $username = "";
        public $mail = "";
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
                        header('Location: ../connexion.php');
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
            $requete = $db->prepare("SELECT login, email, id_droits FROM utilisateurs WHERE id = '$id'");
            $requete->execute();
            $results = $requete->fetchAll();
            $username = $results[0][0];
            $mail = $results[0][1];
            $droits = $results[0][2];

            $this->username = $username;
            $this->mail = $mail;
            $this->droits = $droits;

            $db = null;
        }

        public function disconnect(){
            session_destroy();
            header('Location: index.php');
        }


        public function deleteUser($id){
            $id = $this->connectdb();

            $requete = $db->prepare("DELETE FROM utilisateurs WHERE id = '$id'");
        }
    }
?>