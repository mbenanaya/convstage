<?php
if (!isset($_SESSION['username'])) {
    header('Location: /convstage/');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include __DIR__ . '/includes/head.php' ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/spin.js/2.3.2/spin.min.js"></script>
    <script src="./views/assets/js/spin.umd.js"></script>
    <script src="./views/assets/js/spinner.js"></script>
    <title>Admin</title>
</head>

<body>

    <?php include __DIR__ . '/includes/admin_nav.php' ?>
    <section class="home_section">
        <div class="top d-flex justify-content-center py-3">
            <div class="alert alert-primary alert-dismissible fade show row py-3 mx-1" role="alert">
                <h2 class="fw-normal fs-4 col-12 mb-0 text-center p-0">
                    <?php echo "Bonjour " . $_SESSION['username']; ?>
                </h2>
                <span>
                    <i type="button" class="fa-solid fa-xmark close col position-absolute top-50 me-1"
                        data-dismiss="alert" aria-label="Close" style="font-size: 30px;"></i>
                </span>
            </div>
        </div>
        <div id="fils" class="container d-flex justify-content-center"></div>
        <div class="row table-responsive d-flex justify-content-center py-2 px-3" id="main__content"></div>
    </section>

    <?php require __DIR__ . '/includes/footer.php' ?>
    <?php require __DIR__ . '/includes/js_scripts.php' ?>
    <script src="./views/assets/js/admin.js"></script>
</body>

</html>