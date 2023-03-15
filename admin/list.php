<?php
session_start();
include_once '../connexion.php';
include_once './header-admin.php';
?>


<section id="list-manga">
    <h1>Listes des mangas</h1>
    <?php
    $sql = "SELECT `id`,`title`,`volume` FROM `manga` ORDER BY `id` ASC";
    $req = $db->query($sql);

    while ($manga = $req->fetch(PDO::FETCH_ASSOC)) {
    ?>

        <div class="list">
            <p><?= $manga['title'] ?></p>
            <p><?= $manga['volume'] ?></p>
            <div>
                <div class="placement">
                    <a href="./add-img.php?id=<?= $manga['id'] ?>" class="add-img">Ajouter une image</a>
                    <span> | </span>
                    <a href="./add-category.php?id=<?= $manga['id'] ?>" data-idCat="<?= $manga['id'] ?>" class="add-category">Ajouter une catégorie</a>
                    <span> | </span>
                    <a href="./edit.php?id=<?= $manga['id'] ?>" class="edit-manga">Modifier</a>
                    <span> | </span>
                    <a href="#" class="delete" data-titre="<?= $manga['title'] ?>" data-volume="<?= $manga['volume'] ?>" data-id="<?= $manga['id'] ?>">Supprimer</a>
                </div>
            </div>
        </div>

    <?php } ?>
</section>
</main>
<script src="../asset/js/header-admin.js"></script>
<script src="../asset/js/modal-delete.js"></script>
</body>

</html>