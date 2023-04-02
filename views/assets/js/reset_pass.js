$(document).ready(function () {
    var resetPassForm = $("#reset_pass");
    var submitButton = $("#reset");
    var email, caption;
    resetPassForm
        .submit(function (e) {
            e.preventDefault();
            email = $("#email").val();
        })
        .validate({
            rules: {
                email: {
                    required: true,
                    email: true,
                },
            },
            messages: {
                email: {
                    required: "L'adresse email est obligatoire",
                    email: "Veuillez fournir une adresse email valide"
                },
            },

            submitHandler: function (form) {
                caption = submitButton.html();
                $.ajax({
                    type: "POST",
                    url: "./views/send_mail.php",
                    data: { email: email },
                    beforeSend: function () {
                        submitButton
                            .attr("disabled", true)
                            .html("Attendez...");
                        showLoadingSpinner();
                    },
                    success: function (response) {
                        
                        if (response.success) {
                            Swal.fire({
                                icon: "success",
                                title: "Email envoyé!",
                                text: response.success,
                            });
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "Erreur!",
                                text: response.error,
                            });
                        }
                        submitButton.attr("disabled", false).html(caption);
                    },
                    error: function (xhr, status, error) {
                        console.log(status, error)
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
                resetPassForm.trigger("reset");
            },
        });
});