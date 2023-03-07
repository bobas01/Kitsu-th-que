<?php
include_once './header-admin.php';
session_start();

if (!isset($_SESSION['id-user']) && $_SESSION['role-user'] === 'admin' ) {
    header('Location: ./connect.php');
}

?>
<h1>acceuil admin</h1>