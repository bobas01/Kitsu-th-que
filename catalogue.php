<?php
include_once './connexion.php'

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="./asset/css/style-catalogue.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Carter+One&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700;900&display=swap" rel="stylesheet">
</head>

<body>

    <main>
        <section id="check_box">
            <div class="row-limit-size">
                <article class="titleDiv">
                    <h1 class="title">Catalogue</h1>
                </article>
             <form  id="form" action="">
                <fieldset>
                    <legend>Genre</legend>
                    <input id="genre" type="checkbox"  name="genre[]">
                    <label for="kodomo">Kodomo</label>

                    <input id="genre" type="checkbox"  name="genre[]">
                    <label for="shonen">Shonen</label>
                    <input id="genre" type="checkbox"  name="genre[]">
                    <label for="shojo">Shojo</label>

                    <input id="genre" type="checkbox"  name="genre[]">
                    <label for="seinen">seinen</label>
                    <input id="genre" type="checkbox"  name="genre[]">
                    <label for="josei">Josei</label>
                    <input id="genre" type="checkbox"  name="genre[]">
                    <label for="meca">Méca</label>

                </fieldset>
                <fieldset>
                    <legend>Public</legend>
                    <input type="checkbox" id="enfant" name="public[]">
                    <label for="enfant">Enfant</label>

                    <input type="checkbox" id="adolescent" name="public[]">
                    <label for="adolescent">Adolescent</label>
                    <input type="checkbox" id="adulte" name="public[]">
                    <label for="adulte">Adulte</label>



                </fieldset>
                <fieldset>
                    <legend>Catégorie</legend>
                    <input type="checkbox" id="action" name="category[]">
                    <label for="action">Action</label>

                    <input type="checkbox" id="aventure" name="category[]">
                    <label for="aventure">Aventure</label>
                    <input type="checkbox" id="romance" name="category[]">
                    <label for="romance">Romance</label>

                    <input type="checkbox" id="science-fiction" name="category[]">
                    <label for="science-fiction">Science-fiction</label>
                    <input type="checkbox" id="comedie" name="category[]">
                    <label for="comedie">Comédie</label>
                    <input type="checkbox" id="drame" name="category[]">
                    <label for="drame">Drame</label>
                    <input type="checkbox" id="fantastic" name="category[]">
                    <label for="fantastic">Fantastique</label>
                    <input type="checkbox" id="horror" name="category[]">
                    <label for="horror">Horreur</label>
                    <input type="checkbox" id="musical" name="category[]">
                    <label for="musical">Musical</label>
                    <input type="checkbox" id="mistery" name="category[]">
                    <label for="mistery">Mystère</label>
                    <input type="checkbox" id="school-life" name="category[]">
                    <label for="school-life">School-life</label>
                    <input type="checkbox" id="slice-of-life" name="category[]">
                    <label for="slice-of-life">Tranche de vie</label>
                    <input type="checkbox" id="sport" name="category[]">
                    <label for="sport">Sport</label>
                    <input type="checkbox" id="surnaturel" name="category[]">
                    <label for="surnaturel">Surnaturel</label>
                    <input type="checkbox" id="thriller" name="category[]">
                    <label for="thriller">Thriller</label>

                </fieldset>

                <button id="search">Rechercher</button>
                </form>
            </div>

        </section>
        <section id="catalogue">
            <div  class="articles">
            <?php
               
                $req = $db->query("SELECT `id`,`cover`,`title`,`volume` FROM `manga` ORDER BY `id` DESC;");
                while ($article = $req->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <article>
                    <figure>
                        <a href="#"><img src="./asset/img/premiere-page/<?= $article['cover'] ?>" alt="premièrepage"></a>
                    </figure>
                    <div class="article-content">
                        <h2 class="article-title"><?= $article['title'] ?></h2>
                        <p class="article-tome">Tome <?= $article['volume'] ?></p>
                        
                    </div>
                </article>
                <?php } ?>
              
        </section>
    </main>
    <script src="./asset/js/ajax.js"></script>
</body>