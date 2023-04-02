function showPassword() {
    $("#show_datenaiss").click(function () {
        var datenaiss = $("#datenaiss");
        if (datenaiss.attr("type") === "password") {
            datenaiss.attr("type", "text");
            $(this).removeClass("fa-eye").addClass("fa-eye-slash");
        } else {
            datenaiss.attr("type", "password");
            $(this).removeClass("fa-eye-slash").addClass("fa-eye");
        }
    });

    $("#show_password").click(function () {
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

function StudentLogin() {
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
                datenaiss: {
                    required: true,
                },
            },
            messages: {
                email: {
                    required: "Le cne est obligatoire",
                },
                datenaiss: {
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
                        Swal.fire({
                            icon: "error",
                            title: "Erreur!!",
                            text: "Une erreur est survenue",
                        });
                    },
                });
            },
        });
}

function AdminLogin() {
    var loginForm = $("#admin_login");
    loginForm
        .submit(function (e) {
            e.preventDefault();
        })
        .validate({
            rules: {
                email: {
                    required: true,
                    email: true
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
                                title: "Erreur!!",
                                text: response.message,
                            });
                        }
                        $(form).trigger("reset");
                    },
                    error: function (xhr, textStatus, errorThrown) {
                        Swal.fire({
                            icon: "error",
                            title: "Erreur!!",
                            text: "Une erreur est survenue",
                        });
                    },
                });
            },
        });
}

$(function () {
    showPassword();
    StudentLogin();
    AdminLogin();
});
