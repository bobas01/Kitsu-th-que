<?php


  include_once './connexion.php';
  
  $datas = json_decode(file_get_contents('php://input'), true);
  $dataGenre = $datas["genre"];
  $dataPublic = $datas["public"];
  $dataCat = $datas["category"];
  $sqlGenre="SELECT `manga`.`id`,`manga`.`volume`,`manga`.`title`,`manga`.`cover` FROM `manga` 
  INNER JOIN `genre` ON `manga`.`id_genre`=`genre`.`id`
  WHERE `genre`.`slug` =:slugGenre;";
  $req = $db->prepare($sqlGenre);
  $req->execute([':slugGenre' => $dataGenre[0]]);
  $genreResults = $req->fetchAll();
  $sqlPublic="SELECT `manga`.`id`,`manga`.`volume`,`manga`.`title`,`manga`.`cover` FROM `manga` 
  INNER JOIN `public` ON `manga`.`id_public`=`public`.`id`
  WHERE `public`.`slug` = :slugPublic";
  $req2 = $db->prepare($sqlPublic);
  $req2->execute([':slugPublic' => $dataPublic[0]]);
  $publicResults = $req2->fetchAll();
  $sqlCat="SELECT `manga`.`id`,`manga`.`volume`,`manga`.`title`,`manga`.`cover` FROM `manga` 
  INNER JOIN `manga_category` ON `manga_category`.`id_manga`= `manga`.`id`
  INNER JOIN `category` ON `manga_category`.`id_category`= `category`.`id`
  WHERE `category`.`slug` =:slugCat;";  
  $req3 = $db->prepare($sqlCat);
  $req3->execute(['slugCat' => $dataCat[0]]);
  $catResults = $req3->fetchAll();

  $genreIds = array_column($genreResults, 'id');
  $publicIds = array_column($publicResults, 'id');
  $catIds = array_column($catResults, 'id');
  $commonIds = array_intersect($genreIds, $publicIds, $catIds);
 
 
  $sql = "SELECT `manga`.`id`,`manga`.`volume`,`manga`.`title`,`manga`.`cover` FROM `manga` WHERE `manga`.`id` IN (" . implode(',', $commonIds) . ")";
  $req = $db->prepare($sql);
  $req->execute();
  $dataGroup = $req->fetchAll();
  
  echo json_encode($dataGroup);
 
 
  
  
  
  
  
  
  
  
  
  
