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
    var loginForm = $("#login_form");
    loginForm
        .submit(function (e) {
            e.preventDefault();
        })
        .validate({
            rules: {
                email: {
                    required: true,
                },
                password: {
                    required: true,
                },
            },
            messages: {
                email: {
                    required: "L'adresse email est obligatoire",
                },
                password: {
                    required: "Le mot de passe est obligatoire",
                },
            },

            submitHandler: function (form) {
                $.ajax({
                    url: "./controllers/LoginController.php",
                    type: "POST",
                    data: $(form).serialize(),
                    contentType:
                        "application/x-www-form-urlencoded; charset=UTF-8",
                    success: function (response) {
                        if (response.success) {
                            window.location.href = response.url;
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "Erreur",
                                text: response.message,
                            });
                        }
                        $(form).trigger("reset");
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
    showPassword();
    formValidation();
});
