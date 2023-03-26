<?php
session_start();

if (!isset($_SESSION['id-user']) || $_SESSION['role-user'] !== 'admin') {
    header('Location: ../index.php');
    exit();
}
include_once '../connexion.php';
include_once './header-admin.php';

$id = $_GET['id'];

if (isset($_POST['submit'])) {
    try {
    if (!empty($_POST['check_list'])) {
        foreach ($_POST['check_list'] as $id_category) {
            $add = $db->prepare("INSERT INTO `manga_category`(`id_manga`, `id_category`)VALUES (:id, :id_category)");
            $add->bindParam('id', $id, PDO::PARAM_INT);
            $add->bindParam('id_category', $id_category, PDO::PARAM_INT);
            $add->execute();
        }

        $_SESSION['success'] = "Catégorie(s) ajoutée(s)";
        header('Location: ./list.php');
        exit();
        }
    } catch (PDOException $e) {
        header('Location: ./list.php');
        $_SESSION['error1'] = "Ajout non effectué";
        exit();
    }
}

$sql = "SELECT `id`,`name`,`slug` FROM `category`";
$req = $db->query($sql);
?>

<section class="new-post row-limit-size">
    <form action="#" method="POST">
        <fieldset class="cat-info">
            <?php
            $sql = $db->prepare("SELECT `id`,`title`,`volume` FROM `manga` WHERE `id` = :id");
            $sql->bindParam(':id', $id, PDO::PARAM_STR);
            $sql->execute();
            while ($manga = $sql->fetch(PDO::FETCH_ASSOC)) {
            ?>
                <legend>Ajouter une catégorie à <?= $manga['title'] ?> T. <?= $manga['volume'] ?></legend>
            <?php } ?>
            <?php while ($category = $req->fetch(PDO::FETCH_ASSOC)) { ?>
                <label for="<?= $category['slug'] ?>"><?= $category['name'] ?></label>
                <input type="checkbox" id="<?= $category['slug'] ?>" name="check_list[]" value="<?= $category['id'] ?>">
            <?php } ?>
        </fieldset>
        <a href="./list.php" class="annuler">Annuler</a>
        <input type="submit" name="submit" value="Ajouter">
    </form>
    </div>
</section>
</main>
<script src="../asset/js/header-admin.js"></script>
</body>
</html>