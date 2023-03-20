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
        <div class="container pt-3 pb-5">
            <div class="container-fluid col-11 col-sm-7 col-md-8 col-lg-6 col-xl-3 col-xxl-3 bg-white p-3 rounded-4">
                <form id="login_form">
                    <div class="form-group my-5">
                        <label for="email" class="form">Saisissez votre adresse e-mail pour réinitialiser votre mot de passe</label>
                        <input type="text" name="email" id="email" class="form-control my-5"
                            placeholder="Entrer votre email" />
                    </div>

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