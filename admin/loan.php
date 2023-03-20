<?php
session_start();
include_once('../connexion.php');
include('./header-admin.php');

if (isset($_POST['submit'])) {
    $idManga = $_POST['id_manga'];
    $idUser = $_POST['id_user'];
    var_dump($idManga);

    $loan = $db->query("INSERT INTO `loan`( `id_manga`, `id_user`, `loan_date`, `return_date`, `available`,`reservation_loan`) 
    VALUES ($idManga, $idUser, NOW(), DATE_ADD(NOW(), INTERVAL 4 WEEK), 1,NULL);");
}
?>

<form action="#" method="POST">
    <fieldset>
        <legend>Emprunt</legend>
        <div>
            <label for="idManga">Index du manga</label>
            <input type="number" name="id_manga" id="idManga" maxlength="50">
        </div>
        <div>
            <label for="idUser">idUser</label> <br>
            <input type="number" name="id_user" id="idUser" maxlength="50">
        </div>
    </fieldset>
    <input type="submit" name="submit" value="Post">
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



</main>
</body>