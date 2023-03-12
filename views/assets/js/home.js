function getEntrNames() {
    showEntrName = $(".fa-caret-down");
    showEntrName.click(function () {
        $(this).removeClass("fa-caret-down");
        $(this).addClass("fa-caret-up");
        $.ajax({
            url: "./controllers/Ajax.php",
            method: "POST",
            data: { action: "showNames" },
            dataType: "json",
            success: function (data) {
                console.log(data);
                var listItems = "";
                $.each(data, function (index, value) {
                    listItems +=
                        '<li data-id="' +
                        value.idEntr +
                        '">' +
                        value.nomEntr +
                        "</li>";
                });
                $("#list_entr").html(listItems);
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
        $("#list_entr").fadeIn("slow");
    });

}

function getEntrInfos() {
    $(document).on("click", "#list_entr li", function () {
        var idEntr = $(this).data("id");
        $.ajax({
            url: "./controllers/Ajax.php",
            type: "POST",
            data: { idEntr: idEntr },
            dataType: "json",
            success: function (data) {
                console.log(data);
                $("#nomEntr").val(data.nomEntr);
                $("#adrEntr").val(data.adrEntr);
                $("#telEntr").val(data.telEntr);
                $("#nomEncd").val(data.nomEncd);
            },
            error: function (xhr, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
                Swal.fire({
                    icon: "error",
                    title: "Erreur",
                    text: textStatus,
                });
            },
        });

        $("#showEntrName").removeClass("fa-caret-up");
        $("#showEntrName").addClass("fa-caret-down");
        $("#list_entr").fadeOut();
    });
}

function createConv() {
    var convForm = $("#conv_form");
    convForm
        .submit(function (e) {
            e.preventDefault();
        })
        .validate({
            rules: {
                nom: {
                    required: true,
                },
                prenom: {
                    required: true,
                },
                cne: {
                    required: true,
                },
                filiere: {
                    required: true,
                },
                datedebut: {
                    required: true,
                },
                datefin: {
                    required: true,
                },
                nomEntr: {
                    required: true,
                },
                adrEntr: {
                    required: true,
                },
                telEntr: {
                    required: true,
                },
                nomEncd: {
                    required: true,
                },
            },
            messages: {
                nom: {
                    required: "L'adresse email est obligatoire",
                },
                prenom: {
                    required: "Le mot de passe est obligatoire",
                },
                cne: {
                    required: "L'adresse email est obligatoire",
                },
                filiere: {
                    required: "Le mot de passe est obligatoire",
                },
                datedebut: {
                    required: "L'adresse email est obligatoire",
                },
                datefin: {
                    required: "Le mot de passe est obligatoire",
                },
                nomEntr: {
                    required: "L'adresse email est obligatoire",
                },
                adrEntr: {
                    required: "Le mot de passe est obligatoire",
                },
                telEntr: {
                    required: "L'adresse email est obligatoire",
                },
                nomEncd: {
                    required: "Le mot de passe est obligatoire",
                },
            },

            submitHandler: function (form) {
                $.ajax({
                    url: "./controllers/Ajax.php",
                    type: "POST",
                    data: $(form).serialize(),
                    contentType:
                        "application/x-www-form-urlencoded; charset=UTF-8",
                    success: function (response) {
                        Swal.fire({
                            icon: "success",
                            title: "Success",
                            text: "Nice",
                        });
                        $(form).reset();
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
            },
        });
}

$(function () {
    $(".close").click(function () {
        $(".alert").alert("close");
    });

    $("#list_entr").hide();
    getEntrNames();
    getEntrInfos();
    createConv();
});
