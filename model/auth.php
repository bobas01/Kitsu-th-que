<?php
session_start();
include_once '../connexion.php';

$pseudo = $_POST['pseudo'];
$pass = $_POST['password'];


$req = $db->prepare("SELECT `id`,`role`,`pseudo`,`password` FROM `user` WHERE `pseudo` = :pseudo");
$req->bindParam('pseudo', $pseudo, PDO::PARAM_STR);
$req->execute();


if ($req->rowCount() == 1) {
    $user = $req->fetch(PDO::FETCH_ASSOC);

    if (password_verify($pass, $user['password'])) {
        $_SESSION['id-user'] = $user['id'];
        $_SESSION['role-user'] = $user['role'];
        $_SESSION['pseudo'] = $user['pseudo'];        
        if ($user['role'] === 'admin') {
            header('Location: ../admin/list.php');
            $_SESSION['connected'] = true;
        } else {
            header('Location: ../index.php');
            $_SESSION['connected'] = true;

        }
    } else {
        header('Location: ../index.php?err=1');
    }
} else {
    header('Location: ../index.php?err=1');
}