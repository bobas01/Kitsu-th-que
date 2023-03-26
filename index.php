<?php 
$style= './asset/css/style.css';
require_once './header.php';
require_once './connexion.php';
?>

<main>
    <section id="news">
        <div class="row-limit-size">
            <article class="titleDiv">
                <h1 class="title">Les nouveautés</h1>
            </article>
            <div id="slider">
                <div id="leftArrow">
                    <img src="./asset/img/icon/flèche-gauche.svg" alt="left arrow">
                </div>
                <div id="window-slider">
                    <div id="list-slide">
                        <?php

                        $reqArticle = $db->query("SELECT `id`, `title`, `cover`  FROM `manga` ORDER BY `id` DESC LIMIT 5");

                        while ($reqFetchArticle = $reqArticle->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                            <div class="slide"><a href="./post.php?id=<?= $reqFetchArticle['id'] ?>"><img
                                        src="./asset/img/premiere-page/<?= $reqFetchArticle['cover'] ?>"
                                        alt="<?= $reqFetchArticle['title'] ?>"></a></div>
                        <?php } ?>
                    </div>
                </div>
                <div id="rightArrow">
                    <img src="./asset/img/icon/flèche-droite.svg" alt="right arrow">
                </div>


            </div>
            <figure id="swipe"><img src="./asset/img/icon/icon-swipe.svg" alt="swipe"
                    style="width: 50px; height: 50px;"></figure>


        </div>
    </section>
    <section id="event">
        <div class="row-limit-size">

            <article class="titleDiv">
                <h1 class="title"> Nos événements</h1>
            </article>
            <div id=eventran>
                <div id="imgEvent">
                    <img src="./asset/img/photo/kevin-tran-250.jpg" alt="Kévin Tran">
                    <img src="./asset/img/premiere-page/ki&hi.png" alt="KI&HI">
                </div>
                <p>Dédicace de Kevin Tran le 30/03/2023 de 14h à 18h pour son dernier manga KI & HI.</p>
            </div>

        </div>
    </section>
    <section id="place">
        <div class="row-limit-size">

            <article class="titleDiv">
                <h1 class="title"> Notre mangathèque</h1>
            </article>
            <div id=placeKitsu>
                <p>Un endroit chaleureux, accessible à tous (accès pour personne à handicap) pour tous des plus petits
                    avec Pokémon les ados avec Naruto ou les plus vieux avec Berserk
                    pour lire sur place ou chez vous avec un personnel très accueillant. </p>
                <div id="imgPlace">
                    <img id="firstImgPlace" src="./asset/img/photo/musee-manga-kyoto-3.jpg" alt="Kespace de lecture">
                    <img id="secondImgPlace" src="./asset/img/photo/espace-accuieller.jpg"
                        alt="rayon de la mangathèque">
                    <img id="thirdImgPlace" src="./asset/img/photo/trogstad_public_library_no_013.jpg" alt="accueil">
                </div>

            </div>

        </div>
    </section>
    <section id="suggestion">
        <div class="row-limit-size">
            <article class="titleDiv">
                <h1 class="title">Vos suggestions</h1>
            </article>

            <div id="suggestion-container">
                <p>Envoyer nous vos suggestions pour les prochains tomes ou nouveau manga qui vous interresserai :</p>
                <form action="#" method="POST">
                    <?php if (isset($_POST['suggestion'])) {
                        $suggestion = addslashes($_POST['suggestion']);
                        $reqSug = $db->prepare("INSERT INTO `suggestion`( `suggestion`) VALUES (:suggestion)");
                        $reqSug->bindParam('suggestion', $suggestion, PDO::PARAM_STR);
                        $reqSug->execute();
                        header('Location: ./index.php');
                    }
                    ?>
                    <input type="text" id="suggestion" name="suggestion" placeholder="Vos suggestions">
                    <button type="submit">Envoyer</button>
                </form>
            </div>
        </div>
    </section>
    <section id="connect">
        <div class="container <?= (isset($_GET['err'])) ? "active" : "" ?> <?= (isset($_GET['erro'])) ? "active" : "" ?>" id="container">
            <div class="form-container sign-up-container">
                <?php if (isset($_GET['erro'])) { ?>
                    <p style="color:red;">Identifiant et/ou adresse mail déjà utilisé(s)</p>
                <?php } ?>
                <form action="./model/inscription.php" class="formConnect" method="POST">
                    <h1 class="titleFormConnect">Créer un compte</h1>
                    <input type="text" name='pseudo' placeholder="pdeudo" />
                    <input type="email" name="mail" placeholder="Email" />
                    <input type="password" name="password" placeholder="Password" />
                    <button class="btnFormConnect">S'inscrire</button>
                </form>
            </div>
            <div class="form-container sign-in-container">
                <?php if (isset($_GET['err'])) { ?>
                    <p style="color:red;">Identifiant et/ou mot de passe incorrecte</p>
                <?php } ?>
                <form action="./model/auth.php" class="formConnect" method="POST">
                    <h1 class="titleFormConnect">Se connecter</h1>
                    <input type="text" name="pseudo" placeholder="Pseudo" />
                    <input type="password" name="password" placeholder="Mot de passe" />
                    <a href="#">Mot de passe oublié?</a>
                    <button class="btnFormConnect">Connexion</button>
                </form>
            </div>
            <div class="overlay-container">
                <div class="overlay">
                    <div class="overlay-panel overlay-left">
                        <button class="ghost btnFormConnect" id="signIn">Se connecter</button>
                    </div>
                    <div class="overlay-panel overlay-right">
                        <button class="ghost btnFormConnect" id="signUp">S'inscrire</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php
require_once './footer.php';
?>
<script src="./asset/js/main.js"></script>
</body>

</html>