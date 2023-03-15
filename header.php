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
    <link rel="stylesheet" href="./asset/css/style.header.css">    
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
                <a id="connexion" href="#"><img src="./asset//img//icon/icons-connexion.png" alt="connexion"></a>
            </div>
        
            <div class="search-container">
                <form action="result-search.php" method="GET">
                    <input type="search" placeholder="Rechercher" name="search">
                    <button type="submit" name='research' value="rechercher"><img src="./asset/img/icon/🦆 icon _search_.svg" alt="icon loupe"></button>
                </form>
            </div>
        </div>
    </header>
