<?php
include_once './connexion.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>kitsuthèque</title>
    <link rel="stylesheet" href="./asset/css/style.header.css">
    
    <link rel="stylesheet" href="./asset/css/style-catalogue.css">


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Carter+One&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700;900&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <div class="row-limit-size">
            <div id="icon">
                <a id="logo" href="./index.php"><img src="./asset/img/icon/Logo.svg" alt="logo"></a>
                <a id="catalogue" href="./catalogue.php"><img src="./asset/img/icon/icons8-livre-ouvert-50.png" alt="catalogue"></a>
                <a id="connexion" href="./connect.php"><img src="./asset//img//icon/icons-connexion.png" alt="connexion"></a>
            </div>
            <?php
            $research= null;
            if (isset($_GET["search"]) ) {
                $_GET["search"] = htmlspecialchars($_GET["search"]);
                $research = $_GET['research'];
                $research = trim($research);
                $research = strip_tags($research);
                
            }
            if (!empty($research)) {
                $research = strtolower($research);
                $select_research = $db->prepare("SELECT `manga`.`volume`,`manga`.`extract`,`manga`.`title`,`manga`.`cover`  FROM `manga` 
                INNER JOIN `genre`
                ON `manga`.`id_genre`=`genre`.`id`
                INNER JOIN `public`
                ON `manga`.`id_public`=`public`.`id`
                INNER JOIN `manga_category`
                ON `manga_category`.`id_manga`= `manga`.`id`
                INNER JOIN `category`
                ON `manga_category`.`id_category`= `category`.`id`               
                WHERE CONCAT(`manga`.`volume`,`manga`.`author`,`manga`.`extract`,`manga`.`title`,`category`.`slug`, `genre`.`slug`, `public`.`slug`) LIKE :search");
                $select_research->bindValue('search', '%'.$research.'%', PDO::PARAM_STR);
                $select_research->execute();
                
                
            } else {
                $message = "Vous devez entrer votre requete dans la barre de recherche";
            }
            ?>
            <div class="search-container">
                <form action="./result-search.php" method="GET">
                    <input type="search" placeholder="Rechercher" name="search">
                    <button type="submit" name='research' value="rechercher"><img src="./asset/img/icon/🦆 icon _search_.svg" alt="icon loupe"></button>
                </form>
   
            </div>
        </div>
    </header>


    <main>
        <section id="check_box">
            <div class="row-limit-size">
                <article class="titleDiv">
                    <h1 class="title">Catalogue</h1>
                </article>
                
              
            </div>

        </section>
        <section id="catalogues">
            <div class="articles">
                <?php
                 while($research_find = $select_research->fetch())
                 { ?>
                      

               
                    <article>
                        <figure>
                            <a href="#"><img src="./asset/img/premiere-page/<?= $research_find['cover'] ?>" alt="premièrepage"></a>
                        </figure>
                        <div class="article-content">
                            <h2 class="article-title"><?= $research_find['title'] ?></h2>
                            <p class="article-tome">Tome <?= $research_find['volume'] ?></p>

                        </div>
                    </article>
                    <?php  }
  $select_research->closeCursor();
   ?> 

        </section>
    </main>
    <?php
   require_once './footer.php';
   ?>
    <script src="./asset/js/ajax.js"></script>
</body>

