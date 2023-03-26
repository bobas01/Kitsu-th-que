<?php
session_start();
if (!isset($_SESSION['id-user']) || $_SESSION['role-user'] !== 'admin') {
    header('Location: ../index.php');
    exit();
}
include_once('../connexion.php');
include('./header-admin.php');
?>
<section id="loan">
    <div class="row-limit-size">


        <?php
        if (isset($_POST['loan_submit'])) {
            $idManga = $_POST['id_manga'];
            $idUser = $_POST['id_user'];


            $loan = $db->query("INSERT INTO `loan` ( `id_manga`, `id_user`, `loan_date`, `return_date`, `available`, `reservation_loan`) 
        VALUES ($idManga, $idUser, NOW(), DATE_ADD(NOW(), INTERVAL 4 WEEK), 1, NULL);");
        }
        ?>

        <form action="#" method="POST">
            <fieldset>
                <legend>Emprunt</legend>
                <div>
                    <label for="idManga">Index du manga</label>
                    <input type="number" name="id_manga" id="idManga" maxlength="30">
                </div>
                <div>
                    <label for="idUser">Identifiant client</label>
                    <input type="number" name="id_user" id="idUser" maxlength="30">
                </div>
            </fieldset>
            <input type="submit" name="loan_submit" value="Post">
            <input type="reset" name="reset" value="Reset">
        </form>
        <?php
        if (isset($_POST['submit'])) {
            $idManga = $_POST['id_manga'];
            $loanReturn = $db->query("UPDATE `loan` SET `return_date`= NOW(),`available`= 0 WHERE `id_manga`='$idManga';");
        }
        ?>
        <form action="#" method="POST">
            <fieldset>
                <legend>Retour</legend>
                <div>
                    <label for="idManga">Index du manga</label>
                    <input type="number" name="id_manga" id="idManga" maxlength="50">
                </div>
            </fieldset>
            <input type="submit" name="submit" value="Post">
            <input type="reset" name="reset" value="Reset">
        </form>
        <a href="./reservation.php">Liste des reservations</a>
        <h1>Liste des emprunts</h1>
        <div id="listLoan">

            <?php
            $listLoan = $db->query("SELECT `manga`.`title`, `manga`.`volume`,`loan`.`id_manga`, `loan`.`return_date`, `user`.`pseudo` FROM `loan` 
                       INNER JOIN `manga`ON `manga`.`id`=`loan`.`id_manga` 
                       INNER JOIN `user` ON `user`.`id`=`loan`.`id_user`
                       WHERE `loan`.`return_date`> CURRENT_DATE 
                       ORDER BY `loan`.`return_date` DESC LIMIT 30 ;");
            while ($listLoanFetch = $listLoan->fetch(PDO::FETCH_ASSOC)) {;

            ?>

                <ul>
                    <li><?= $listLoanFetch["title"] ?></li>
                    <li>Tome: <?= " " . $listLoanFetch["volume"] ?></li>
                    <li>Identifiant manga: <span><?= " " . $listLoanFetch["id_manga"] ?></span></li>
                    <li>Date de retour: <span><?= " " . $listLoanFetch["return_date"] ?></span></li>
                    <li>Identifiant client:<span><?= " " . $listLoanFetch["pseudo"] ?></span></li>

                </ul>
            <?php } ?>
        </div>
    </div>
</section>
</main>
</body>