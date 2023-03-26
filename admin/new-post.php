<?php
session_start();

if (!isset($_SESSION['id-user']) || $_SESSION['role-user'] !== 'admin') {
    header('Location: ../index.php');
    exit();
}
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
    $bookshelf = $_POST['bookshelf'];
    $extract = $_POST['extract'];

    $manga = $db->prepare("INSERT INTO `manga`( `id_genre`, `id_public`, `title`, `volume`, `editor`, `published_at`, `author`, `bookshelf`, `extract` )VALUES (:genre, :public, :title, :volume, :editor, :published_at, :author, :bookshelf, :extract)");
    $manga->bindParam(':genre', $genre, PDO::PARAM_INT);
    $manga->bindParam(':public', $public, PDO::PARAM_INT);
    $manga->bindParam(':title', $title, PDO::PARAM_STR);
    $manga->bindParam(':volume', $volume, PDO::PARAM_INT);
    $manga->bindParam(':editor', $editor, PDO::PARAM_STR);
    $manga->bindParam(':published_at', $published_at, PDO::PARAM_STR);
    $manga->bindParam(':author', $author, PDO::PARAM_STR);
    $manga->bindParam(':bookshelf', $bookshelf, PDO::PARAM_STR);
    $manga->bindParam(':extract', $extract, PDO::PARAM_STR);

    if ($manga->execute()) {
        try {
            $_SESSION['success'] = "Manga ajouté";
            header('Location: list.php');
            exit();
        } catch (PDOException $e) {
            header('Location: ./list.php');
            $_SESSION['error1'] = "Il y a eu un problème lors de l'enregistrement des informations. Veuillez réessayer à nouveau.";
            exit();
        }
    }
}
?>

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

<?php if (isset($_SESSION['success'])) : ?>
    <div class="success">
        <p><?= $_SESSION["success"] ?></p>
    </div>
    <?php unset($_SESSION["success"]); ?>
<?php endif; ?>

<?php if (isset($_SESSION['error1'])) : ?>
    <div class="error">
        <p><?= $_SESSION["error1"] ?></p>
    </div>
    <?php unset($_SESSION["error1"]); ?>
<?php endif; ?>

<?php if (isset($_SESSION['error2'])) : ?>
    <div class="error">
        <p><?= $_SESSION["error2"] ?></p>
    </div>
    <?php unset($_SESSION["error2"]); ?>
<?php endif; ?>

</main>
<script src="../asset/js/header-admin.js"></script>
</body>

</html>