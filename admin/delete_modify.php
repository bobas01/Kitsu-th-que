<?php
session_start();
include_once '../connexion.php';

try {
    $id = $_GET['id'];

    $sql = $db->prepare("DELETE FROM `manga` WHERE `id`= :id ");
    $sql->bindParam('id', $id, PDO::PARAM_INT);
    $sql->execute();
    header('Location: ./list.php');
    $_SESSION["success"] = "Votre article a bien été suprimé";
    exit();

} catch (PDOException $e) {
    header('Location: ./list.php');
    $_SESSION["error"] = "Votre article n'a pas été suprimé";
    exit();
};