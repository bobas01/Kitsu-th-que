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
    $research = null;
    $id = 1;

    if (isset($_GET["search"])) {
        $_GET["search"] = htmlspecialchars($_GET["search"]);

        $research = $_GET['search'];
        $research = trim($research);
        $research = strip_tags($research);
    }
    if (!empty($research)) {
        $research = strtolower($research);
        $search_term = '%' . $research . '%';
        $select_research = $db->prepare("SELECT DISTINCT `manga`.`id`,`manga`.`volume`,`manga`.`extract`,`manga`.`title`,`manga`.`cover` FROM `manga` 
        INNER JOIN `genre` ON `manga`.`id_genre`=`genre`.`id`
        INNER JOIN `public` ON `manga`.`id_public`=`public`.`id`
        INNER JOIN `manga_category` ON `manga_category`.`id_manga`= `manga`.`id`
        INNER JOIN `category` ON `manga_category`.`id_category`= `category`.`id`             
        WHERE `manga`.`volume` LIKE :search_term OR `manga`.`author` LIKE :search_term OR `manga`.`title` LIKE  :search_term 
        OR  `genre`.`slug` LIKE  :search_term OR`category`.`slug` LIKE  :search_term OR `public`.`slug` LIKE   :search_term 
        ORDER BY `id` ;");
        $select_research->bindValue(':search_term', $search_term, PDO::PARAM_STR);
        $select_research->execute();
    } else {
        header('Location: ./list.php');
    }

    $sql = "SELECT `id`,`title`,`volume` FROM `manga` ORDER BY `id` DESC";
    $req = $db->query($sql);
    while ($research_find = $select_research->fetch()) { ?>
        <div class="list">
            <p><?= $research_find['title'] ?></p>
            <p>T. <?= $research_find['volume'] ?></p>
            <div class="placement">
                <ul id="menu-list">
                    <li><a href="./add-img.php?id=<?= $research_find['id'] ?>"><img class="add-img" src="../asset/img/icon/icon_img.svg" alt="Icone ajouter une image" title="Ajouter une image de couverture"></a></li>

                    <li><a href="./add-category.php?id=<?= $research_find['id'] ?>"><img id="add-category" src="../asset/img/icon/icon_category.svg" alt="Icone ajouter une catégorie" title="Ajouter une catégorie"></a></li>

                    <li><a href="./edit.php?id=<?= $research_find['id'] ?>" class="edit-manga"><img src="../asset/img/icon/icon_edit.svg" alt="icone éditer les informations" title="Editer les informations"></a></li>

                    <li><a href="#" class="delete" data-titre="<?= $research_find['title'] ?>" data-volume="<?= $research_find['volume'] ?>" data-id="<?= $research_find['id'] ?>"><img src="../asset/img/icon/icon_supprimer.svg" alt="Icone supprimer le post" title="Supprimer le manga"></a></li>
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