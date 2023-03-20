$(document).ready(function () {

    $("#list_entr").hide();

    $(".close").click(function () {
        $(".alert").alert("close");
    });

    function hideEntrs() {
        $("#nomEntr").click(function () {
            $("#showEntrName").removeClass("fa-caret-up");
            $("#showEntrName").addClass("fa-caret-down");
            $("#list_entr").fadeOut();
        });

        $(document).on("click", ".fa-caret-up#showEntrName", function () {
            $("#showEntrName").removeClass("fa-caret-up");
            $("#showEntrName").addClass("fa-caret-down");
            $("#list_entr").fadeOut();
        });
    }
    hideEntrs();

    function getEntrNames() {
        $(document).on("click", ".fa-caret-down#showEntrName", function () {
            $(this).removeClass("fa-caret-down");
            $(this).addClass("fa-caret-up");
            $.ajax({
                url: "./controllers/Ajax.php",
                method: "POST",
                data: { action: "showNames" },
                dataType: "json",
                success: function (data) {
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
        var submitButton = $("#crCnvButt");
        // var cne, nom;
        convForm
            .submit(function (e) {
                e.preventDefault();
                nom = $("#nom").val();
                cne = $("#cne").val();
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

                submitHandler: function (form) {
                    var caption = submitButton.html();
                    $.ajax({
                        url: "./controllers/ConvController.php",
                        type: "POST",
                        data: $(form).serialize(),
                        contentType:
                            "application/x-www-form-urlencoded; charset=UTF-8",
                        dataType: "json",
                        beforeSend: function () {
                            submitButton
                                .attr("disabled", true)
                                .html("Attender...");
                            showLoadingSpinner();
                        },
                        success: function (data) {
                            submitButton.attr("disabled", false).html(caption);
                        },
                        error: function (xhr, textStatus, errorThrown) {
                            submitButton.attr("disabled", false).html(caption);
                            Swal.fire({
                                icon: "error",
                                title: "Erreur",
                                text: "Une erreur est survenue",
                            });
                        },
                        complete: function () {
                            setTimeout(function () {
                                submitButton
                                    .attr("disabled", true)
                                    .html("Attender...");
                            }, 500);
                            submitButton.attr("disabled", false).html(caption);
                            hideLoadingSpinner();
                        },
                    });

                    $.ajax({
                        url: "./views/generate_conv.php",
                        type: "POST",
                        data: $(form).serialize(),
                        xhrFields: {
                            responseType: "blob",
                        },
                        beforeSend: function () {
                            submitButton
                                .attr("disabled", true)
                                .html("Attender...");
                            showLoadingSpinner();
                        },
                        success: function (data) {
                            submitButton.attr("disabled", false).html(caption);
                            var blob = new Blob([data], {
                                type: "application/pdf",
                            });
                            var link = document.createElement("a");
                            link.href = window.URL.createObjectURL(blob);
                            link.download =
                                "Convention_" + nom + "_" + cne + ".pdf";
                            link.click();
                            setTimeout(function () {
                                window.URL.revokeObjectURL(link.href);
                                $(link).remove();
                            }, 100);
                        },
                        error: function (xhr, textStatus, errorThrown) {
                            submitButton.attr("disabled", false).html(caption);
                            Swal.fire({
                                icon: "error",
                                title: "Erreur",
                                text: "Une erreur est survenue",
                            });
                        },
                        complete: function () {
                            submitButton.attr("disabled", false).html(caption);
                            hideLoadingSpinner();
                        },
                    });

                    $(form).trigger("reset");
                },
            });
    }

    getEntrNames();
    getEntrInfos();
    createConv();
});
