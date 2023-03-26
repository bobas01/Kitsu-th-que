<?php
session_start();

if (!isset($_SESSION['id-user']) || $_SESSION['role-user'] !== 'admin') {
    header('Location: ../index.php');
    exit();
}
include_once '../connexion.php';
include_once './header-admin.php';
?>

<section id="list-manga" class="row-limit-size">
    <h1>Listes des mangas</h1>
    <?php
    $sql = "SELECT `id`,`title`,`volume` FROM `manga` ORDER BY `id` DESC";
    $req = $db->query($sql);
    while ($manga = $req->fetch(PDO::FETCH_ASSOC)) {
    ?>
        <div class="list">
            <p><?= $manga['title'] ?></p>
            <p>T.<?= $manga['volume'] ?></p>
            <div class="placement">
                <ul id="menu-list">
                    <li><a href="./add-img.php?id=<?= $manga['id'] ?>"><img class="add-img" src="../asset/img/icon/icon_img.svg" alt="Icone ajouter une image" title="Ajouter une image de couverture"></a></li>

                    <li><a href="./add-category.php?id=<?= $manga['id'] ?>"><img id="add-category" src="../asset/img/icon/icon_category.svg" alt="Icone ajouter une catégorie" title="Ajouter une catégorie"></a></li>

                    <li><a href="./edit.php?id=<?= $manga['id'] ?>" class="edit-manga"><img src="../asset/img/icon/icon_edit.svg" alt="icone éditer les informations" title="Editer les informations"></a></li>

                    <li><a href="#" class="delete" data-titre="<?= $manga['title'] ?>" data-volume="<?= $manga['volume'] ?>" data-id="<?= $manga['id'] ?>"><img src="../asset/img/icon/icon_supprimer.svg" alt="Icone supprimer le post" title="Supprimer le manga"></a></li>
                </ul>
            </div>
        </div>

    <?php } ?>
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
<script src="../asset/js/modal-delete.js"></script>
</body>

</html>