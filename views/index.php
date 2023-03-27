<?php
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include __DIR__ . '/includes/head.php' ?>
    <title>Convention de stage</title>
</head>

<body>

    <?php include __DIR__ . '/includes/navbar.php' ?>

    <main>
        <div class="container pt-2 pb-5">
            <div class="container-fluid col-11 col-sm-7 col-md-6 col-lg-4 col-xl-3 col-xxl-3 bg-white p-4 pb-2 rounded-4">
                <h3 class="auth text-center text-white border rounded-3 py-3 mb-3">Authentification</h3>
                <form id="login_form">
                    <div class="form-group mb-3">
                        <label for="email" class="form">Code Massar ou CNE :</label>
                        <input type="text" name="email" id="email" class="form-control px-2 my-2"
                            placeholder="Tapez votre Code Massar ou CNE" />
                    </div>

                    <div class="form-group position-relative">
                        <label for="password" class="form">Date de Naissance :</label>
                        <input type="password" name="password" id="password" class="form-control my-2 ps-2 pe-1"
                            placeholder="Exemple : 25/01/99" />
                        <i class="fa-solid fa-eye" id="show-password"></i>
                    </div>

                    <p class="forgot text-center mt-3">
                        <a href="mot-de-passe-oublie">Mot de passe oublié ?</a>
                    </p>
                    <div class="form-group d-flex justify-content-center mt-3 mb-2">
                        <button type="submit" id="connecter" name="connecter" class="btn btn-success">
                            Se connecter
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <?php require_once __DIR__ . '/includes/footer.php' ?>

    <?php require_once __DIR__ . '/includes/js_scripts.php' ?>

    <script src="views/assets/js/login.js"></script>
</body>

</html>