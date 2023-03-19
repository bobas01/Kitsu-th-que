<?php
session_start();
require_once '../connexion.php';
include_once './header-admin.php';

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    $req = $db->prepare("SELECT `id`, `id_genre`, `id_public`, `title`, `volume`, `editor`, `published_at`, `author`,`extract`,`bookshelf`  FROM `manga` WHERE `id`  = :id");
    $req->bindParam('id', $id, PDO::PARAM_INT);
    $req->execute();

    $article = $req->fetch(PDO::FETCH_ASSOC);

    if ($req->rowCount() === 0) {
        $_SESSION["notModified"] = "Manga introuvable";
        header("Location: edit.php?id=" . $id);
        exit();
    }

    if (isset($_POST['submit'])) {
        $genre = $_POST['genre'];
        $public = $_POST['public'];
        $title = $_POST['title'];
        $volume = $_POST['volume'];
        $editor = $_POST['editor'];
        $published_at = $_POST['published_at'];
        $author = $_POST['author'];
        $extract = $_POST['extract'];
        $bookshelf = $_POST['bookshelf'];

        $reqSend = $db->prepare("UPDATE `manga` SET `id_genre`=:genre, `id_public`=:public, `title`=:title, `volume`=:volume, `editor`=:editor, `published_at`=:published_at, `author`=:author, `extract`=:extract, `bookshelf`=:bookshelf WHERE `id`=:id");
        $reqSend->bindParam(':id', $id, PDO::PARAM_INT);
        $reqSend->bindParam(':genre', $genre, PDO::PARAM_INT);
        $reqSend->bindParam(':public', $public, PDO::PARAM_INT);
        $reqSend->bindParam(':title', $title, PDO::PARAM_STR);
        $reqSend->bindParam(':volume', $volume, PDO::PARAM_INT);
        $reqSend->bindParam(':editor', $editor, PDO::PARAM_STR);
        $reqSend->bindParam(':published_at', $published_at, PDO::PARAM_STR);
        $reqSend->bindParam(':author', $author, PDO::PARAM_STR);
        $reqSend->bindParam(':extract', $extract, PDO::PARAM_STR);
        $reqSend->bindParam(':bookshelf', $bookshelf, PDO::PARAM_STR);

        if ($reqSend->execute()) {
            $_SESSION['modified'] = true;
            header('Location: edit.php?id=' . $id);
            exit();
        } else {
            $error = 'There was an error submitting your form. Please try again later.';
        }
    }
} else {
    $_SESSION["notModified"] = "Manga introuvable";
    header("Location: edit.php?id=" . $id);
    exit();
}
?>
<section class="new-post">
    <form action="#" method="POST">
        <fieldset class="manga-info">
            <?php
            $req = $db->prepare("SELECT `id`, `id_genre`, `id_public`, `title`, `volume`, `editor`, `published_at`, `author`,`extract`,`bookshelf` FROM `manga` WHERE `id`  = :id");
            $req->bindParam('id', $id, PDO::PARAM_INT);
            $req->execute();

            while ($article = $req->fetch(PDO::FETCH_ASSOC)) { ?>

                <legend>Modification des informations de : <?= $article['title'] ?>, tome.<?= $article['volume'] ?></legend>

                <label for="genre">Genre</label>
                <select name="genre" id="genre">
                    <?php
                    $sql = "SELECT `id`,`name` FROM `genre`";
                    $req = $db->query($sql);
                    while ($genre = $req->fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?= $genre['id'] ?>" <?= $article['id_genre'] == $genre['id'] ? 'selected' : '' ?>><?= $genre['name'] ?></option>
                    <?php } ?>
                </select>
                <label for="public">Publique</label>
                <select name="public" id="public">
                    <?php
                    $sql = "SELECT `id`,`name` FROM `public`";
                    $req = $db->query($sql);
                    while ($public = $req->fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?= $public['id'] ?>" <?= $article['id_public'] == $public['id'] ? 'selected' : '' ?>><?= $public['name'] ?></option>
                    <?php } ?>
                </select>
                <label for="title">Titre</label>
                <input type="text" name="title" id="title" value="<?= $article['title'] ?>">
                <label for="volume">Tome</label>
                <input type="text" name="volume" id="volume" value="<?= $article['volume'] ?>">
                <label for="editor">Editeur</label>
                <input type="text" name="editor" id="editor" value="<?= $article['editor'] ?>">
                <label for="published_at">Date de publication</label>
                <input type="date" name="published_at" id="published_at" value="<?= $article['published_at'] ?>">
                <label for="author">Auteur</label>
                <input type="text" name="author" id="author" value="<?= $article['author'] ?>">
                <label for="bookshelf">Emplacement</label>
                <input type="text" name="bookshelf" id="bookshelf" value="<?= $article['bookshelf'] ?>">
                <label for="extract">Résumé</label>
                <textarea name="extract" id="extract" cols="50" rows="10"><?= $article['extract'] ?></textarea>
            <?php } ?>
        </fieldset>
        <a href="./list.php">Annuler</a>
        <input type="submit" name="submit" value="Envoyer">
    </form>
</section>

<?php if (isset($_SESSION['modified'])) : ?>
    <div id="confirmed-modified">
        <p><?= $_SESSION["modified"] ?></p>
    </div>
    <?php unset($_SESSION["modified"]); ?>
<?php endif; ?>

<?php if (isset($_SESSION['notModified'])) : ?>
    <div id="not-modified">
        <p><?= $_SESSION["notModified"] ?></p>
    </div>
    <?php unset($_SESSION["notModified"]); ?>
<?php endif; ?>

</main>
<script src="../asset/js/header-admin.js"></script>
</body>
</html>