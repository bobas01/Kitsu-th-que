<?php
session_start();

if (!isset($_SESSION['id-user']) || $_SESSION['role-user'] !== 'admin') {
    header('Location: ../index.php');
    exit();
}
include_once '../connexion.php';
include_once './header-admin.php';

$id = $_GET['id'];

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

    $imageExt($image_p, "../asset/img/premiere-page" . $name);
}

?>

<section class="new-post row-limit-size">
    <form action="#" enctype="multipart/form-data" method="POST">
        <fieldset class="send-img">
            <?php
            $sql = $db->prepare("SELECT `id`,`title`,`volume` FROM `manga` WHERE `id` = :id");
            $sql->bindParam(':id', $id, PDO::PARAM_STR);
            $sql->execute();
            while ($manga = $sql->fetch(PDO::FETCH_ASSOC)) {
            ?>
                <legend>Ajouter une image à <?= $manga['title'] ?> T. <?= $manga['volume'] ?></legend>
            <?php } ?>
            <label for="cover">Image de couverture</label>
            <input type="file" name="cover" accept="image/*">
        </fieldset>
        <a href="./list.php" class="annuler">Annuler</a>
        <input type="submit" name="submit" value="Envoyer">
        <?php
        try {
            if (isset($_FILES['cover'])) {

                $tmp_name = $_FILES['cover']['tmp_name'];
                $name = $_FILES['cover']['name'];
                $cover = $name;

                $manga = $db->prepare("UPDATE `manga` SET `cover`= :cover WHERE `id`= :id");
                $manga->bindParam(':id', $id, PDO::PARAM_INT);
                $manga->bindParam(':cover', $cover, PDO::PARAM_STR);
                $manga->execute();

                resizeImg($tmp_name, 350, 600, $name);

                header('Location: ./list.php');
                $_SESSION['success'] = "Image ajoutée";
                exit();
            }
        } catch (PDOException $e) {
            header('Location: ./list.php');
            $_SESSION['error1'] = "Ajout non effectué";
            exit();
        } ?>
    </form>
</section>
</main>
</body>

</html>