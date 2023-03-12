<?php

$tmp_name = $_FILES['image']['tmp_name'];
$name = $_FILES['image']['name'];

/*resizeImg($tmp_name, 300, 100, 's-' . $name);
resizeImg($tmp_name, 500, 300, 'm-' . $name);
resizeImg($tmp_name, 1920, 1080, 'xl-' . $name);*/

function resizeImg($tmp, $width, $height, $name)
{
    list($x, $y) = getimagesize($tmp);

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

    $image = $imageCreateFrom($tmp);
    $image_p = imagecreatetruecolor($new_width, $new_height);
    imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $x, $y);

    $imageExt($image_p, "img/" . $name);
}
