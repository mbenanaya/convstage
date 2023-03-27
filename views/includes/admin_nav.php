<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="convstage.fstg.uca.ma">
            <img src="./views/assets/images/logo-fstg.jpg" alt="FSTG" width="200" height="87" />
        </a>

        <div class="d-flex flex-row flex-wrap justify-content-between align-items-center mt-3 mt-sm-0 mt-md-0">
            <div class="d-flex flex-row align-items-center">
                <?php
                if (isset($_SESSION['username'])) {
                    $username = $_SESSION['username']; ?>
                    <li class="nav-item d-flex flex-column justify-content-center ms-md-auto d-sm-block d-md-none">
                        <div class="navbar-nav text-white">
                            <span class=" nav-link text-white px-1 px-sm-0">Bonjour
                                <?= $username ?>
                            </span>
                        </div>
                    </li>
                <?php } ?>
            </div>
            <div class="d-flex flex-row align-items-center ms-5">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </div>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                
                <li class="nav-item d-sm-block d-md-none w-25">
                    <div class="navbar-nav">
                        <p class="fst_link showAc nav-link text-white px-1" id="showAc">Conventions</p>
                    </div>
                </li>

                <li class="nav-item d-sm-block d-md-none w-25">
                    <div class="navbar-nav">
                        <p class="fst_link showAe nav-link text-white px-1" id="showAe">Entreprises</p>
                    </div>
                </li>

                <li class="nav-item d-sm-block d-md-none">
                    <div class="navbar-nav">
                        <a class="small fst_link nav-link text-white px-1 w-50 w-sm-25" href="logout">
                            Se Deconnecter
                        </a>
                    </div>
                </li>

                <?php
                if (isset($_SESSION['username'])) {
                    $username = $_SESSION['username']; ?>
                    <li class="nav-item d-flex flex-column justify-content-center ms-md-auto d-none d-md-block me-4">
                        <div class="navbar-nav text-white">
                            <span class=" nav-link text-white">
                                Bonjour <?= $username ?>
                            </span>
                        </div>
                    </li>
                <?php } ?>

                <li class="nav-item ms-md-auto d-none d-md-block">
                    <div class="navbar-nav">
                        <p class="fst_link showAc nav-link text-white" id="showAc">Conventions</p>
                    </div>
                </li>

                <li class="nav-item ms-md-auto d-none d-md-block">
                    <div class="navbar-nav">
                        <p class="fst_link showAe nav-link text-white" id="showAe">Entreprises</p>
                    </div>
                </li>

                <li class="nav-item ms-md-auto d-none d-md-block">
                    <div class="navbar-nav">
                        <a class="fst_link nav-link text-white" href="logout">
                            Se Deconnecter
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- <i class="fa-solid fa-arrow-right-from-bracket"></i> -->