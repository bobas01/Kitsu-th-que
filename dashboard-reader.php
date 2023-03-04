<?php
session_start();

if (!isset($_SESSION['id-user'])) {
    header('Location: ./connect.php');
}

?>
<h1>acceuil reader</h1>