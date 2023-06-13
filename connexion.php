<?php
try {
    $db = new PDO ('mysql:host=srv936.hstgr.io;dbname=u715151447_kitsutheque;charset=utf8','u715151447_bobas', 'Equinox01!');
}
catch(PDOException $e){
    echo "Erreur :" . $e->getMessage();
}