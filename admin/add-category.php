<?php
include_once '../connexion.php';

$id = $_GET['id'];
?>

<?php
if (isset($_POST['submit'])) {
    $id_category = addslashes($_POST['id_category']);

    $sql1 = "INSERT INTO `manga_category`(`id_manga`, `id_category`)VALUES ('$id', '$id_category')";
    $db->query($sql1);

    $_SESSION['sucess'] = "Catégorie(s) ajoutée(s) avec succès !";
    header('Location: ./list.php');
    exit();
}
?>

<div class="row-limite-size">
    <h1>Ajouter une catégorie</h1>
    <form action="#" method="POST">
        <fieldset>
            <legend>Catégories</legend>
            <div>
                <?php
                $sql2 = "SELECT `id`,`name`,`slug` FROM `category`";
                $req = $db->query($sql2);
                while ($category = $req->fetch(PDO::FETCH_ASSOC)) { ?>
                    <input type="checkbox" id="id_category" name="category[]">
                    <label for="<?= $category['slug'] ?>"><?= $category['name'] ?></label><br>
                <?php } ?>
                <br>
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