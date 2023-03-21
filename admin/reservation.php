<?php
session_start();
include_once('../connexion.php');
include('./header-admin.php');
?>

<main>
    <?php
    $reserv = $db->query('SELECT `id`,`id_manga`,`loan_date`,`id_user`,`return_date`,`reservation_loan` FROM `loan` ORDER BY `id` DESC LIMIT 30;');
   
    $delete = $db->prepare("DELETE FROM `loan` WHERE `id`=:id;");
    while ($confirmReserv = $reserv->fetch(PDO::FETCH_ASSOC)) {
        $dateReserv = strtotime($confirmReserv['reservation_loan']);
        $dateActual = strtotime('now');

        if ($dateReserv > $dateActual && $dateReserv > 0) {
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

            <?php
            if (isset($_POST['submit'])) {
                $id = $confirmReserv['id'];
                $validation = $db->prepare("UPDATE `loan` SET `return_date`= DATE_ADD(NOW(), INTERVAL 4 WEEK), `reservation_loan`=NULL WHERE `id`=:id;");
                $validation->bindParam(':id', $id);
                $validation->execute();

                $idManga = $confirmReserv['id'];
                $query = $db->query("SELECT * FROM `loan` WHERE `id_manga` = $idManga AND `available` = 0");
                if ($query->rowCount() > 0) {
                    echo "<span>La réservation est validée!</span>";
                }
            } else {
            ?>
                <form method="POST">
                    <input type="hidden" name="id" value="<?= $confirmReserv['id'] ?>">
                    <input type="submit" name="submit" value="Valider">
                </form>
            <?php
            }
            ?>
    <?php
        } else {
            $id = $confirmReserv['id'];
            $delete->bindParam(':id', $id);
            $delete->execute();
        }
    }
    ?>
</main>
</body>
