<?php

if (isset($_GET['username'])) {
    $username = urldecode($_GET['username']);
}
$_SESSION['username'] = urldecode($_GET['username']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="../views/assets/images/logo-fstg.jpg" type="image/x-icon">

    <!-- BOOTSTRAP CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css"
        integrity="sha512-SbiR/eusphKoMVVXysTKG/7VseWii+Y3FdHrt0EpKgpToZeemhqHeZeLWLhJutz/2ut2Vw1uQEj2MbRF+TVBUA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.1/sweetalert2.min.css"
        integrity="sha512-NvuRGlPf6cHpxQqBGnPe7fPoACpyrjhlSNeXVUY7BZAj1nNhuNpRBq3osC4yr2vswUEuHq2HtCsY2vfLNCndYA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../views/assets/css/style.css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/spin.js/2.3.2/spin.min.js"></script>
    <script src="../views/assets/js/spin.umd.js"></script>
    <script src="../views/assets/js/spinner.js"></script>
    <script>
        window.username = "<?php echo $_GET['username'] ?? ''; ?>";
    </script>
    <title>Réinitialiser mot de passe</title>
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/convstage">
                <img src="../views/assets/images/logo-fstg.jpg" id="fst_logo" alt="FSTG" width="200" height="87" />
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="nav_ul navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item d-sm-block d-md-none">
                        <div class="navbar-nav">
                            <a class="small fst_link nav-link text-capitalize text-white mt-2 mt-sm-0 px-1"
                                href="/convstage/" style="width: 50px">login</a>
                        </div>
                    </li>
                    <li class="nav-item ms-md-auto d-none d-md-block">
                        <div class="navbar-nav">
                            <a class="fst_link nav-link text-capitalize text-white" href="/convstage/">login</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="reset">
        <div class="d-flex justify-content-center pt-1">
            <div class="alert alert-success alert-dismissible fade show row py-3 mx-1 mt-2 mb-1" role="alert">
                <h2 class="fw-normal fs-4 col-12 mb-0 text-center p-0">
                    <?php echo "Bonjour " . $username; ?>
                </h2>
                <span>
                    <i type="button" class="fa-solid fa-xmark close col position-absolute top-50 me-1"
                        data-dismiss="alert" aria-label="Close" style="font-size: 30px;"></i>
                </span>
            </div>
        </div>
        <div class="container pt-2 pb-5">
            <div
                class="container-fluid col-11 col-sm-9 col-md-8 col-lg-5 col-xl-5 col-xxl-4 bg-white p-3 rounded-4 reset_cont">
                <h3 class="auth reset_head text-center text-white border rounded-3 py-3 mb-3">Réinitialisation du mot de
                    passe</h3>
                <form id="reset_form">
                    <div class="form-group position-relative mb-3">
                        <label for="password" class="form-label">Mot de passe :</label>
                        <input type="password" name="password" id="password" class="form-control my-2 ps-2 pe-1"
                            placeholder="Tapez nouveau mot de passe" />
                        <i class="fa-solid fa-eye reset_eye" id="show_pass"></i>
                    </div>

                    <div class="form-group position-relative">
                        <label for="confirm_pass" class="form-label">Confirmation du mot de passe :</label>
                        <input type="password" name="confirm_pass" id="confirm_pass" class="form-control my-2 ps-2 pe-1"
                            placeholder="Confirmer mot de passe" />
                        <i class="fa-solid fa-eye reset_eye" id="show_cpass"></i>
                    </div>

                    <div class="form-group d-flex justify-content-center mt-3 mb-2">
                        <button type="submit" id="reset" name="reset" class="btn btn-success submit_button">
                            Réinitialiser
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <?php require_once '../views/includes/footer.php' ?>
    <?php require '../views/includes/js_scripts.php' ?>
    <script src="../views/assets/js/reset.js"></script>

</body>

</html>