$(document).ready(function () {
	$("#list_entr").hide();

	$(".close").click(function () {
		$(".alert").alert("close");
	});

	$(document).on("click", ".del_conv", function () {
		var cne = $(this).data("id"); // assuming you have data-id attribute on your button

		Swal.fire({
			title: "Êtes-vous sûr?",
			text: "Vous ne pourrez pas revenir en arrière!",
			icon: "warning",
			showCancelButton: true,
			confirmButtonColor: "#3085d6",
			cancelButtonColor: "#d33",
			confirmButtonText: "Oui, supprimez-le!",
			cancelButtonText: "Non, annulez!",
		}).then((result) => {
			if (result.isConfirmed) {
				console.log("cne is ", cne);
				$.ajax({
					url: "./controllers/ConvController.php",
					type: "POST",
					data: { action: "delConv", cne: cne },
					dataType: "json",
					success: function (response) {
						// handle success
						console.log(response);
						// if (response.status === "success") {
						// 	// Swal.fire(
						// 	// 	"Supprimé!",
						// 	// 	"Votre fichier a été supprimé.",
						// 	// 	"success"
						// 	// );
						// 	console.log('deleted :)');
						// 	// remove the deleted element from the DOM or reload the page
						// } else {
						// 	console.log('error :(');
						// 	// handle error
						// 	// Swal.fire(
						// 	// 	"Erreur!",
						// 	// 	"Il y avait une erreur lors de la suppression de votre fichier.",
						// 	// 	"error"
						// 	// );
						// }
					},
					error: function (xhr, textStatus, errorThrown) {
						console.log(errorThrown);
						// Swal.fire(
						// 	"Erreur!",
						// 	"Il y avait une erreur lors de la suppression de votre fichier.",
						// 	"error"
						// );
					},
				});
			}
		});
	});

	function getConvByCne() {
		var stud_cne = $("#stud_cne").val();

		$.ajax({
			url: "./controllers/ConvController.php",
			type: "POST",
			data: { action: "getLastConv", stud_cne: stud_cne },
			dataType: "json",
			success: function (data) {
				console.log("data is ", data[0]);

				if (data[0].pdf) {
					console.log("Pdf is ", data[0].pdf);
					var pdfPath = "conventions/" + data[0].pdf;
					pdfjsLib.workerSrc =
						"https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.9.359/pdf.worker.min.js";
					pdfjsLib.GlobalWorkerOptions.workerSrc =
						"https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.9.359/pdf.worker.min.js";

					var pdfContainer = $(
						'<div class="col-12 col-md-10 col-lg-8 col-xxl-7 d-flex flex-column justify-content-center mb-5" ><div id="btns" class="py-2" style="display: none;"><a href="" id="download_link" class="btn btn-success submit_button mx-1"> <i class="fa fa-download"></i> Télécharger</a><button class="btn btn-danger del_conv mx-1" name="supprimer"><i class="fa fa-trash"></i> Supprimer<button></div></div>'
					).addClass("pdf-container");
					var id = $("#stud_cne").val();
					
					$(".wrapper").append(pdfContainer);

					pdfjsLib
						.getDocument({
							url: pdfPath,
						})
						.promise.then(function (pdf) {
							var pdfContainer = $(".pdf-container")[0];
							var scale = 1;
							$("#btns").show();

							function renderPage(pageNum) {
								pdf.getPage(pageNum).then(function (page) {
									var viewport = page.getViewport({
										scale: scale,
									});
									var canvas =
										document.createElement("canvas");
									var context = canvas.getContext("2d");
									canvas.className = "pdf-canvas";
									canvas.width = viewport.width;
									canvas.height = viewport.height;
									pdfContainer.append(canvas);
									var renderContext = {
										canvasContext: context,
										viewport: viewport,
									};
									page.render(renderContext);
									if (pageNum < pdf.numPages) {
										renderPage(pageNum + 1);
									}
								});
							}
							renderPage(1);
						});
					$(".del_conv").data("id", id);
				}
			},
			error: function (xhr, textStatus, errorThrown) {
				console.error(textStatus, errorThrown);
				// Swal.fire({
				//     icon: "error",
				//     title: "Erreur",
				//     text: textStatus,
				// });
			},
			complete: function () {
				// hideLoadingSpinner();
			},
		});
	}

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
		var cne, nom;
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
					diplome: {
						required: true,
					},
					datedebut: {
						required: true,
					},
					datefin: {
						required: true,
					},
					intitule: {
						required: true,
					},
					description: {
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
					qltEncd: {
						required: true,
					},
					emailEncd: {
						required: true,
						email: true,
					},
					nomResp: {
						required: true,
					},
					qltResp: {
						required: true,
					},
					telResp: {
						required: true,
					},
					emailResp: {
						required: true,
						email: true,
					},
				},
				messages: {
					emailEncd: {
						email: "Veuillez fournir une adresse email valide",
					},
					emailResp: {
						email: "Veuillez fournir une adresse email valide",
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
						// dataType: "json",
						beforeSend: function () {
							submitButton
								.attr("disabled", true)
								.html("Attendez...");
							// showLoadingSpinner();
						},
						success: function (data) {
							submitButton.attr("disabled", false).html(caption);
							console.log(data);
						},
						error: function (xhr, textStatus, errorThrown) {
							submitButton.attr("disabled", false).html(caption);
							Swal.fire({
								icon: "error",
								title: "Erreur",
								text: "Une erreur est survenue",
							});
							console.log("er ", errorThrown);
						},
						complete: function () {
							submitButton.attr("disabled", false).html(caption);
							// hideLoadingSpinner();
						},
					});

					$(form).trigger("reset");
				},
			});
	}

	getEntrNames();
	getEntrInfos();
	createConv();
	getConvByCne();
});
