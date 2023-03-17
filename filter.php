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
 
 
  
  
  
  
  
  
  
  
  
  
  // $results = array_intersect($genreResults, $publicResults, $catResults);
  // -- 
  // -- INNER JOIN `manga_category` ON `manga_category`.`id_manga`= `manga`.`id`
  // -- INNER JOIN `category` ON `manga_category`.`id_category`= `category`.`id`
  // -- WHERE" ;              
  // // -- WHERE   `category`.`slug` =:slugCat   OR `genre`.`slug` =:slugGenre OR
  // // -- `public`.`slug` = : slugPublic ORDER BY :id );
  // // $select_research->bindValue(':search_term', $search_term, db::PARAM_STR);
  // // $select_research->bindParam(':id', $id, db::PARAM_INT);
  // // $select_research->execute();
  // // array intersect evenement unchange peut comparer 3 array si pas possible comparer les 2 premier avec le troisieme
  // $id=$_POST["id"];
  // if (isset($_POST['category'])){ 
  //     $category = $_POST['category'];
  //     $sql .= " `category`.`slug` =:slugCat ";
  //   }
    
  // if (isset($_POST['genre'])){ 
  //     $genre = $_POST['genre'];
  //     $sql .= " `genre`.`slug` =:slugGenre";
  //   }
    
  // if (isset($_POST['public'])){ 
  //     $public = $_POST['public'];
  //     $sql .= " `public`.`slug` = : slugPublic";
  //   }
  
  //   if(isset($_POST['category']) || isset($_POST['genre']) || isset($_POST['public'])) {
  //     $category = $_POST['category'];
  //     $genre = $_POST['genre'];
  //     $public = $_POST['public'];
  //     $sql = "SELECT `manga`.`id`,`manga`.`volume`,`manga`.`title`,`manga`.`cover` FROM `manga` 
  //     INNER JOIN `genre` ON `manga`.`id_genre`=`genre`.`id`
  //     INNER JOIN `public` ON `manga`.`id_public`=`public`.`id`
  //     INNER JOIN `manga_category` ON `manga_category`.`id_manga`= `manga`.`id`
  //     INNER JOIN `category` ON `manga_category`.`id_category`= `category`.`id`
  //     WHERE `category`.`slug` =:slugCat   OR `genre`.`slug` =:slugGenre OR
  //     `public`.`slug` = : slugPublic ORDER BY :id );";
  //   }
  //   $sql.= "ORDER BY :id;";
  //   $req= $db->prepare($sql);
  //   $req->bindParam(":slugCat", $category, db::PARAM_STR);
  //   $req->bindParam(":slugGenre", $genre, db::PARAM_STR);
  //   $req->bindParam(":slugPublic", $public, db::PARAM_STR);
  //   $req->bindParam(":id", $id, db::PARAM_STR);
  //   $req->execute();
  
  
    
    
  
  
  
//     $category = $_POST['category'];
//     $sql .= " `category`.`slug` =:slugCat ";
//   }
  
// if (isset($_POST['genre'])){ 
//     $genre = $_POST['genre'];
//     $sql .= " `genre`.`slug` =:slugGenre";
//   }
  
// if (isset($_POST['public'])){ 
//     $public = $_POST['public'];
//     $sql .= " `public`.`slug` = : slugPublic";
//   }

//   if(isset($_POST['category']) || isset($_POST['genre']) || isset($_POST['public'])) {
//     $category = $_POST['category'];
//     $genre = $_POST['genre'];
//     $public = $_POST['public'];
//     $sql = "SELECT `manga`.`id`,`manga`.`volume`,`manga`.`title`,`manga`.`cover` FROM `manga` 
//     INNER JOIN `genre` ON `manga`.`id_genre`=`genre`.`id`
//     INNER JOIN `public` ON `manga`.`id_public`=`public`.`id`
//     INNER JOIN `manga_category` ON `manga_category`.`id_manga`= `manga`.`id`
//     INNER JOIN `category` ON `manga_category`.`id_category`= `category`.`id`
//     WHERE `category`.`slug` =:slugCat   OR `genre`.`slug` =:slugGenre OR
//     `public`.`slug` = : slugPublic ORDER BY :id );";
//   }
//   $sql.= "ORDER BY :id;";
//   $req= $db->prepare($sql);
//   $req->bindParam(":slugCat", $category, PDO::PARAM_STR);
//   $req->bindParam(":slugGenre", $genre, PDO::PARAM_STR);
//   $req->bindParam(":slugPublic", $public, PDO::PARAM_STR);
//   $req->bindParam(":id", $id, PDO::PARAM_STR);
//   $req->execute();


  
  
// echo json_encode($req->fetchAll(PDO::FETCH_ASSOC));