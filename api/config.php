<?php
    require_once('User.php');
    session_start();
    
    if(isset($_GET['disconnect'])){
        $_SESSION['user']->disconnect();
    }
?>