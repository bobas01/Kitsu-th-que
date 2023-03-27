<?php


include_once './connexion.php';

$datas = json_decode(file_get_contents('php://input'), true);
$dataGenre = $datas["genre"];
$dataPublic = $datas["public"];
$dataCat = $datas["category"];



$sql = "SELECT DISTINCT `manga`.`id`,`manga`.`volume`,`manga`.`title`,`manga`.`cover`
  FROM `manga` 
  INNER JOIN `manga_category` ON `manga_category`.`id_manga`= `manga`.`id`
  INNER JOIN `category` ON `manga_category`.`id_category`= `category`.`id`
  INNER JOIN `genre` ON `manga`.`id_genre`=`genre`.`id`
  INNER JOIN `public` ON `manga`.`id_public`=`public`.`id`";
$conditions = [];
$parameters = [];

if (!empty($datas["public"])) {
  $cond = " `public`.`slug` IN (";
  for ($i = 0; $i < count($dataPublic); $i++) {
    if ($i > 0) {
      $cond .= ",";
    }
    $cond .= "?";
    $parameters[] = $dataPublic[$i];
  }
  $conditions[] = $cond . ")";
}

if (!empty($datas["genre"])) {
  $cond = " `genre`.`slug` IN (";
  for ($i = 0; $i < count($dataGenre); $i++) {
    if ($i > 0) {
      $cond .= ",";
    }
    $cond .= "?";
    $parameters[] = $dataGenre[$i];
  }
  $conditions[] = $cond . ")";
}

if (!empty($datas["category"])) {
  $cond = " `category`.`slug` IN (";
  for ($i = 0; $i < count($dataCat); $i++) {
    if ($i > 0) {
      $cond .= ",";
    }
    $cond .= "?";
    $parameters[] = $dataCat[$i];
  }
  $conditions[] = $cond . ")";
}

if (!empty($conditions)) {
  $first = true;
  $cond = "";
  foreach ($conditions as $condition) {
    if ($first) {
      $sql .= " WHERE ";
      $first = false;
    } else {
      $sql .= " AND ";
    }
    $sql .= $condition;
  }
}

$req = $db->prepare($sql);

$req->execute($parameters);


$datas = $req->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($datas);
