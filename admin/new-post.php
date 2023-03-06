<?php
include_once '../connexion.php';

if (isset($_POST['submit'])) {
    $genre = addslashes($_POST['genre']);
    $public = addslashes($_POST['public']);
    $title = addslashes($_POST['title']);
    $volume = addslashes($_POST['volume']);
    $editor = addslashes($_POST['editor']);
    $published_at = addslashes($_POST['published_at']);
    $author = addslashes($_POST['author']);
    $cover = 'image.jpg';
    $extract = addslashes($_POST['extract']);

    $sql = "INSERT INTO `manga`( `id_genre`, `id_public`, `title`, `volume`, `editor`, `published_at`, `author`, `cover`, `extract` )VALUES ('$genre', '$public', '$title', '$volume', '$editor', '$published_at', '$author', '$cover', '$extract')";
    $db->query($sql);

    $_SESSION['sucess'] = "Produit ajouté avec succès !";
    header('Location: ./list.php');
    exit();
}

?>

<div class="row-limite-size">
    <h1>Nouveau manga</h1>
    <form action="#" method="POST">
        <fieldset>
            <legend>Nouveau manga</legend>
            <div>
                <label for="genre">Genre</label><br>
                <input type="text" name="genre" id="genre" maxlength="50">
                <br>
                <label for="public">Publique</label><br>
                <input type="text" name="public" id="public" maxlength="50">
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
                <input type="file" name="cover" id="cover">
                <label for="category">Catégories</label>
                <input type="text" name="category" id="category">-->
                <br>
                <label for="extract">Résumé</label><br>
                <textarea name="extract" id="extract" cols="100" rows="5" maxlength="255"></textarea>
            </div>
        </fieldset>
        <fieldset id="btn">
            <legend>Post/Reset</legend>
            <input type="submit" name="submit" value="Post ">
            <input type="reset" name="reset" value="Reset">
        </fieldset>
    </form>
</div>
</main>

</body>