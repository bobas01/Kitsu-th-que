<?php
session_start();
include_once('../connexion.php');
include('./header-admin.php');
?>
<section id="loan">
    <div class="row-limit-size">


        <?php
        if (isset($_POST['loan_submit'])) {
            $idManga = $_POST['id_manga'];
            $idUser = $_POST['id_user'];


            $loan = $db->query("INSERT INTO `loan` (`id_manga`, `id_user`, `loan_date`, `return_date`, `available`, `reservation_loan`) 
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
         <h1>Liste des emprunts</h1>
        <div id="listLoan">
           
            <?php
            $listLoan = $db->query("SELECT `manga`.`title`, `manga`.`volume`, `loan`.`return_date`, `user`.`pseudo` FROM `loan` 
                       INNER JOIN `manga`ON `manga`.`id`=`loan`.`id` 
                       INNER JOIN `user` ON `user`.`id`=`loan`.`id_user`
                       ORDER BY `loan`.`return_date`  ;");
            while ($listLoanFetch = $listLoan->fetch(PDO::FETCH_ASSOC)) {;

            ?>

                <ul>
                    <li><?= $listLoanFetch["title"] ?></li>
                    <li>Tome: <?=" ". $listLoanFetch["volume"] ?></li>
                    <li>Date de retour: <span><?=" ". $listLoanFetch["return_date"] ?></span></li>
                    <li>Identifiant client:<span><?=" ". $listLoanFetch["pseudo"] ?></span></li>

                </ul>
            <?php } ?>
        </div>
    </div>
</section>
</main>
</body>