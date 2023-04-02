$(document).ready(function () {
    $(".close").click(function () {
        $(".alert").alert("close");
    });

    function showPassword() {
        $("#show_pass").click(function () {
            var password = $("#password");
            if (password.attr("type") === "password") {
                password.attr("type", "text");
                $(this).removeClass("fa-eye").addClass("fa-eye-slash");
            } else {
                password.attr("type", "password");
                $(this).removeClass("fa-eye-slash").addClass("fa-eye");
            }
        });

        $("#show_cpass").click(function () {
            var confirmPass = $("#confirm_pass");
            if (confirmPass.attr("type") === "password") {
                confirmPass.attr("type", "text");
                $(this).removeClass("fa-eye").addClass("fa-eye-slash");
            } else {
                confirmPass.attr("type", "password");
                $(this).removeClass("fa-eye-slash").addClass("fa-eye");
            }
        });
    }

    function resetPassword() {
        var resetForm = $("#reset_form");
        var submitButton = $("#reset");
        var password, username, caption;
        resetForm
            .submit(function (e) {
                e.preventDefault();
                password = $("#password").val();
            })
            .validate({
                rules: {
                    password: {
                        required: true,
                        minlength: 6,
                    },
                    confirm_pass: {
                        required: true,
                        equalTo: "#password",
                        minlength: 6,
                    },
                },
                messages: {
                    password: {
                        required: "Veuillez entrer un nouveau mot de passe",
                    },
                    confirm_pass: {
                        required: "Veuillez confirmer le mot de passe",
                        equalTo: "Le mot de passe ne correspond pas!",
                    },
                },

                submitHandler: function (form) {
                    caption = submitButton.html();
                    $.ajax({
                        type: "POST",
                        url: "../controllers/Ajax.php",
                        data: { password: password, username: window.username },
                        beforeSend: function () {
                            submitButton.attr("disabled", true).html("Attendez...");
                            showLoadingSpinner();
                        },
                        action: "resetPass",
                        success: function (response) {
                            console.log(response);
                            if (response.success) {
                                console.log(response.success);
                                Swal.fire({
                                    icon: "success",
                                    title: "Mot de passe mise",
                                    text: response.success,
                                }).then(() => {
                                        window.location.href = "../logout";
                                });
                            } else {
                                console.log(response.error);
                                Swal.fire({
                                    icon: "error",
                                    title: "Erreur walo!",
                                    text: response.error,
                                });
                            }
                            submitButton.attr("disabled", false).html(caption);
                        },
                        error: function (xhr, status, error) {
                            Swal.fire({
                                icon: "error",
                                title: "Erreur!",
                                text: "Une erreur est survenue. Veuillez réessayer une autre fois.",
                            });
                        },
                        complete: function () {
                            hideLoadingSpinner();
                            submitButton.attr("disabled", false).html(caption);
                        },
                    });
                    resetForm.trigger("reset");
                },
            });
    }

    showPassword();
    resetPassword();
});
