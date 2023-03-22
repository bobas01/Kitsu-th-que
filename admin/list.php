<?php
session_start();

if (!isset($_SESSION['id-user']) && $_SESSION['role-user'] === 'admin') {
    header('Location: ./connect.php');
}

include_once '../connexion.php';
include_once './header-admin.php';

function resizeImg($tmp_name, $width, $height, $name)
{
    list($x, $y) = getimagesize($tmp_name);

    $ratio = min($width / $x, $height / $y);
    $new_width = round($x * $ratio);
    $new_height = round($y * $ratio);

    $ext = pathinfo($name, PATHINFO_EXTENSION);

    switch ($ext) {
        case 'jpg':
            $imageCreateFrom = 'imagecreatefromjpeg';
            $imageExt = 'imagejpeg';
            break;
        case 'jpeg':
            $imageCreateFrom = 'imagecreatefromjpeg';
            $imageExt = 'imagejpeg';
            break;
        case 'png':
            $imageCreateFrom = 'imagecreatefrompng';
            $imageExt = 'imagepng';
            break;
        case 'gif':
            $imageCreateFrom = 'imagecreatefromgif';
            $imageExt = 'imagegif';
            break;
    };

    $image = $imageCreateFrom($tmp_name);
    $image_p = imagecreatetruecolor($new_width, $new_height);
    imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $x, $y);

    $imageExt($image_p, "../asset/img/" . $name);
}

$sql = "SELECT `id`,`title`,`volume` FROM `manga` ORDER BY `id` DESC";
$req = $db->query($sql);
$manga = $req->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['submit-cat'])) {
    if (!empty($_POST['check_list'])) {
        $id = $_GET['id'];
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

<section id="list-category" class="new-post">
    <form action="#" method="POST" id="form-category">
        <fieldset class="manga-info">
            <legend>Ajouter une catégorie à <?= $manga['title'] ?> T. <?= $manga['volume'] ?></legend>
                <?php while ($category = $req->fetch(PDO::FETCH_ASSOC)) { ?>
                    <label for="<?= $category['slug'] ?>"><?= $category['name'] ?></label>
                    <input type="checkbox" id="<?= $category['slug'] ?>" name="check_list[]" value="<?= $category['id'] ?>">
                <?php } ?>
        </fieldset>
        <a class="annuler">Annuler</a>
        <input type="submit" name="submit-cat" value="Ajouter">
    </form>
    </div>
</section>
<section id="upload-img" class="new-post">
    <form action="#" enctype="multipart/form-data" method="POST" id="form-img">
        <fieldset class="manga-info">
            <legend>Ajouter une image à <?= $manga['title'] ?> T. <?= $manga['volume'] ?></legend>
            <label for="cover">Image de couverture</label>
            <input type="file" name="cover" accept="image/*">
        </fieldset>
        <a class="annuler">Annuler</a>
        <input type="submit" name="submit-img" value="Envoyer">

        <?php
        if (isset($_FILES['cover'])) {
            $id = $_GET['id'];
            $tmp_name = $_FILES['cover']['tmp_name'];
            $name = $_FILES['cover']['name'];
            $cover = $name;

            $manga = $db->prepare("UPDATE `manga`SET `cover`= :cover WHERE `id`= :id");
            $manga->bindParam(':id', $id, PDO::PARAM_INT);
            $manga->bindParam(':cover', $cover, PDO::PARAM_STR);
            $manga->execute();

            resizeImg($tmp_name, 350, 600, $name);

            $_SESSION['added'] = "Image ajouté avec succes!";
            header('Location: list.php');
            exit();
        } else {
            $_SESSION['error'] = "Ajout non effectué. Veuillez réessayer.";
        }
        ?>
    </form>
</section>
<section id="list-manga" class="row-limit-size">
    <h1>Listes des mangas</h1>
    <?php
    $sql = "SELECT `id`,`title`,`volume` FROM `manga` ORDER BY `id` DESC";
    $req = $db->query($sql);

    while ($manga = $req->fetch(PDO::FETCH_ASSOC)) {
    ?>
        <div class="list">
            <p><?= $manga['title'] ?></p>
            <p>T. <?= $manga['volume'] ?></p>
            <div class="placement">
                <ul id="menu-list">
                    <li><a href="#"><img id="add-img" src="../asset/img/icon/icon_img.svg" alt="Icone ajouter une image" title="Ajouter une image de couverture"></a></li>

                    <li><a href="#"><img id="add-category" src="../asset/img/icon/icon_category.svg" alt="Icone ajouter une catégorie" title="Ajouter une catégorie"></a></li>

                    <li><a href="./edit.php?id=<?= $manga['id'] ?>" class="edit-manga"><img src="../asset/img/icon/icon_edit.svg" alt="icone éditer les informations" title="Editer les informations"></a></li>

                    <li><a href="#" class="delete" data-titre="<?= $manga['title'] ?>" data-volume="<?= $manga['volume'] ?>" data-id="<?= $manga['id'] ?>"><img src="../asset/img/icon/icon_supprimer.svg" alt="Icone supprimer le post" title="Supprimer le manga"></a></li>
                </ul>
            </div>
        </div>
    <?php } ?>
</section>
</main>
<script src="../asset/js/header-admin.js"></script>
<script src="../asset/js/modal-delete.js"></script>
</body>

</html>