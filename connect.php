<?php include_once './header.php'; ?>

<section>
    <div>
      <?php if (isset($_GET['err'])) { ?>
        <p style="color:red;">Pseudo et/ou mot de passe incorrect</p>
    <?php } ?>
    <form action="./auth.php" method="POST"><br>
        <label for="pseudo">Pseudo</label><br><br>
        <input type="text" name="pseudo" id="pseudo"><br><br>
        <label for="password">Mot de passe</label><br><br>
        <input type="password" name="password" id="password"><br><br>
        <input type="submit" name="submit" value="Se connecter">
    </form>  
    </div>
</section>
</main>
</body>

</html>