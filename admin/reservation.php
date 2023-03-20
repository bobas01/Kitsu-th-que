<?php
session_start();
include_once('../connexion.php');
include('./header-admin.php');

$reserv = $db->query("SELECT `id`,`id_manga`,`loan_date`,`id_user`,`reservation_loan` FROM `loan` ORDER BY `id` DESC LIMIT 30;");

while ($confirmReserv = $reserv->fetch(PDO::FETCH_ASSOC)) {
    $dateReserv = strtotime($confirmReserv['reservation_loan']);   
    $dateActual = strtotime("now");    

if ($dateReserv<$dateActual && $dateReserv>0) {
    
        $validation = $db->query("UPDATE `loan` SET `return_date`= DATE_ADD(NOW(), INTERVAL 4 WEEK) ORDER BY `id` DESC LIMIT 30;"); 
?>

    <div class="listReserv">
        <fieldset>
            <legend>Liste des reservations</legend>
        <ul>
            <li><?= $confirmReserv['id'] ?></li>
            <li><?= $confirmReserv['id_manga'] ?></li>
            <li><?= $confirmReserv['id_user'] ?></li>
            <li><?= $confirmReserv['loan_date'] ?></li>
        </ul>
    </fieldset>
    </div>
  

    <input type="submit" name="submit" value="Valider">

<?php

}  }  ?>
</main>
</body>