<?php require_once '../connexion.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header admin</title>
    <link rel="stylesheet" href="../asset/css/style-header-admin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Carter+One&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700;900&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <a id=burger href="#">
            <img id="logo" src="../asset/img/icon/Logo.svg" alt="kitsuthèque-logo">
        </a>
        <nav id="main-menu">
            <ul>
                <li class="menu"><a href="../catalogue.php"><img src="../asset/img/icon/icons8-livre-ouvert-50.png" alt="catalogue"></a></li>
                <li class="menu"><a href="./list.php"><img src="../asset/img/icon/🦆 icon _view list_.svg" alt="liste"></a></li>
                <li class="menu"><a href="./new-post.php"><img src="../asset/img/icon/🦆 icon _plus_.svg" alt="Ajouté un manga"></a></li>
                <li class="menu"><a href=""><img src="../asset/img/icon/icon_users.svg" alt="gestion des utilisateurs"></a></li>
                <li class="menu"><a href="../model/deconnexion.php"><img src="../asset/img/icon/icone_deconnexion.svg" alt="Se déconnecter"></a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section id="admin-search-bar" class="row-limit-size">
            <form action="./research-list.php" method="GET">
                <input type="search" placeholder="Rechercher" name="search" class="search-admin">
                <button type="submit" name="research" value="rechercher..." class="search-admin">
                    <img src="../asset/img/icon/icon_search_bar.svg" alt="icon loupe">
                </button>
            </form>
            <span>Disponible:
                <?php
                $sql = "SELECT COUNT(`id`) AS `total` FROM `manga`";
                $req = $db->query($sql);
                $result = $req->fetch(PDO::FETCH_ASSOC)
                ?>
                <?= $result['total'] ?>
            </span>
            <span>Réservé :
                <?php
                $sql2 = "SELECT COUNT(`available`) AS `reserved` FROM `loan`";
                $req2 = $db->query($sql2);
                $reserved = $req2->fetch(PDO::FETCH_ASSOC)
                ?>
                <?= $reserved['reserved'] ?>
            </span>
            <span>
                <?php
                $id = $_SESSION['id-user'];
                $sql3 = $db->prepare("SELECT `pseudo` FROM `user` WHERE `id` = :id");
                $sql3->bindParam(':id', $id, PDO::PARAM_INT);
                $sql3->execute();
                $pseudo = $sql3->fetch(PDO::FETCH_ASSOC)
                ?>
                <?= ucfirst($pseudo['pseudo']) ?>
            </span>
        </section>