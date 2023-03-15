<?php
session_start();
require_once '../connexion.php';
require_once './header-admin.php';

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

    $imageExt($image_p, "../asset/img/" . $name);
}

?>

<section class="new-post">
    <form action="#" enctype="multipart/form-data" method="POST">
        <fieldset class="manga-info">
            <legend>Ajouter une image de couverture</legend>
            <label for="cover">Image de couverture</label>
            <input type="file" name="cover" accept="image/*">
        </fieldset>
        <input type="reset" name="reset" value="Annuler">
        <input type="submit" name="submit" value="Envoyer">

        <?php
        if (isset($_FILES['cover'])) {

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
</main>
</body>

</html>