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
</main>
<?php require_once './footer.php' ?>