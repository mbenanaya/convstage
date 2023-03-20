
function getAllEntrs() {
    $(document).on("click", "#showAe", function (e) {
        e.preventDefault();
        $.ajax({
            url: "./controllers/Ajax.php",
            type: "POST",
            data: { action: "show" },
            dataType: "html",
            success: function (data) {
                console.log(data);
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

function getAllConvs() {
    $(document).on("click", "#showAc", function (e) {
        e.preventDefault();
        $.ajax({
            url: "./controllers/ConvController.php",
            type: "POST",
            data: { action: "showConvs" },
            dataType: "json",
            success: function (data) {
                console.log(data);
                ConvsTable = "";
                ConvsTable +=
                    '<table class="table bg-light table-striped-rows"> <thead> <tr> <th scope="col">CNE</th> <th scope="col">Nom</th> <th scope="col">Prénom</th> <th scope="col">Filière</th> <th scope="col">Nom d\'entreprise</th> <th scope="col">Adresse</th> <th scope="col">Telephone</th> <th scope="col">Nom d\'encadrant</th> <th scope="col">Date Début</th> <th scope="col">Date Fin</th> </tr> </thead> <tbody>';
                $.each(data, function () {
                    ConvsTable +=
                        "<tr> <td>" +
                        this.cne +
                        "</td> <td>" +
                        this.nom +
                        "</td> <td>" +
                        this.prenom +
                        "</td> <td>" +
                        this.filiere +
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

$(function () {

    getAllEntrs();
    getAllConvs();
});
