<?php include_once './header.php'; ?>

<section>
    <fieldset>
        <legend>Sign In</legend>
        <div class="sign-in">
            <?php if (isset($_GET['err'])) { ?>
                <p style="color:red;">Identifiant et/ou mot de passe incorrecte</p>
            <?php } ?>
            <form action="./model/auth.php" method="POST"><br>
                <label for="pseudo">Pseudo</label><br>
                <input type="text" name="pseudo" id="pseudo"><br>
                <label for="password">Mot de passe</label><br>
                <input type="password" name="password" id="password"><br>
                <input type="submit" name="submit" value="Se connecter">
            </form>
        </div>
    </fieldset>
    <fieldset>
        <legend>Sign Up</legend>
        <div class="sign-up">
        <?php if (isset($_GET['erro'])) { ?>
                <p style="color:red;">Identifiant et/ou adresse mail déjà utilisé(s)</p>
            <?php } ?>
            <form action="./model/inscription.php" method="POST"><br>
                <label for="pseudo">Pseudo</label><br>
                <input type="text" name="pseudo" id="pseudo"><br>
                <label for="password">Mot de passe</label><br>
                <input type="password" name="password" id="password"><br>
                <label for="mail">Adresse e-mail</label><br>
                <input type="mail" name="mail" id="mail"><br>
                <input type="submit" name="submit" value="Se connecter">
            </form>
        </div>
    </fieldset>


</section>
</main>
</body>

</html>