<!DOCTYPE html>
<html lang="en">

<head>
    <?php include __DIR__ . '/includes/head.php' ?>
    <title>Convention de stage</title>
</head>

<body>

    <?php include __DIR__ . '/includes/navbar.php' ?>

    <section>
        <div class="container pt-2 pb-5">
            <div
                class="container-fluid col-11 col-sm-7 col-md-6 col-lg-4 col-xl-4 col-xxl-4 bg-white p-4 pb-2 rounded-4">
                <h3 class="auth text-center text-white border rounded-3 py-3 mb-3">Authentification</h3>
                <form id="login_form">
                    <div class="form-group mb-3">
                        <label for="cne" class="form">Code Massar ou CNE :</label>
                        <input type="text" name="cne" id="cne" class="form-control px-2 my-2"
                            placeholder="Tapez votre Code Massar ou CNE" />
                    </div>

                    <div class="form-group position-relative">
                        <label for="datenaiss" class="form">Date de Naissance :</label>
                        <input type="password" name="datenaiss" id="datenaiss" class="form-control my-2 ps-2 pe-1"
                            placeholder="Exemple : 25/01/99" />
                        <i class="fa-solid fa-eye" id="show_datenaiss"></i>
                    </div>

                    <div class="form-group d-flex justify-content-center mt-3 mb-2">
                        <button type="submit" id="student_login" name="student_login"
                            class="btn btn-success submit_button">
                            Se connecter
                        </button>
                    </div>

                    <p class="forgot text-center mt-3">
                        <button type="button" class="btn btn-link admin_connect" data-bs-toggle="modal"
                            data-bs-target="#loginModal">Administrateur? Se connecter</button>
                    </p>
                </form>
            </div>
            <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="title" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="title">Se connecter</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="admin_login">
                                <div class="form-group mb-3">
                                    <label for="email" class="form">Adresse email :</label>
                                    <input type="text" name="email" id="email" class="form-control px-2 my-2"
                                        placeholder="Tapez votre adresse email" />
                                </div>

                                <div class="form-group position-relative">
                                    <label for="password" class="form">Mot de passe :</label>
                                    <input type="password" name="password" id="password"
                                        class="form-control my-2 ps-2 pe-1" placeholder="Tapez votre mot de passe" />
                                    <i class="fa-solid fa-eye" id="show_password"></i>
                                </div>

                                <p class="forgot text-center mt-3">
                                    <a href="mot-de-passe-oublie">Mot de passe oublié ?</a>
                                </p>
                                <div class="form-group d-flex justify-content-center mt-3 mb-2">
                                    <button type="submit" id="connecter" name="connecter"
                                        class="btn btn-success submit_button">
                                        Se connecter
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php require_once __DIR__ . '/includes/footer.php' ?>

    <?php require_once __DIR__ . '/includes/js_scripts.php' ?>

    <script src="views/assets/js/login.js"></script>
</body>

</html>