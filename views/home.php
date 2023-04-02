<?php
if (!isset($_SESSION['prenom'])) {
    header('Location: /convstage/');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include __DIR__ . '/includes/head.php' ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/spin.js/2.3.2/spin.min.js"></script>
    <script src="./views/assets/js/spin.umd.js"></script>
    <script src="./views/assets/js/spinner.js"></script>
    <title>Convention de stage</title>
</head>

<body>

    <?php include __DIR__ . '/includes/stud_nav.php' ?>
    <section class="home_section">
        <div class="d-flex justify-content-center py-3">
            <div class="alert alert-success alert-dismissible fade show row py-3 mx-1" role="alert">
                <h2 class="fw-normal fs-4 col-12 mb-0 text-center p-0">
                    <?php echo "Bonjour " . $_SESSION['prenom'] . " " . $_SESSION['nom']; ?>
                </h2>
                <span>
                    <i type="button" class="fa-solid fa-xmark close col position-absolute top-50 me-1"
                        data-dismiss="alert" aria-label="Close" style="font-size: 30px;"></i>
                </span>
            </div>
        </div>
        <div class="d-flex justify-content-center pt-5 pb-5">
            <button type="button" class="btn downloadButton" data-bs-toggle="modal" data-bs-target="#downloadModal"><i
                    class="fa fa-download"></i> Télécharger Convention</button>

            <div class="modal fade" id="downloadModal" tabindex="-1" aria-labelledby="title" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="title">Télécharger Convention</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="conv_form" style="font-size: .96rem">
                                <div
                                    class="infos row row-cols-1 row-cols-sm-2 row-cols-md-4 row-cols-lg-3 row-cols-xl-3 py-3 mx-1 rounded-3">
                                    <!-- Données d'étudiant -->
                                    <div class="form-group col col-md-4 col-lg-4 col-xl-4">
                                        <label class="mb-2" for="nom">Nom</label>
                                        <input class="form-control" type="text" name="nom" id="nom"
                                            value="<?= $_SESSION['nom'] ?>">
                                    </div>
                                    <div class="form-group col col-md-4 col-lg-4 col-xl-4 mt-2 mt-sm-0">
                                        <label class="mb-2" for="prenom">Prénom</label>
                                        <input class="form-control" type="text" name="prenom" id="prenom"
                                            value="<?= $_SESSION['prenom'] ?>">
                                    </div>

                                    <div class="form-group col col-md-4 col-lg-4 col-xl-4 mt-2 mt-sm-3 mt-md-0">
                                        <label class="mb-2" for="cne">CNE</label>
                                        <input class="form-control" type="text" name="cne" id="cne"
                                            value="<?= $_SESSION['cne'] ?>">
                                    </div>

                                    <div class="form-group col col-md-4 col-lg-4 col-xl-4 mt-2 mt-sm-3 mt-md-3">
                                        <label class="mb-2" for="diplome">Filière</label>
                                        <input class="form-control" type="text" name="diplome" id="diplome"
                                            value="<?= $_SESSION['diplome'] ?>">
                                    </div>

                                    <div class="form-group col col-md-4 col-lg-4 col-xl-4 mt-2 mt-sm-3 mt-md-3 mt-lg-3">
                                        <label class="mb-2" for="datedebut">Date debut</label>
                                        <input class="form-control date ps-md-2 date-input" type="date" name="datedebut"
                                            id="datedebut">
                                    </div>

                                    <div class="form-group col col-md-4 col-lg-4 col-xl-4 mt-2 mt-sm-3 mt-md-3 mt-lg-3">
                                        <label class="mb-2" for="datefin">Date fin</label>
                                        <input class="form-control date ps-md-2 date-input" type="date" name="datefin"
                                            id="datefin">
                                    </div>

                                    <div class="form-group col col-md-4 col-lg-4 col-xl-4 mt-2 mt-sm-3 mt-md-3 mt-lg-3">
                                        <label class="mb-2" for="intitule">Projet du stage</label>
                                        <input class="form-control ps-md-2" type="text" id="intitule" name="intitule"
                                            placeholder="Intitulé du projet du stage">
                                    </div>

                                    <div class="form-group col col-md-8 col-lg-8 col-xl-8 mt-2 mt-sm-3 mt-md-3 mt-lg-3">
                                        <label class="mb-2" for="description">Description du projet</label>
                                        <textarea id="description" name="description" class="form-control ps-md-2"
                                            cols="10" rows="4"></textarea>
                                    </div>

                                </div>
                                <div class="border-bottom border-2 border-secondary my-3 mx-1"></div>
                                <label>
                                    <small class="form-text fw-bold mx-1">Selectionner une entreprise parmi les noms
                                        d'entreprises existent 👇, s'il n'existe plus saisir le </small><span
                                        class="writing fw-bold">&#x270D;</span>
                                </label>
                                <div
                                    class="infos row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-3 row-cols-xl-3 py-3 mx-1 rounded-3">
                                    <!-- Données d'entreprise -->
                                    <div class="entrNom form-group col position-relative">
                                        <label class="mb-2" for="nomEntr">Nom d'entreprise</label>
                                        <input class="form-control" type="text" name="nomEntr" id="nomEntr">
                                        <i class="fa-solid fa-caret-down" id="showEntrName" name="showEntrName"></i>
                                        <ul class="col list-unstyled position-absolute border rounded-3 z-3 mt-2"
                                            id="list_entr"></ul>
                                    </div>

                                    <div class="form-group col mt-2 mt-sm-0">
                                        <label class="mb-2" for="adrEntr">Adresse d'entreprise</label>
                                        <input class="form-control" type="text" name="adrEntr" id="adrEntr">
                                    </div>

                                    <div class="form-group col mt-2 mt-sm-3 mt-md-3 mt-lg-0">
                                        <label class="mb-2" for="telEntr">Téléphone d'entreprise</label>
                                        <input class="form-control" type="text" name="telEntr" id="telEntr">
                                    </div>

                                    <div class="form-group col mt-2 mt-sm-3 mt-md-3">
                                        <label class="mb-2" for="nomEncd">Nom d'encadrant</label>
                                        <input class="form-control" type="text" name="nomEncd" id="nomEncd">
                                    </div>
                                    <div class="form-group col mt-2 mt-sm-3 mt-md-3">
                                        <label class="mb-2" for="qltEncd">Qualité d'encadrant</label>
                                        <input class="form-control" type="text" name="qltEncd" id="qltEncd">
                                    </div>

                                    <div class="form-group col mt-2 mt-sm-3 mt-md-3">
                                        <label class="mb-2" for="emailEncd">Email d'encadrant</label>
                                        <input class="form-control" type="text" name="emailEncd" id="emailEncd">
                                    </div>
                                </div>
                                <div class="border-bottom border-2 border-secondary my-3 mx-1"></div>
                                <div
                                    class="infos row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-3 row-cols-xl-3 py-3 mx-1 rounded-3">
                                    <div class="form-group col mt-2 mt-sm-3 mt-md-3 mt-lg-0">
                                        <label class="mb-2" for="nomResp">Responsable du stage</label>
                                        <input class="form-control" type="text" name="nomResp" id="nomResp"
                                            placeholder="Nom du responsable">
                                    </div>

                                    <div class="form-group col mt-2 mt-sm-3 mt-md-3 mt-lg-0">
                                        <label class="mb-2" for="qltResp">Qualité du responsable</label>
                                        <input class="form-control" type="text" name="qltResp" id="qltResp">
                                    </div>

                                    <div class="form-group col mt-2 mt-sm-3 mt-md-3 mt-lg-0">
                                        <label class="mb-2" for="telResp">Téléphone du responsable</label>
                                        <input class="form-control" type="text" name="telResp" id="telResp">
                                    </div>

                                    <div class="form-group col mt-2 mt-sm-3 mt-md-3 mt-lg-3">
                                        <label class="mb-2" for="emailResp">Email du responsable</label>
                                        <input class="form-control" type="text" name="emailResp" id="emailResp">
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Annuler</button>
                                    <button type="submit" id="crCnvButt" name="crCnvButt"
                                        class="btn btn-success submit_button">Télécharger</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <?php require __DIR__ . '/includes/footer.php' ?>

    <?php require __DIR__ . '/includes/js_scripts.php' ?>

    <script src="./views/assets/js/home.js"></script>
</body>

</html>