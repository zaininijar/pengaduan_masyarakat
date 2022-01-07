<?php 

    require_once 'connection.php'; 

    if (isset($_GET) && $_GET != "" && isset($_GET['register'])) {
        require_once "layouts/guest/header.php";
        require_once "app/auth/register.php";
        require_once "layouts/guest/footer.php";
    } elseif(isset($_GET) && $_GET != "" && isset($_GET['login'])) {
        require_once "layouts/guest/header.php";
        require_once "app/auth/login.php";
        require_once "layouts/guest/footer.php";
    }