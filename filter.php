<?php


include_once './connexion.php';

$datas = json_decode(file_get_contents('php://input'), true);
$dataGenre = $datas["genre"];
$dataPublic = $datas["public"];
$dataCat = $datas["category"];
// $sqlGenre="SELECT `manga`.`id`,`manga`.`volume`,`manga`.`title`,`manga`.`cover` FROM `manga` 
// INNER JOIN `genre` ON `manga`.`id_genre`=`genre`.`id`
// WHERE `genre`.`slug` =:slugGenre;";
// $req = $db->prepare($sqlGenre);
// $req->execute([':slugGenre' => $dataGenre[0]]);
// $genreResults = $req->fetchAll();
// $sqlPublic="SELECT `manga`.`id`,`manga`.`volume`,`manga`.`title`,`manga`.`cover` FROM `manga` 
// INNER JOIN `public` ON `manga`.`id_public`=`public`.`id`
// WHERE `public`.`slug` = :slugPublic";
// $req2 = $db->prepare($sqlPublic);
// $req2->execute([':slugPublic' => $dataPublic[0]]);
// $publicResults = $req2->fetchAll();
// $sqlCat="SELECT `manga`.`id`,`manga`.`volume`,`manga`.`title`,`manga`.`cover` FROM `manga` 
// INNER JOIN `manga_category` ON `manga_category`.`id_manga`= `manga`.`id`
// INNER JOIN `category` ON `manga_category`.`id_category`= `category`.`id`
// WHERE `category`.`slug` =:slugCat;";  
// $req3 = $db->prepare($sqlCat);
// $req3->execute(['slugCat' => $dataCat[0]]);
// $catResults = $req3->fetchAll();

// $genreIds = array_column($genreResults, 'id');
// $publicIds = array_column($publicResults, 'id');
// $catIds = array_column($catResults, 'id');
// $commonIds = array_intersect($genreIds, $publicIds, $catIds);


// $sql = "SELECT `manga`.`id`,`manga`.`volume`,`manga`.`title`,`manga`.`cover` FROM `manga` WHERE `manga`.`id` IN (" . implode(',', $commonIds) . ")";
// $req = $db->prepare($sql);
// $req->execute();
// $dataGroup = $req->fetchAll();
// echo json_encode($dataGroup);

//   function test($array){
//     $s = '';
//     $n = count($array);
//     for($i = 0; $i < $n; $i++){
//       $s .= "'" . $array[$i] . "'";

//       if($i !== $n - 1){
//         $s .= ',';
//       }
//     }
//     return $s;
//   }
// $datas = json_decode(file_get_contents('php://input'), true);

// $dataGenre = $datas["genre"];
// $dataPublic = $datas["public"];
// $dataCat = $datas["category"];

// $datas = [];
// if (!empty($dataGenre)) {
//   $genre = test($dataGenre);
//   $sql = "SELECT DISTINCT `manga`.`id`, `manga`.`volume`, `manga`.`title`, `manga`.`cover` FROM `manga` INNER JOIN `genre` ON `manga`.`id_genre`=`genre`.`id` WHERE `genre`.`slug` IN ($genre) ORDER BY `manga`.`id` DESC";
//   $req = $db->query($sql);

//   foreach($req->fetchAll(PDO::FETCH_ASSOC) as $manga){
//     $datas[$manga["id"]] = $manga;
//   }


// }

// if (!empty($dataPublic)) {
//   $public = test($dataPublic);
//   $sql2 = "SELECT DISTINCT `manga`.`id`, `manga`.`volume`, `manga`.`title`, `manga`.`cover` FROM `manga` INNER JOIN `public` ON `manga`.`id_public`=`public`.`id` WHERE `public`.`slug` IN ($public) ORDER BY `manga`.`id` DESC";
//   $req = $db->query($sql2);
//   foreach($req->fetchAll(PDO::FETCH_ASSOC) as $manga){
//     $datas[$manga["id"]] = $manga;
//   }

// }

// if (!empty($dataCat)) {
//   $cat = test($dataCat);
//   $sql3 = "SELECT DISTINCT `manga`.`id`, `manga`.`volume`, `manga`.`title`, `manga`.`cover` FROM `manga` INNER JOIN `manga_category` ON `manga_category`.`id_manga`= `manga`.`id` INNER JOIN `category` ON `manga_category`.`id_category`= `category`.`id` WHERE `category`.`slug` IN ($cat) ORDER BY `manga`.`id` DESC";
//   $req = $db->query($sql3);

//   foreach($req->fetchAll(PDO::FETCH_ASSOC) as $manga){
//     $datas[$manga["id"]] = $manga;
//   }
// }

// $nb = count($datas);

// switch($nb){
//   case 1:
//     $lastdatas = $datas[0];
//     break;
//   case 2:
//     $lastdatas = array_merge($datas[0], $datas[1]);
//     $lastdatas = array_unique($lastdatas, SORT_REGULAR);
//     break;
//   case 3:
//     $lastdatas= array_merge($datas[0], $datas[1], $datas[2]);
//     $lastdatas = array_unique($lastdatas, SORT_REGULAR);
// }


$sql = "SELECT DISTINCT `manga`.`id`,`manga`.`volume`,`manga`.`title`,`manga`.`cover`
  FROM `manga` 
  INNER JOIN `manga_category` ON `manga_category`.`id_manga`= `manga`.`id`
  INNER JOIN `category` ON `manga_category`.`id_category`= `category`.`id`
  INNER JOIN `genre` ON `manga`.`id_genre`=`genre`.`id`
  INNER JOIN `public` ON `manga`.`id_public`=`public`.`id`";
$conditions = [];
$parameters=[];

if (!empty($datas["public"])) {
  $cond = " `public`.`slug` IN (";
  for($i=0 ; $i<count($dataPublic) ; $i++) {
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
  for($i=0 ; $i<count($dataGenre) ; $i++) {
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
  for($i=0 ; $i<count($dataCat) ; $i++) {
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
      $first=false;
    }
    else {
      $sql.= " AND ";
    }
    $sql.=$condition;
  }
}

$req = $db->prepare($sql);

$req->execute($parameters);


$datas = $req->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($datas);
