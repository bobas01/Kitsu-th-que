<?php
require_once '../connexion.php';
require_once './header-admin.php'

?>

<section>
<form action="resize.php" enctype="multipart/form-data" method="POST">
        <input type="image" name="image" id="image">
        <input type="submit" value="Envoyer">
    </form>
</section>
</main>
</body>

</html>