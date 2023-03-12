<?php
if (!isset($_SESSION['prenom'])) {
    header('Location: /convstage/');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include __DIR__ . '/includes/head.php' ?>
    <title>Convention de stage</title>
</head>

<body>

    <?php include __DIR__ . '/includes/stud_nav.php' ?>
    <main class="home_main">
        <div class="d-flex justify-content-center py-3">
            <div class="alert alert-success alert-dismissible fade show row w-75 py-3" role="alert">
                <h2 class="fw-normal fs-4 col-12 mb-0 text-center">
                    <?php echo "Bonjour " . $_SESSION['prenom'] . " " . $_SESSION['nom']; ?>
                </h2>
                <span>
                    <i type="button" class="fa-solid fa-xmark close col position-absolute top-50 me-3"
                        data-dismiss="alert" aria-label="Close" style="font-size: 30px;"></i>
                </span>
            </div>
        </div>
        <div class="d-flex justify-content-center pt-5 pb-5">
            <button type="button" class="btn  downloadButton" data-bs-toggle="modal" data-bs-target="#downloadModal"><i
                    class="fa fa-download"></i> Télécharger Convention</button>

            <!-- Modal -->
            <div class="modal fade" id="downloadModal" tabindex="-1" aria-labelledby="title" aria-hidden="true">
                <div class="modal-dialog col-9 col-sm-10 col-md-11 col-lg-8 col-xl-7 modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="title">Télécharger Convention</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="conv_form" style="font-size: .96rem">
                                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-4 p-3">
                                    <!-- Données d'étudiant -->
                                    <div class="form-group col">
                                        <label for="nom">Nom</label>
                                        <input class="form-control" type="text" name="nom" id="nom"
                                            value="<?= $_SESSION['nom'] ?>">
                                    </div>
                                    <div class="form-group col mt-2 mt-sm-0">
                                        <label for="prenom">Prénom</label>
                                        <input class="form-control" type="text" name="prenom" id="prenom"
                                            value="<?= $_SESSION['prenom'] ?>">
                                    </div>

                                    <div class="form-group col mt-2 mt-sm-3 mt-md-0">
                                        <label for="cne">CNE</label>
                                        <input class="form-control" type="text" name="cne" id="cne"
                                            value="<?= $_SESSION['cne'] ?>">
                                    </div>

                                    <div class="form-group col mt-2 mt-sm-3 mt-md-3 mt-lg-0">
                                        <label for="filiere">Filière</label>
                                        <input class="form-control" type="text" name="filiere" id="filiere"
                                            value="<?= $_SESSION['filiere'] ?>">
                                    </div>

                                    <div class="form-group col mt-2 mt-sm-3 mt-md-3 mt-lg-3">
                                        <label for="datedebut">Date debut</label>
                                        <input class="form-control date ps-md-2" type="date" name="datedebut" id="datedebut">
                                    </div>

                                    <div class="form-group col mt-2 mt-sm-3 mt-md-3 mt-lg-3">
                                        <label for="datefin">Date fin</label>
                                        <input class="form-control date ps-md-2" type="date" name="datefin" id="datefin">
                                    </div>
                                </div>
                                <hr />
                                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-4 row-cols-xl-4 p-3">
                                    <!-- Données d'entreprise -->
                                    <div class="entrNom form-group col position-relative">
                                        <label for="nomEntr">Nom d'entreprise</label>
                                        <input class="form-control" type="text" name="nomEntr" id="nomEntr">
                                        <i class="fa-solid fa-caret-down" id="showEntrName" name="showEntrName"></i>
                                        <ul class="col list-unstyled border rounded-3 z-3 mt-2" id="list_entr">
                                        </ul>
                                    </div>

                                    <div class="form-group col mt-2 mt-sm-0">
                                        <label for="adrEntr">Adresse d'entreprise</label>
                                        <input class="form-control" type="text" name="adrEntr" id="adrEntr">
                                    </div>

                                    <div class="form-group col mt-2 mt-sm-3 mt-md-3 mt-lg-0">
                                        <label for="telEntr">Téléphone d'entreprise</label>
                                        <input class="form-control" type="text" name="telEntr" id="telEntr">
                                    </div>

                                    <div class="form-group col mt-2 mt-sm-3 mt-md-3 mt-lg-0">
                                        <label for="nomEncd">Nom d'encadrant</label>
                                        <input class="form-control" type="text" name="nomEncd" id="nomEncd">
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Annuler</button>
                                    <button type="submit" class="btn btn-success">Télécharger</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <?php require __DIR__ . '/includes/footer.php' ?>

    <?php require __DIR__ . '/includes/js_scripts.php' ?>

    <script src="./views/assets/js/home.js"></script>
</body>

</html>