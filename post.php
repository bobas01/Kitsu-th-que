<?php
$style= './asset/css/style-post.css';
require_once './header.php';

require_once './connexion.php';
?>

<main id="mainPost">
    <section id="post">
        <div class="row-limit-size">
            <article id="titleDiv">
                <h1 id="title">Fiche manga</h1>
            </article>
           <?php
        $id = $_GET['id'];
        $reqArticle = $db->prepare("SELECT `id`, `title`, `extract`, `cover`,`published_at`, `author`, `volume`  FROM `manga` WHERE `id`= :id");
        $reqArticle->bindParam('id', $id, PDO::PARAM_INT);
        $reqArticle->execute();

        ?>
        <section>

            <div class="article row-limit-size">
                <?php while ($reqFetchArticle = $reqArticle->fetch(PDO::FETCH_ASSOC)) { ?>

            <div id="postIt">
                <figure><img src="./asset/img/premiere-page/<?= $reqFetchArticle['cover']?>" alt="one piece"></figure>
                <form action="" method="POST">
                    <div>
                        <label for="title">Titre</label>
                        <input type="text" name="title" id="title" maxlength="50" value="<?= $reqFetchArticle['title']?>">
                    </div>
                    <div>
                        <label for="volume">Tome</label>
                        <input type="text" name="volume" id="volume" maxlength="50" value="<?= $reqFetchArticle['volume']?>">
                    </div>
                    <div>
                        <label for="author">Auteur</label>
                        <input type="text" name="author" id="author" maxlength="50" value="<?= $reqFetchArticle['author']?>">
                    </div>
                    <div>
                        <label for="date">Date</label>
                        <input type="text" name="date" id="date" maxlength="50" value="<?= $reqFetchArticle['published_at']?>">
                    </div>
                    <div>
                        <label for="location">Emplacement</label>
                        <input type="text" name="location" id="location" maxlength="50" value="">
                    </div>
                    <div>
                        <label for="extract">Résumé</label>
                        <textarea name="extract" id="extract" cols="30" rows="10" ><?= $reqFetchArticle['extract']?></textarea>
                    </div>
                </form>
            </div>
            <?php } ?>
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
<?php require_once './footer.php' ?>
<script src="./asset/js/popup.js"></script>