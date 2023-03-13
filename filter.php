<?php
include_once './connexion.php';
$datas = json_decode(file_get_contents('php://input'), true);

$sql="SELECT `manga`.`id`,`manga`.`volume`,`manga`.`title`,`manga`.`cover` FROM `manga` 
INNER JOIN `genre` ON `manga`.`id_genre`=`genre`.`id`
INNER JOIN `public` ON `manga`.`id_public`=`public`.`id`
INNER JOIN `manga_category` ON `manga_category`.`id_manga`= `manga`.`id`
INNER JOIN `category` ON `manga_category`.`id_category`= `category`.`id`
WHERE" ;              
// -- WHERE   `category`.`slug` =:slugCat   OR `genre`.`slug` =:slugGenre OR
// -- `public`.`slug` = : slugPublic ORDER BY :id );
// $select_research->bindValue(':search_term', $search_term, PDO::PARAM_STR);
// $select_research->bindParam(':id', $id, PDO::PARAM_INT);
// $select_research->execute();
$id=$_POST["id"];
if (isset($_POST['category'])){ 
    $category = $_POST['category'];
    $sql .= " `category`.`slug` =:slugCat ";
  }
  
if (isset($_POST['genre'])){ 
    $genre = $_POST['genre'];
    $sql .= " `genre`.`slug` =:slugGenre";
  }
  
if (isset($_POST['public'])){ 
    $public = $_POST['public'];
    $sql .= " `public`.`slug` = : slugPublic";
  }

  if(isset($_POST['category']) || isset($_POST['genre']) || isset($_POST['public'])) {
    $category = $_POST['category'];
    $genre = $_POST['genre'];
    $public = $_POST['public'];
    $sql = "SELECT `manga`.`id`,`manga`.`volume`,`manga`.`title`,`manga`.`cover` FROM `manga` 
    INNER JOIN `genre` ON `manga`.`id_genre`=`genre`.`id`
    INNER JOIN `public` ON `manga`.`id_public`=`public`.`id`
    INNER JOIN `manga_category` ON `manga_category`.`id_manga`= `manga`.`id`
    INNER JOIN `category` ON `manga_category`.`id_category`= `category`.`id`
    WHERE `category`.`slug` =:slugCat   OR `genre`.`slug` =:slugGenre OR
    `public`.`slug` = : slugPublic ORDER BY :id );";
  }
  $sql.= "ORDER BY :id;";
  $req= $db->prepare($sql);
  $req->bindParam(":slugCat", $category, PDO::PARAM_STR);
  $req->bindParam(":slugGenre", $genre, PDO::PARAM_STR);
  $req->bindParam(":slugPublic", $public, PDO::PARAM_STR);
  $req->bindParam(":id", $id, PDO::PARAM_STR);
  $req->execute();


  
  
echo json_encode($req->fetchAll(PDO::FETCH_ASSOC));
