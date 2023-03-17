<?php
session_start();
include_once('../connexion.php');
include('./header-admin.php');

if (isset($_POST['submit'])) {
    $idManga = $_POST['id_manga'];
    $idUser = $_POST['id_user'];


    $loan = $db->query("INSERT INTO `loan`( `id_manga`, `id_user`, `loan_date`, `return_date`, `availible`) 
    VALUES ('$idManga', '$idUser', NOW(), DATE_ADD(NOW(), INTERVAL 4 WEEK), 1);");
}
?>
<fieldset>
    <legend>Emprunt</legend>
    <div>
        <label for="idManga">Index du manga</label>
        <input type="number" name="idManga" id="idManga" maxlength="50">
    </div>
    <div>
        <label for="idUser">idUser</label> <br>
        <input type="number" name="idUser" id="idUser" maxlength="50">
    </div>
</fieldset>
<input type="submit" name="submit" value="Post">
<input type="reset" name="reset" value="Reset">