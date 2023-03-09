<?php
include_once '../connexion.php';
include_once './header-admin.php';

if (isset($_POST['submit'])) {
    /* Ajout de nouveau livre */
    $genre = addslashes($_POST['genre']);
    $public = addslashes($_POST['public']);
    $title = addslashes($_POST['title']);
    $volume = addslashes($_POST['volume']);
    $editor = addslashes($_POST['editor']);
    $published_at = addslashes(date('Y-m-d', strtotime($_POST['published_at'])));
    $author = addslashes($_POST['author']);
    $cover = 'image.jpg';
    $extract = addslashes($_POST['extract']);

    $manga = $db->prepare("INSERT INTO `manga`( `id_genre`, `id_public`, `title`, `volume`, `editor`, `published_at`, `author`, `cover`, `extract` )VALUES (:id_genre, :id_public, :title, :volume, :editor, :published_at, :author, :cover, :extract)");
    $manga->bindParam('id_genre', $genre, PDO::PARAM_INT);
    $manga->bindParam('id_public', $public, PDO::PARAM_INT);
    $manga->bindParam('title', $title, PDO::PARAM_INT);
    $manga->bindParam('volume', $volume, PDO::PARAM_INT);
    $manga->bindParam('editor', $editor, PDO::PARAM_INT);
    $manga->bindParam('published_at', $published_at, PDO::PARAM_INT);
    $manga->bindParam('author', $author, PDO::PARAM_INT);
    $manga->bindParam('cover', $cover, PDO::PARAM_INT);
    $manga->bindParam('extract', $extract, PDO::PARAM_INT);

    $manga->execute();
    header('Location: ./list.php');
}

?>
<section class="new-post row-limite-size">
 <div class="row-limite-size">
    <h1>Nouveau manga</h1>
    <form action="#" method="POST">
        <fieldset>
            <legend>Nouveau manga</legend>
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
                <input type="text" name="title" id="title" maxlength="50">
                <br>
                <label for="volume">Tome</label><br>
                <input type="text" name="volume" id="volume" maxlength="50">
                <br>
                <label for="editor">Editeur</label><br>
                <input type="text" name="editor" id="editor" maxlength="50">
                <br>
                <label for="published_at">Date de publication</label><br>
                <input type="date" name="published_at" id="published_at" maxlength="50">
                <br>
                <label for="author">Auteur</label><br>
                <input type="author" name="author" id="author" maxlength="50">
                <!--<label for="cover">Page de couverture</label>
                <input type="file" name="cover" id="cover">-->
                <br>
                <label for="extract">Résumé</label><br>
                <textarea name="extract" id="extract" cols="50" rows="5" maxlength="255"></textarea>
            </div> 
        </fieldset>

        <fieldset id="btn">
            <legend>Post/Reset</legend>
            <input type="submit" name="submit" value="Post ">
            <input type="reset" name="reset" value="Reset">
        </fieldset>
    </form>
</div>   
</section>
</main>
</body>