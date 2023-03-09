function showPassword() {
    $("#show-password").click(function () {
        var password = $("#password");
        if (password.attr("type") === "password") {
            password.attr("type", "text");
            $(this).removeClass("fa-eye").addClass("fa-eye-slash");
        } else {
            password.attr("type", "password");
            $(this).removeClass("fa-eye-slash").addClass("fa-eye");
        }
    });
}

function formValidation() {
    var connectButton = $("#connecter");
    var loginForm = $("#login_form");
    loginForm
        .submit(function (e) {
            e.preventDefault();
        })
        .validate({
            rules: {
                email: {
                    required: true,
                    email: true,
                },
                password: {
                    required: true,
                },
            },
            messages: {
                email: {
                    required: "L'adresse email est obligatoire",
                    email: "L'adresse email est invalide",
                },
                password: {
                    required: "Le mot de passe est obligatoire",
                },
            },

            submitHandler: function (form) {
                var formData = new FormData(form);
                $.ajax({
                    url: "./controllers/LoginController.php",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    dataType: "text",
                    success: function (response) {
                        console.log(response);
                        window.location.href =
                            "views/home.php?prenom=" +response;
                    },
                    error: function (xhr, textStatus, errorThrown) {
                        console.error(textStatus, errorThrown);
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: "error found",
                        });
                    },
                });
            },
        });
}

$(function () {
    showPassword();
    formValidation();
});
