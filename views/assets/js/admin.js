function getAllEntrs() {
    $(document).on("click", ".showAe", function (e) {
        e.preventDefault();
        $(".showAe").addClass("active");
        $(".showAc").removeClass("active");
        $.ajax({
            url: "./controllers/Ajax.php",
            type: "POST",
            data: { action: "show" },
            dataType: "html",
            success: function (data) {
                $("#Select").html("");
                $("#main__content").html(data);
            },
            error: function (xhr, textStatus, errorThrown) {
                console.error(textStatus, errorThrown);
                Swal.fire({
                    icon: "error",
                    title: "Erreur",
                    text: textStatus,
                });
            },
        });
    });
}

function showDiplomesNames() {
    $(document).on("click", ".showAc", function (e) {
        e.preventDefault();
        $(".showAc").addClass("active");
        $(".showAe").removeClass("active");
        $.ajax({
            url: "./controllers/ConvController.php",
            type: "POST",
            data: { action: "showConvs" },
            dataType: "json",
            success: function (data) {
                var licenseData = data.Licence;
                var masterData = data.Master;
                var engineerData = data.Ingenieur;

                var Select = "";
                if (Object.keys(data).length > 0) {
                    Select +=
                        '<select class="form-select w-25 mt-4 mb-5" id="filterbyf" name="filterbyf">';
                    Select += '<option value="Tous" selected>Tous</option>';
                    Select += '<optgroup label="Licence">';
                    for (var i = 0; i < licenseData.length; i++) {
                        var item = licenseData[i];
                        for (var key in item) {
                            if (item.hasOwnProperty(key)) {
                                Select +=
                                    '<option value="' +
                                    item[key] +
                                    '">' +
                                    item[key] +
                                    "</option>";
                            }
                        }
                    }

                    Select += "</optgroup>";
                    Select += '<optgroup label="Master">';
                    for (var i = 0; i < masterData.length; i++) {
                        var item = masterData[i];
                        for (var key in item) {
                            if (item.hasOwnProperty(key)) {
                                Select +=
                                    '<option value="' +
                                    item[key] +
                                    '">' +
                                    item[key] +
                                    "</option>";
                            }
                        }
                    }

                    Select += "</optgroup>";
                    Select += '<optgroup label="Ingenieur">';
                    for (var i = 0; i < engineerData.length; i++) {
                        var item = engineerData[i];
                        for (var key in item) {
                            if (item.hasOwnProperty(key)) {
                                Select +=
                                    '<option value="' +
                                    item[key] +
                                    '">' +
                                    item[key] +
                                    "</option>";
                            }
                        }
                    }

                    Select += "</optgroup>";
                    Select += "</select>";
                    $("#main__content").html("");
                    $("#Select").html(Select);
                } else {
                    $("#Select").html(
                        "<p class='text-center color-info'>La base est vide</p>"
                    );
                }
            },
            error: function (xhr, textStatus, errorThrown) {
                Swal.fire({
                    icon: "error",
                    title: "Erreur",
                    text: "Une erreur est survenue",
                });
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
                $("#main__content").html(ConvsTable);
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText, error);
                // Swal.fire({
                //     icon: "error",
                //     title: "Erreur",
                //     text: "Une erreur est survenue",
                // });
            },
        });
    });
}

$(function () {
    getAllEntrs();
    showDiplomesNames();
    showAllConvs();
});
