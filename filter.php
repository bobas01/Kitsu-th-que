<?php
include_once './connexion.php';
$datas = json_decode(file_get_contents('php://input'), true);

$req= $db->prepare("SELECT * FROM manga WHERE genre IN ('" . implode("','", $datas['genre']) . "')
 AND public IN ('" . implode("','", $datas['public']) . "') AND category IN ('" . implode("','", $datas['category']) . "')"
);
$req->execute();


echo json_encode($req->fetchAll(PDO::FETCH_ASSOC));

var_dump($req);




