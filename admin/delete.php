<?php
session_start();
include_once '../connexion.php';

try {
    $id = $_GET['id'];

    $sql = $db->prepare("DELETE FROM `manga` WHERE `id`= :id ");
    $sql->bindParam('id', $id, PDO::PARAM_INT);
    $sql->execute();
    
    $_SESSION["success"] = "Le manga a bien été supprimé";
    header('Location: ./list.php');
    exit();

} catch (PDOException $e) {
    $_SESSION["error1"] = "Le manga n'a pas été supprimé";
    header('Location: ./list.php');
    exit();
};