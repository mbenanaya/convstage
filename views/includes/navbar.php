<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="convstage.fstg.uca.ma">
            <img src="<?php __DIR__ . '/assets/images/logo-fstg.jpg'?>" class="rounded" alt="FSTG" width="180" height="80" />
        </a>

        <!-- Responsive toggler -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item d-sm-block d-md-none">
                    <div class="navbar-nav">
                        <a class="small fst_link nav-link text-uppercase text-white mt-2 mt-sm-0 px-1 w-50 w-sm-25"
                            href="http://www.fstg-marrakech.ac.ma/">fstg marrakech</a>
                    </div>
                </li>
                <?php
                if (isset($_SESSION['prenom'])) {
                    $currentPage = basename($_SERVER['PHP_SELF']);
                    if ($currentPage == 'home.php') {
                        echo '
                            <li class="nav-item ms-md-auto d-none d-md-block">
                                <div class="navbar-nav">
                                    <a class="nav-link text-white"
                                    href="#">Télécharger Convention</a>
                                </div>
                            </li>
                            ';
                    }
                }
                ?>
                <li class="nav-item ms-md-auto d-none d-md-block">
                    <div class="navbar-nav">
                        <a class="fst_link nav-link text-uppercase text-white"
                            href="http://www.fstg-marrakech.ac.ma/">fstg marrakech</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>