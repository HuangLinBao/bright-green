<?php 
session_start();
ob_start();
if($_SESSION['login']) {
    session_destroy();
    session_unset($_SESSION['login']);
    session_unset($_SESSION['username']);
    session_unset($_SESSION['user_role']);
    session_unset($_SESSION['full_name']);
    header("Location: ./login.php");
}

?> 