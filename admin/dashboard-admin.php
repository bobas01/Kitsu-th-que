<?php
session_start();
include_once './header-admin.php';

if (!isset($_SESSION['id-user']) && $_SESSION['role-user'] === 'admin' ) {
    header('Location: ./connect.php');
}

?>
<section>
<h1>acceuil admin</h1>
</section>
</main>
<script src="../asset/js/header-admin.js"></script>
</body>
</html>