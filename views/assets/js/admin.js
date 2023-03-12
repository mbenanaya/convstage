

$(function () {
    var showAe = $("#showAe");

    showAe.click(function (e) {
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
})
