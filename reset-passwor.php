<!DOCTYPE html>
<html lang="en">

<head>
    <?php //include __DIR__ . '/views/includes/head.php' ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/spin.js/2.3.2/spin.min.js"></script>
    <script src="./views/assets/js/spin.umd.js"></script>
    <script src="./assets/js/spinner.js"></script>
    <title>Réinitialiser mot de passe</title>
</head>

<body>

    <?php include __DIR__ . '/views/includes/nav_mpo.php' ?>

    <section>
        <div class="container pt-3 pb-5">
            <div class="container-fluid col-11 col-sm-7 col-md-8 col-lg-6 col-xl-3 col-xxl-3 bg-white p-3 rounded-4">
                <form id="reset_pass">
                    <div class="form-group my-5">
                        <label for="email" class="form">Saisissez votre adresse e-mail pour réinitialiser votre mot de
                            passe</label>
                        <input type="text" name="email" id="email" class="form-control mt-5 mb-1"
                            placeholder="Entrer votre email" />
                    </div>

                    <div class="form-group d-flex justify-content-center mt-3 mb-2">
                        <button type="submit" id="reset" name="reset" class="btn btn-success">
                            Se connecter
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <?php //require_once __DIR__ . '/views/includes/footer.php' ?>
    <?php //require_once __DIR__ . '/views/includes/js_scripts.php' ?>

    <!-- <script src="./views/assets/js/chihaja.js"></script> -->

</body>

</html>