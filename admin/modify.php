<?php
session_start();
require_once '../connexion.php';
include_once './header-admin.php';

$id = $_GET['id'];
?>

<div class="row-limite-size">
    <h1>Modifier l'article</h1>
    <form action="#" method="POST">
        <?php

        $req = $db->prepare("SELECT `id`,`title`,`volume`,`editor`,`published_at`,`author`,`cover`,`extract` FROM `manga`  WHERE `id`  = :id");
        $req->bindParam('id', $id, PDO::PARAM_INT);
        $req->execute();

        $article = $req->fetch(PDO::FETCH_ASSOC); ?>

        <fieldset>
            <legend>Manga</legend>
            <div>
                <label for="genre">Genre</label><br>
                <select name="genre" id="genre">
                    <?php
                    $sql = "SELECT `id`,`name` FROM `genre`";
                    $req = $db->query($sql);
                    while ($genre = $req->fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?= $genre['id'] ?>"><?= $genre['name'] ?></option>
                    <?php } ?>
                </select>
                <br>
                <label for="public">Publique</label><br>
                <select name="public" id="public">
                    <?php
                    $sql = "SELECT `id`,`name` FROM `public`";
                    $req = $db->query($sql);
                    while ($public = $req->fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?= $public['id'] ?>"><?= $public['name'] ?></option>
                    <?php } ?>
                </select>
                <br>
                <label for="title">Titre</label><br>
                <input type="text" name="title" id="title" value="<?= $article['title'] ?>" maxlength="50">
                <br>
                <label for="volume">Tome</label><br>
                <input type="text" name="volume" id="volume" value="<?= $article['volume'] ?>" maxlength="50">
                <br>
                <label for="editor">Editeur</label><br>
                <input type="text" name="editor" id="editor" value="<?= $article['editor'] ?>" maxlength="50">
                <br>
                <label for="published_at">Date de publication</label><br>
                <input type="date" name="published_at" id="published_at" value="<?= $article['published_at'] ?>" maxlength="50">
                <br>
                <label for="author">Auteur</label><br>
                <input type="author" name="author" id="author" value="<?= $article['author'] ?>" maxlength="50">
                <!--<label for="cover">Page de couverture</label>
                <input type="file" name="cover" id="cover">-->
                <br>
                <label for="extract">Résumé</label><br>
                <textarea name="extract" id="extract" cols="50" rows="5" maxlength="255"><?= $article['extract'] ?></textarea>
            </div>
        </fieldset>

        <fieldset id="btn">
            <legend>Modifier les informations</legend>
            <?php
            if (isset($_POST['submit'])) {
                $id_genre = addslashes($_POST['genre']);
                $id_public = addslashes($_POST['public']);
                $title = addslashes($_POST['title']);
                $volume = addslashes($_POST['volume']);
                $editor = addslashes($_POST['editor']);
                $published_at = date('Y-m-d', strtotime($_POST['published_at']));
                $author = addslashes($_POST['author']);
                $cover = 'image.jpg';
                $extract = addslashes($_POST['extract']);


                $reqSend = $db->prepare("UPDATE `manga`  SET `id_genre`=:id_genre, `id_public`=:id_public, `title`=:title, `volume`=:volume, `editor`=:editor, `published_at`=:published_at, `author`=:author, `cover`=:cover, `extract`=:extract WHERE  `id`=:id ;");
                $reqSend->bindParam('id', $id, PDO::PARAM_INT);
                $reqSend->bindParam('id_genre', $id_genre, PDO::PARAM_INT);
                $reqSend->bindParam('id_public', $id_public, PDO::PARAM_INT);
                $reqSend->bindParam('title', $title, PDO::PARAM_INT);
                $reqSend->bindParam('volume', $volume, PDO::PARAM_INT);
                $reqSend->bindParam('editor', $editor, PDO::PARAM_INT);
                $reqSend->bindParam('published_at', $published_at, PDO::PARAM_INT);
                $reqSend->bindParam('author', $author, PDO::PARAM_INT);
                $reqSend->bindParam('cover', $cover, PDO::PARAM_INT);
                $reqSend->bindParam('extract', $extract, PDO::PARAM_INT);

                $reqSend->execute();
                $articleSend = $req->fetch(PDO::FETCH_ASSOC);

                if ($articleSend) {
                    $_SESSION['status'] = "Date values Inserted";
                    header("Location: modify.php");
                } else {
                    $_SESSION['status'] = "Date values Inserting Failed";
                    header("Location: modify.php");
                }

            } ?>
            <input type="submit" name="submit" value="Edit ">
            <input type="reset" name="reset" value="Reset">
            <a href="./list.php">Revenir vers la liste des articles</a>
            
            <?php 
                    if(isset($_SESSION['status']))
                    {
                        ?>
                            <div>
                            <strong>Hey!</strong> <?php echo $_SESSION['status']; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php
                        unset($_SESSION['status']);
                    }
                ?>

        </fieldset>

    </form>
</div>

</main>
</body>

</html>