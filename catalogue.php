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
                <form id="form" action="">
                    <fieldset>
                        <legend>Genre</legend>
                        <?php
                        $reqGenre = $db->query("SELECT `id`,`name`,`slug` FROM `genre`;");
                        while ($articleGenre = $reqGenre->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                            <input class="genre" type="checkbox" name="genre[]" value="<?= $articleGenre['slug'] ?>">
                            <label for="<?= $articleGenre['slug'] ?>"><?= $articleGenre['name'] ?></label>
                        <?php
                        }
                        ?>



                    </fieldset>
                    <fieldset>
                        <legend>Public</legend>
                        <?php
                        $reqPublic = $db->query("SELECT `id`,`name`,`slug` FROM `public`;");
                        while ($articlePublic = $reqPublic->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                            <input class="public" type="checkbox" name="public[]" value="<?= $articlePublic['slug'] ?>">
                            <label for="<?= $articlePublic['slug'] ?>"><?= $articlePublic['name'] ?></label>
                        <?php
                        }
                        ?>




                    </fieldset>
                    <fieldset>
                        <legend>Catégorie</legend>
                        <?php
                        $reqCategory = $db->query("SELECT `id`,`name`,`slug` FROM `category`;");
                        while ($articleCategory = $reqCategory->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                            <input class="category" type="checkbox" name="category[]" value="<?= $articleCategory['slug'] ?>">
                            <label for="<?= $articleCategory['slug'] ?>"><?= $articleCategory['name'] ?></label>
                        <?php
                        } ?>


                    </fieldset>

                    <button id="search" type="submit">Rechercher</button>
                </form>
            </div>

        </section>
        <section id="catalogues">
            <div class="articles">
                <?php

                $req = $db->query("SELECT `id`,`cover`,`title`,`volume` FROM `manga` ORDER BY `id` DESC;");
                while ($article = $req->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <article>
                        <figure>
                            <a href="./post.php?id=<?= $article['id'] ?>"><img src="./asset/img/premiere-page/<?= $article['cover'] ?>" alt="premièrepage"></a>
                        </figure>
                        <div class="article-content">
                            <h2 class="article-title"><?= $article['title'] ?></h2>
                            <p class="article-tome">Tome <?= $article['volume'] ?></p>

                        </div>
                    </article>
                <?php } ?>

        </section>
    </main>
    <?php
    require_once './footer.php';
    ?>
    <script src="./asset/js/ajax.js"></script>
</body>