<?php
session_start();
include_once '../connexion.php';
include_once './header-admin.php';

$id = $_GET['id'];

if (isset($_POST['submit'])) {
    if (!empty($_POST['check_list'])) {
        foreach ($_POST['check_list'] as $id_category) {
            $add = $db->prepare("INSERT INTO `manga_category`(`id_manga`, `id_category`)VALUES (:id, :id_category)");
            $add->bindParam('id', $id, PDO::PARAM_INT);
            $add->bindParam('id_category', $id_category, PDO::PARAM_INT);
            $add->execute();
        }

        $_SESSION['sucess'] = "Catégorie(s) ajoutée(s) avec succès !";
            header('Location: ./list.php');
            exit();
    } else {
        $_SESSION['error'] = "Ajout non effectué. Veuillez réessayer.";
    }
}

$sql = "SELECT `id`,`name`,`slug` FROM `category`";
$req = $db->query($sql);
?>

<section class="new-post">
    <form action="#" method="POST">
        <fieldset class="manga-info">
            <legend>Ajouter une catégorie</legend>
                <?php while ($category = $req->fetch(PDO::FETCH_ASSOC)) { ?>
                    <label for="<?= $category['slug'] ?>"><?= $category['name'] ?></label>
                    <input type="checkbox" id="<?= $category['slug'] ?>" name="check_list[]" value="<?= $category['id'] ?>">
                <?php } ?>
        </fieldset>
        <input type="reset" name="reset" value="Annuler">
        <input type="submit" name="submit" value="Ajouter">
    </form>
    </div>
</section>
</main>
<script src="../asset/js/header-admin.js"></script>
</body>
</html>