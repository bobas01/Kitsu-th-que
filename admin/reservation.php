<?php
session_start();
if (!isset($_SESSION['id-user']) || $_SESSION['role-user'] !== 'admin') {
    header('Location: ../index.php');
    exit();
}
include_once('../connexion.php');
include('./header-admin.php');
?>

<main>
    <section id="listReserv">
        <div class="row-limit-size">
            <h1>Liste des reservations</h1>
            <?php  if (isset($_POST['submit'])) {
                            $id = $_POST['id'];
                            $validation = $db->prepare("UPDATE `loan` SET `return_date`= DATE_ADD(NOW(), INTERVAL 4 WEEK), `reservation_loan`=NULL WHERE `id`=:id;");
                            $validation->bindParam(':id', $id);
                            $validation->execute();}
            $reserv = $db->query('SELECT `id`,`id_manga`,`loan_date`,`id_user`,`return_date`,`reservation_loan` FROM `loan` ORDER BY `id` DESC LIMIT 30;');

            
           
            while ($confirmReserv = $reserv->fetch(PDO::FETCH_ASSOC)) {
                $dateReserv = strtotime($confirmReserv['reservation_loan']);
                $dateActual = strtotime('now');

                if ($dateReserv > $dateActual && $dateReserv > 0) {
            ?>
                    <div class="listReserv">

                        <ul>
                            <li>Numéro de reservation:<span> <?= " " . $confirmReserv['id'] ?></span></li>
                            <li>Identifiant du manga:<span><?= " " . $confirmReserv['id_manga'] ?></span></li>
                            <li>Identifiant du client:<span><?= " " . $confirmReserv['id_user'] ?></span></li>
                            <li>Date de reservation:<span><?= " " . $confirmReserv['loan_date'] ?></span></li>
                        </ul>

                        <?php
                       

                            $idManga = $confirmReserv['id_manga'];
                            $query = $db->query("SELECT * FROM `loan` WHERE `id_manga` = $idManga AND `available` = 0");
                            if ($query->rowCount() > 0) {
                                echo "<span>La réservation est validée!</span>";
                            }
                        else  {
                        ?>
                            <form method="POST">
                                <input type="hidden" name="id" value="<?= $confirmReserv['id'] ?>">
                                <input type="submit" name="submit" value="Valider">
                            </form>
                        <?php
                        }
                        ?>
                <?php
                } else if ($dateReserv < $dateActual && $dateReserv > 0) {
                    $id = $confirmReserv['id'];
                    $delete = $db->prepare("DELETE FROM `loan` WHERE `id`=:id;");
                    $delete->bindParam(':id', $id);
                    $delete->execute();
                }
            }
                ?>
                    </div>
        </div>
    </section>
</main>
<script src="../asset/js/header-admin.js"></script>
</body>