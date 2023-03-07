<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="shortcut icon" href="views/assets/images/logo-fstg.jpg" type="image/x-icon">
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css"
            integrity="sha512-SbiR/eusphKoMVVXysTKG/7VseWii+Y3FdHrt0EpKgpToZeemhqHeZeLWLhJutz/2ut2Vw1uQEj2MbRF+TVBUA=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
        />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="views/assets/css/style.css" />

        <title>Convention de stage</title>
    </head>
    <body>
        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="convstage.fstg.uca.ma">
                    <img
                        src="views/assets/images/logo-fstg.jpg"
                        class="rounded"
                        alt="FSTG"
                        width="180"
                        height="80"
                    />
                </a>

                <!-- Responsive toggler -->
                <button
                    class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarNav"
                    aria-controls="navbarNav"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                >
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item d-sm-block d-md-none">
                            <div class="navbar-nav">
                                <a
                                    class="small fst_link nav-link text-uppercase text-white mt-2 mt-sm-0 px-1 w-50 w-sm-25"
                                    href="http://www.fstg-marrakech.ac.ma/"
                                    >fstg marrakech</a
                                >
                            </div>
                        </li>
                        <li class="nav-item ms-md-auto d-none d-md-block">
                            <div class="navbar-nav">
                                <a
                                    class="fst_link nav-link text-uppercase text-white"
                                    href="http://www.fstg-marrakech.ac.ma/"
                                    >fstg marrakech</a
                                >
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main>
            <div class="container py-5">
                <div class="container-fluid col-11 col-sm-7 col-md-6 col-lg-4 col-xl-4 col-xxl-3 bg-white p-4 rounded-4">
                    <h2 class="auth text-center text-white border rounded-3 py-3 mb-5">Authentification</h2>
                    <form action="">
                        <div class="form-group mb-4">
                            <label for="email" class="form"
                                >Adresse email :</label
                            >
                            <input
                                type="text"
                                name="email"
                                id="email"
                                class="form-control mt-2"
                                placeholder="Entrer votre email"
                            />
                        </div>

                        <div class="form-group position-relative">
                            <label for="password" class="form">Mot de passe :</label>
                            <input
                                type="password"
                                name="password"
                                id="password"
                                class="form-control mt-2 pe-1"
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

        <div class="container-fluid bg-dark text-light">
            <div class="row pt-5">
                <div class="col text-center">
                    <h6 class="mb-3">©2023 - Faculté des Sciences et Techniques Marrakech</h2>
                    <p><small>Réalisé par : <a href="#">Mouhcine BEN-ANAYA</a></small></p>
                </div>
            </div>
        </div>

        <script
            src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js"
            integrity="sha512-1/RvZTcCDEUjY/CypiMz+iqqtaoQfAITmNSJY17Myp4Ms5mdxPS5UV7iOfdZoxcGhzFbOm6sntTKJppjvuhg4g=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
        ></script>

        <!-- jQuery -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <script>
            $('#show-password').click(function() {
                var password = $('#password');
                if (password.attr('type') === 'password') {
                    password.attr('type', 'text');
                    $(this).removeClass('fa-eye').addClass('fa-eye-slash');
                } else {
                    password.attr('type', 'password');
                    $(this).removeClass('fa-eye-slash').addClass('fa-eye');
                }
            });
        </script>
    </body>
</html>