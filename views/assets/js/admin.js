function getAllEntrs() {
    $(document).on("click", ".showAe", function (e) {
        e.preventDefault();
        $(".showAe").addClass("active_link");
        $(".showAc").removeClass("active_link");
        $(".showSt").removeClass("active_link");
        $.ajax({
            url: "./controllers/Ajax.php",
            type: "POST",
            data: { action: "show" },
            dataType: "html",
            beforeSend: function () {
                showLoadingSpinner();
            },
            success: function (data) {
                $("#fils").html("");
                $("#fils").css("display", "none");
                $("#section__content").html(data);
            },
            error: function (xhr, textStatus, errorThrown) {
                console.error(textStatus, errorThrown);
                Swal.fire({
                    icon: "error",
                    title: "Erreur",
                    text: textStatus,
                });
            },
            complete: function () {
                hideLoadingSpinner();
            },
        });
    });
}

function showDiplomesNames() {
    $(document).on("click", ".showAc", function (e) {
        e.preventDefault();
        $(".showAc").addClass("active_link");
        $(".showAe").removeClass("active_link");
        $(".showSt").removeClass("active_link");
        $.ajax({
            url: "./controllers/ConvController.php",
            type: "POST",
            data: { action: "showConvs" },
            dataType: "json",
            beforeSend: function () {
                showLoadingSpinner();
            },
            success: function (data) {
                if ("error" in data) {
                    $("#section__content").html("");
                    $("#fils").html(
                        '<div class="alert alert-danger px-5 py-3 mx-1 mt-5" role="alert"><h2 class="fw-normal fs-3 col-12 text-center m-0 p-0">' +
                            data.error +
                            "</h2></div>"
                    );
                } else {
                    var licence = data.Licence;
                    var master = data.Master;
                    var ingenieur = data.Ingenieur;

                    var Select =
                        '<select class="form-select w-25 mt-3 mb-4" id="filterbyf" name="filterbyf">';
                    Select += '<option value="Tous" selected>Tous</option>';
                    Select += '<optgroup label="Licence">';
                    for (var diplome in licence) {
                        Select +=
                            '<option value="' +
                            licence[diplome] +
                            '">' +
                            licence[diplome] +
                            "</option>";
                    }

                    Select += "</optgroup>";
                    Select += '<optgroup label="Master">';
                    for (var diplome in master) {
                        Select +=
                            '<option value="' +
                            master[diplome] +
                            '">' +
                            master[diplome] +
                            "</option>";
                    }

                    Select += "</optgroup>";
                    Select += '<optgroup label="Ingenieur">';
                    for (var diplome in ingenieur) {
                        Select +=
                            '<option value="' +
                            ingenieur[diplome] +
                            '">' +
                            ingenieur[diplome] +
                            "</option>";
                    }

                    Select += "</optgroup>";
                    Select += "</select>";
                    $("#section__content").html("");
                    $("#fils").html(Select);
                }
            },
            error: function (xhr, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
                Swal.fire({
                    icon: "error",
                    title: "Erreur",
                    text: "Une erreur est survenue",
                });
            },
            complete: function () {
                hideLoadingSpinner();
            },
        });
    });
}

function showAllConvs() {
    $(document).on("change", "#filterbyf", function () {
        var fil = $("#filterbyf").val();
        $.ajax({
            url: "./controllers/ConvController.php",
            type: "POST",
            data: { action: "showFiltered", diplome: fil },
            dataType: "json",
            success: function (data) {
                ConvsTable = "";
                ConvsTable +=
                    '<table class="table table-responsive table-striped table-hover bg-light table-striped-rows"> <thead> <tr> <th scope="col">CNE</th> <th scope="col">Nom</th> <th scope="col">Prénom</th> <th scope="col">Diplome</th> <th scope="col">Nom d\'entreprise</th> <th scope="col">Adresse</th> <th scope="col">Telephone</th> <th scope="col">Nom d\'encadrant</th> <th scope="col">Date Début</th> <th scope="col">Date Fin</th> </tr> </thead> <tbody> ';

                $.each(data, function () {
                    ConvsTable +=
                        "<tr> <td>" +
                        this.cne +
                        "</td> <td>" +
                        this.nom +
                        "</td> <td>" +
                        this.prenom +
                        "</td> <td>" +
                        this.diplome +
                        "</td> <td>" +
                        this.nomEntr +
                        "</td> <td>" +
                        this.adrEntr +
                        "</td> <td>" +
                        this.telEntr +
                        "</td> <td>" +
                        this.nomEncd +
                        "</td> <td>" +
                        this.datedebut +
                        "</td> <td>" +
                        this.datefin +
                        "</td> </tr>";
                });
                ConvsTable += "</tbody></table>";
                $("#section__content").html(ConvsTable);
            },
            error: function (xhr, status, error) {
                Swal.fire({
                    icon: "error",
                    title: "Erreur",
                    text: "Une erreur est survenue",
                });
            },
        });
    });
}

function showStatics() {
    $(document).on("click", ".showSt", function (e) {
        e.preventDefault();
        $(".showSt").addClass("active_link");
        $(".showAc").removeClass("active_link");
        $(".showAe").removeClass("active_link");
        $.ajax({
            url: "./controllers/ConvController.php",
            type: "POST",
            data: { action: "showSts" },
            dataType: "json",
            beforeSend: function () {
                showLoadingSpinner();
            },
            success: function (data) {
                var countLicence = data.countLicence[0].countLicence;
                var countMaster = data.countMaster[0].countMaster;
                var countIngenieur = data.countIngenieur[0].countIngenieur;

                $("#fils").html("");
                $("#fils").css("display", "none");
                var chart =
                    "<canvas id='myChart' style='background-color: #f5f5f5;max-width: 80%;max-heigth: 60%'></canvas>";
                $("#section__content").html(chart);

                var ctx = document.getElementById("myChart").getContext("2d");
                var myChart = new Chart(ctx, {
                    type: "bar",
                    data: {
                        labels: ["Licence", "Master", "Ingénieur"],
                        datasets: [
                            {
                                label: "Conventions",
                                data: [
                                    countLicence,
                                    countMaster,
                                    countIngenieur,
                                ],
                                backgroundColor: [
                                    "rgba(255, 193, 7, 0.2)",
                                    "rgba(33, 150, 243, 0.2)",
                                    "rgba(76, 175, 80, 0.2)",
                                ],
                                borderColor: [
                                    "rgba(255, 193, 7, 1)",
                                    "rgba(33, 150, 243, 1)",
                                    "rgba(76, 175, 80, 1)",
                                ],
                                borderWidth: 1,
                                options: { responsive: true },
                            },
                        ],
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true,
                            },
                        },
                    },
                });
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
                Swal.fire({
                    icon: "error",
                    title: "Erreur",
                    text: "Une erreur est survenue",
                });
            },
            complete: function () {
                hideLoadingSpinner();
            },
        });
    });
}

function showConvSts() {
    $(document).on("click", ".showSt", function (e) {
        e.preventDefault();
        $(".showSt").addClass("active_link");
        $(".showAc").removeClass("active_link");
        $(".showAe").removeClass("active_link");
        $.ajax({
            url: "./controllers/ConvController.php",
            type: "POST",
            data: { action: "showSts" },
            dataType: "json",
            beforeSend: function () {
                showLoadingSpinner();
            },
            success: function (data) {
                var countLicence = data.countLicence[0].countLicence;
                var countMaster = data.countMaster[0].countMaster;
                var countIngenieur = data.countIngenieur[0].countIngenieur;

                $("#fils").html("");
                $("#fils").css("display", "none");
                var chart =
                    "<canvas id='myChart' style='background-color: #f5f5f5;max-width: 80%;max-heigth: 60%'></canvas>";
                $("#section__content").html(chart);

                var ctx = document.getElementById("myChart").getContext("2d");
                var myChart = new Chart(ctx, {
                    type: "bar",
                    data: {
                        labels: ["Licence", "Master", "Ingénieur"],
                        datasets: [
                            {
                                label: "Conventions",
                                data: [
                                    countLicence,
                                    countMaster,
                                    countIngenieur,
                                ],
                                backgroundColor: [
                                    "rgba(255, 193, 7, 0.2)",
                                    "rgba(33, 150, 243, 0.2)",
                                    "rgba(76, 175, 80, 0.2)",
                                ],
                                borderColor: [
                                    "rgba(255, 193, 7, 1)",
                                    "rgba(33, 150, 243, 1)",
                                    "rgba(76, 175, 80, 1)",
                                ],
                                borderWidth: 1,
                                options: { responsive: true },
                            },
                        ],
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true,
                            },
                        },
                    },
                });
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
                Swal.fire({
                    icon: "error",
                    title: "Erreur",
                    text: "Une erreur est survenue",
                });
            },
            complete: function () {
                hideLoadingSpinner();
            },
        });
    });
}

$(function () {
    $(".close").click(function () {
        $(".alert").alert("close");
        $(".top").css("display", "none");
    });

    getAllEntrs();
    showDiplomesNames();
    showAllConvs();
    showStatics();
    showConvSts();
});
