<?php

session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once __DIR__ . '/includes/head.php' ?>
    <title>Convention de stage</title>
</head>

<body>

    <?php require_once __DIR__ . '/includes/navbar.php' ?>
    <?= $_SESSION['prenom'];?>

    <?php require_once __DIR__ . '/includes/footer.php' ?>

    <?php require_once __DIR__ . '/includes/js_scripts.php' ?>

    <script src="./assets/js/login.js"></script>
</body>

</html>