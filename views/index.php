<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require_once 'views/includes/head.php' ?>
        <link rel="stylesheet" href="views/assets/css/style.css" />

        <title>Convention de stage</title>
    </head>
    <body>
        
    <?php require_once 'views/includes/navbar.php' ?>

        <main>
            <div class="container py-5">
                <div class="container-fluid col-11 col-sm-7 col-md-6 col-lg-4 col-xl-4 col-xxl-3 bg-white p-4 rounded-4">
                    <h2 class="auth text-center text-white border rounded-3 py-3 mb-5">Authentification</h2>
                    <form id="login_form" action="">
                        <div class="form-group mb-4">
                            <label for="email" class="form"
                                >Adresse email :</label
                            >
                            <input
                                type="text"
                                name="email"
                                id="email"
                                class="form-control my-2"
                                placeholder="Entrer votre email"
                            />
                        </div>

                        <div class="form-group position-relative">
                            <label for="password" class="form">Mot de passe :</label>
                            <input
                                type="password"
                                name="password"
                                id="password"
                                class="form-control my-2 pe-1"
                                placeholder="Entrer votre mot de passe"
                            />
                            <i class="fa-solid fa-eye"  id="show-password"></i>
                        </div>

                        <p class="forgot text-center mt-4">
                            <a href="#"
                                >Mot de passe oublié ?</a
                            >
                        </p>
                        <div
                            class="form-group d-flex justify-content-center my-3"
                        >
                            <button
                                type="submit"
                                id="connecter"
                                name="connecter"
                                class="btn btn-success"
                            >
                                Se connecter
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>

        <?php require_once 'views/includes/footer.php' ?>

        <?php require_once 'views/includes/js_scripts.php' ?>

        <script src="views/assets/js/login.js"></script>
    </body>
</html>