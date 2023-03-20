<?php
session_start();
$style = './asset/css/style-post.css';
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
            $reqArticle = $db->prepare("SELECT `id`, `title`, `extract`, `cover`,`published_at`, `author`, `volume`, `bookshelf` FROM `manga` WHERE `id`= :id");
            $reqArticle->bindParam('id', $id, PDO::PARAM_INT);
            $reqArticle->execute();

            ?>
            <section>

                <div class="article row-limit-size">
                    <?php while ($reqFetchArticle = $reqArticle->fetch(PDO::FETCH_ASSOC)) { ?>

                        <div id="postIt">
                            <figure><img src="./asset/img/premiere-page/<?= $reqFetchArticle['cover'] ?>"
                                    alt="<?= $reqFetchArticle['title'] ?>"></figure>
                            <form action="" method="POST">

                                <h2>
                                    <?= $reqFetchArticle['title'] . "  " ?>
                                </h2>
                                <h3> Tome
                                    <?= " " . $reqFetchArticle['volume'] ?>
                                </h3>
                                <h3 id="extract">Résumé :</h3>
                                <p>
                                    <?= $reqFetchArticle['extract'] ?>
                                </p>
                                <h3>Date de publication :
                                   <span> <?= $reqFetchArticle['published_at'] ?></span>
                                </h3>
                                <h3>Auteur :
                                   <span> <?= " " . $reqFetchArticle['author'] ?></span>
                                </h3>
                                <h3>Emplacement :
                                    <span><?= " " . $reqFetchArticle['bookshelf'] ?></span>
                                </h3>
                              <?php 
                              if (isset($_POST['submit'])) {
                                $idManga = $_POST['id_mange'] =$reqFetchArticle['id'];
                                $idUser = $_POST['id_user'] = $_SESSION['id-user'];
                                
                                  
                                                          
                            
                                $loan = $db->query("INSERT INTO `loan`( `id_manga`, `id_user`, `loan_date`,`return_date`, `reservation_loan`, `available`) 
                                VALUES ($idManga, $idUser,NOW(),NULL,DATE_ADD(NOW(), INTERVAL 3 HOUR)  , 1);");                           
                            } 
                         
                              ?>
                              <input type="submit" name="submit" value="Réserver">
                            
                                
                            </form>
                        </div>
                    <?php } ?>
                </div>
            </section>
            <section id="connect">
                <div class="container <?= (isset($_GET['err'])) ? "active" : "" ?> <?= (isset($_GET['erro'])) ? "active" : "" ?>"
                    id="container">
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