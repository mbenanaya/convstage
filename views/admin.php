<?php
if (!isset($_SESSION['username'])) {
    header('Location: /convstage/');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include __DIR__ . '/includes/head.php' ?>
    <title>Admin</title>
</head>

<body>

    <?php include __DIR__ . '/includes/admin_nav.php' ?>
    <main class="home_main">
        <div class="row table-responsive py-5 px-3" id="main__content">

        </div>
    </main>

    <?php require __DIR__ . '/includes/footer.php' ?>

    <?php require __DIR__ . '/includes/js_scripts.php' ?>

    <script src="./views/assets/js/admin.js"></script>
</body>

</html>