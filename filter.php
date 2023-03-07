<?php
include_once './connexion.php';

$req= $db->query("SELECT  `id_genre` FROM `manga` ;");

echo json_encode($req->fetch(PDO::FETCH_ASSOC));