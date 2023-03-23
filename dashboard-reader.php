<?php
$style = './asset/css/style-dashboard.css';
include_once('./header.php');
include_once('./connexion.php');
?>

<div class="row-limit-size">
    <main>
        <div id="btnUp">
            <img src="./asset/img/icon/arrow-up-solid.svg" alt="up">
        </div>
        <section id="dashboard">
            <div class="row-limit-size">
                <article class="titleDiv">
                    <h1 class="title">Bienvenue <?= $_SESSION['pseudo'] ?></h1>
                </article>
                <fieldset>
                    <legend>Tes réservations</legend>
                    <?php
                    $id = $_GET['id'] = $_SESSION['id-user'];
                    $req = $db->prepare("SELECT `manga`.`title`, `manga`.`volume`,`manga`.`cover`,`loan`.`loan_date`,`loan`.`return_date`,`loan`.`reservation_loan` FROM `loan`
                                          INNER JOIN `manga` ON `manga`.`id`=`loan`.`id_manga`
                                          INNER JOIN `user` ON `user`.`id`= `loan`.`id_user`
                                          WHERE `loan`.`reservation_loan`>0  && `loan`.`id_user`= :id");
                    $req->bindParam('id', $id, PDO::PARAM_INT);
                    $req->execute();
                    while ($reservation = $req->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                        <div>
                            <figure>
                                <img src="./asset/img/premiere-page/<?= $reservation['cover'] ?>" alt="<?= $reservation['cover'] ?>">
                            </figure>

                            <article>
                                <h3><?= $reservation['title'] . " " . "Tome" . " " . $reservation['volume'] ?></h3>
                                <p>Fin de réservation: <span><?= " " . $reservation['reservation_loan'] ?></span></p>
                            </article>
                        </div>
                        <hr>
                    <?php } ?>
                </fieldset>
                <fieldset>
                    <legend>Tes emprunts en cours</legend>
                    <?php
                    $id = $_GET['id'] = $_SESSION['id-user'];
                    $req2 = $db->prepare("SELECT `manga`.`title`, `manga`.`volume`,`manga`.`cover`,`loan`.`loan_date`,`loan`.`return_date`,`loan`.`reservation_loan` FROM `loan`
         INNER JOIN `manga` ON `manga`.`id`=`loan`.`id_manga`
         INNER JOIN `user` ON `user`.`id`= `loan`.`id_user`
         WHERE `loan`.`return_date`> CURRENT_DATE && `loan`.`id_user`= :id");
                    $req2->bindParam('id', $id, PDO::PARAM_INT);
                    $req2->execute();
                    while ($return = $req2->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                        <div>
                            <figure>
                                <img src="./asset/img/premiere-page/<?= $return['cover'] ?>" alt="<?= $return['cover'] ?>">
                            </figure>

                            <article>
                                <h3><?= $return['title'] . " " . "Tome" . " " . $return['volume'] ?></h3>
                                <p>Date de retour: <span><?= " " . $return['return_date'] ?></span></p>
                            </article>
                        </div>
                        <hr>

                    <?php } ?>

                </fieldset>
                <fieldset>
                    <legend>Historique de tes emprunts</legend>
                    <?php

                    $req3 = $db->prepare("SELECT `manga`.`title`, `manga`.`volume`,`manga`.`cover`,`loan`.`loan_date`,`loan`.`return_date`,`loan`.`reservation_loan` FROM `loan`
         INNER JOIN `manga` ON `manga`.`id`=`loan`.`id_manga`
         INNER JOIN `user` ON `user`.`id`= `loan`.`id_user`
         WHERE  `loan`.`return_date`< CURRENT_DATE && `loan`.`id_user`= :id");
                    $req3->bindParam('id', $id, PDO::PARAM_INT);
                    $req3->execute();
                    while ($historical = $req3->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                        <div>
                            <figure>
                                <img src="./asset/img/premiere-page/<?= $historical['cover'] ?>" alt="<?= $historical['cover'] ?>">
                            </figure>

                            <article>
                                <h3><?= $historical['title'] . " " . "Tome" . " " . $historical['volume'] ?></h3>
                                <p>Date d'emprunt: <span><?= " " . $historical['loan_date'] ?></span></p>
                            </article>
                        </div>
                        <hr>
                    <?php } ?>
                </fieldset>
            </div>
</div>
</section>
</main>
<script src="./asset/js/scrollUp.js"></script>
<?php include_once('./footer.php'); ?>
</body>