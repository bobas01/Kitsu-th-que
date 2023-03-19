<?php
include_once '../connexion.php';
include_once './header-admin.php';

if (isset($_POST['submit'])) {
    $genre = $_POST['genre'];
    $public = $_POST['public'];
    $title = $_POST['title'];
    $volume = $_POST['volume'];
    $editor = $_POST['editor'];
    $published_at = $_POST['published_at'];
    $author = $_POST['author'];
    $extract = $_POST['extract'];
    $extract = $_POST['bookshelf'];

    $manga = $db->prepare("INSERT INTO `manga`( `id_genre`, `id_public`, `title`, `volume`, `editor`, `published_at`, `author`, `extract` )VALUES (:genre, :public, :title, :volume, :editor, :published_at, :author, :extract, :bookshelf)");
    $manga->bindParam(':genre', $genre, PDO::PARAM_INT);
    $manga->bindParam(':public', $public, PDO::PARAM_INT);
    $manga->bindParam(':title', $title, PDO::PARAM_STR);
    $manga->bindParam(':volume', $volume, PDO::PARAM_INT);
    $manga->bindParam(':editor', $editor, PDO::PARAM_STR);
    $manga->bindParam(':published_at', $published_at, PDO::PARAM_STR);
    $manga->bindParam(':author', $author, PDO::PARAM_STR);
    $manga->bindParam(':extract', $extract, PDO::PARAM_STR);
    $manga->bindParam(':bookshelf', $bookshelf, PDO::PARAM_STR);

    if ($manga->execute()) {
        $_SESSION['added'] = "Manga ajouté avec succes!";
        header('Location: list.php');
        exit();
    } else {
        $_SESSION['notAdded2'] = "Il y a eu un problème lors de l'enregistrement des informations. Veuillez reessayer à nouveau.";
    }
} ?>

<section class="new-post">
    <form action="#" method="POST">
        <fieldset class="manga-info">
            <legend>Nouveau manga</legend>
            <label for="genre">Genre</label>
            <select name="genre" id="genre">
                <?php
                $sql = "SELECT `id`,`name` FROM `genre`";
                $req = $db->query($sql);
                while ($genre = $req->fetch(PDO::FETCH_ASSOC)) { ?>
                    <option value="<?= $genre['id'] ?>"><?= $genre['name'] ?></option>
                <?php } ?>
            </select>
            <label for="public">Publique</label>
            <select name="public" id="public">
                <?php
                $sql = "SELECT `id`,`name` FROM `public`";
                $req = $db->query($sql);
                while ($public = $req->fetch(PDO::FETCH_ASSOC)) { ?>
                    <option value="<?= $public['id'] ?>"><?= $public['name'] ?></option>
                <?php } ?>
            </select>
            <label for="title">Titre</label>
            <input type="text" name="title" id="title">
            <label for="volume">Tome</label>
            <input type="text" name="volume" id="volume">
            <label for="editor">Editeur</label>
            <input type="text" name="editor" id="editor">
            <label for="published_at">Date de publication</label>
            <input type="date" name="published_at" id="published_at">
            <label for="author">Auteur</label>
            <input type="text" name="author" id="author">
            <label for="bookshelf">Emplacement</label>
            <input type="text" name="bookshelf" id="bookshelf">
            <label for="extract">Résumé</label>
            <textarea name="extract" id="extract" cols="50" rows="10"></textarea>
        </fieldset>
        <input type="reset" name="reset" value="Annuler">
        <input type="submit" name="submit" value="Envoyer">
    </form>
</section>
</main>
<script src="../asset/js/header-admin.js"></script>
</body>

</html>