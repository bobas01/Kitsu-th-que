<?php
include_once '../connexion.php';
include_once './header-admin.php';
?>


<section id="list">
    <h1>Listes des mangas</h1>
    <?php

    $sql = "SELECT `id`,`title`,`volume`,`published_at` FROM `manga` ORDER BY `published_at` DESC ";
    $req = $db->query($sql);

    while ($manga = $req->fetch(PDO::FETCH_ASSOC)) {
    ?>

        <div id="list-manga">
            <p><?= $manga['title'] ?></p>
            <p><?= $manga['volume'] ?></p>
            <div>
                <div class="placement">
                    <a href="./add-category.php?id=<?= $manga['id'] ?>" class="add-category">Ajouter une catégorie</a>
                    <span> | </span>
                    <a href="./edit.php?id=<?= $manga['id'] ?>" class="edit-manga">Modifier</a>
                    <span> | </span>
                    <a href="./delete.php?id=<?= $manga['id'] ?>" class="delete-manga">Supprimer</a>
                </div>
            </div>
        </div>

    <?php } ?>
    </section>
</main>
<script src="../asset/js/header-admin.js"></script>
</body>
</html>