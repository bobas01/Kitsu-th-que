<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>kitsuthèque</title>
    <link rel="stylesheet" href="./asset/css/style-header.css">
    
    <link rel="stylesheet" href="<?=$style?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Carter+One&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700;900&display=swap" rel="stylesheet">
</head>

<body >
    <header>
        <div class="row-limit-size">
            <div id="icon">
                <a id="logo" href="./index.php"><img src="./asset/img/icon/Logo.svg" alt="logo"></a>
                <a id="catalogue" href="./catalogue.php"><img src="./asset/img/icon/icons8-livre-ouvert-50.png" alt="catalogue"></a>
                <?php if(isset($_SESSION['connected']) && $_SESSION['connected'] == true){ ?>
                <a id="connected" href="./model/deconnexion.php">
                    <img src="./asset/img/icon/renard-orange-deconnexion.svg" alt="connected" title="<?=$_SESSION['pseudo'];  ?>  déconnexion"></a>
                    <a  id="pseudo" href="./dashboard-reader.php"><?=$_SESSION['pseudo']?></a>
               
                <?php } else { ?>
                <a id="connexion" href="#"><img src="./asset/img/icon/renard-noir.svg" alt="connexion"></a>
                <?php } ?>
            </div>
        
            <div class="search-container">
                <form action="result-search.php" method="GET">
                    <input type="search" placeholder="Rechercher" name="search">
                    <button type="submit" name='research' value="rechercher"><img src="./asset/img/icon/🦆 icon _search_.svg" alt="icon loupe"></button>
                </form>
            </div>
        </div>
    </header>
