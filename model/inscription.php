<?php
session_start();
require_once '../connexion.php';

$pseudo = $_POST['pseudo'];
$pass = $_POST['password'];
$passHashed = password_hash($pass, PASSWORD_DEFAULT);
$mail = $_POST['mail'];
$mailVerif = filter_var($_POST["mail"], FILTER_VALIDATE_EMAIL);
$roles = 'reader';

if (!empty($_POST)) {
    $query = "SELECT COUNT(*) as count FROM `user` WHERE `pseudo` = :pseudo OR `mail` = :mail";

    $req = $db->prepare($query);
    $req->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
    $req->bindParam(':mail', $mail, PDO::PARAM_STR);
    $req->execute();
    $result = $req->fetch(PDO::FETCH_ASSOC);

    if ($result['count'] > 0) {
        header('Location: ../index.php?erro=1');
        exit();
    } else {
        $req = $db->prepare("INSERT INTO `user` (`role`, `pseudo`, `password`, `mail`) VALUES (:roles, :pseudo, :pass, :mail)");

        $req->bindParam('roles', $roles, PDO::PARAM_STR);
        $req->bindParam('pseudo', $pseudo, PDO::PARAM_STR);
        $req->bindParam('pass', $passHashed, PDO::PARAM_STR);
        $req->bindParam('mail', $mailVerif, PDO::PARAM_STR);
        $req->execute();
        header('Location: ../index.php');
        exit();
    }
}