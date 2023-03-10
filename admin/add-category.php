<?php
session_start();
include_once '../connexion.php';
include_once './header-admin.php';

if (isset($_POST['submit'])) {
    if (!empty($_POST['check_list'])) {
        foreach ($_POST['check_list'] as $id_category) {
            $id = $_GET['id'];
            $add = $db->prepare("INSERT INTO `manga_category`(`id_manga`, `id_category`)VALUES (:id, :id_category)");
            $add->bindParam('id', $id, PDO::PARAM_INT);
            $add->bindParam('id_category', $id_category, PDO::PARAM_INT);
            $add->execute();

            $_SESSION['sucess'] = "Catégorie(s) ajoutée(s) avec succès !";
            header('Location: ./list.php');
            exit();
        }
    } else {
        echo "<b> Please select at least one option !</b>";
    }
}
?>

<section class="categorie row-limite-size">
    <div class="row-limite-size">
    <h1>Ajouter une catégorie</h1>
    <form action="#" method="POST">
        <fieldset>
            <legend>Catégories</legend>
            <div>
                <?php
                $sql = "SELECT `id`,`name`,`slug` FROM `category`";
                $req = $db->query($sql);
                while ($category = $req->fetch(PDO::FETCH_ASSOC)) { ?>
                    <input type="checkbox" id="id_category" name="check_list[]" value="<?= $category['id'] ?>">
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
</section>
</main>
<script src="../asset/js/header-admin.js"></script>
</body>
</html>