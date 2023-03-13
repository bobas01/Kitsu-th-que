<?php
require_once '../connexion.php';
require_once './header-admin.php'

?>

<section class="new-post">
    <form action="resize.php" enctype="multipart/form-data" method="POST">
        <fieldset class="manga-info">
            <legend>Ajouter une image de couverture</legend>
        
        <input type="file" name="image" id="image" accept="image/*">        
        </fieldset>
        <input type="reset" name="reset" value="Annuler">
        <input type="submit" value="Envoyer">
    </form>
</section>
</main>
</body>

</html>