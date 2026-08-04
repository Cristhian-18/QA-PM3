// $(".pmdynaform-grid-title").removeClass("pmdynaform-grid-title");
//getFieldById("grd_especificos").$el.css("padding-bottom", "150px")

ocultar_todo();
$("#subtit_datos").show();

$('.menu').on('click', function () {
	ocultar_todo();
	switch (this.id) {
		case 'solicitud':
			$("#subtit_datos").show();

			if (typeof $("#subtit_datos").find(".glyphicon-plus").html() === 'undefined') {
				$("#6479360225f976335c43157021199308").show();
			}

			break;

		case 'documentos':
			$("#subtit_docs").show();
			
			if (typeof $("#subtit_docs").find(".glyphicon-plus").html() === 'undefined') {
				$("#7232410255f4510e7ddb431040314312").show();
				$("#4134920295f9c8c87b37d96033269232").show();
			}
			
			break;

		case 'sise':
			$("#subtit_sise").show();
			if (typeof $("#subtit_sise").find(".glyphicon-plus").html() === 'undefined') {
				$("#3935476835faeb6446abb62086515001").show();
				$("#7630948545faeb652af6268064318900").show();
				$("#9339587925faeb65b4e6c46077220923").show();
			}

			break;

		case 'historial':
			$("#subtit_cambios").show();
			$("#subtit_commen").show();
			//$("#3659092825f484ded40e690037283996").show();
			$("#frm_accion").show();
			$("#frm_comentario").show();

			break;
	}
});


function ocultar_todo() {
	$("#subtit_commen").hide();
	$("#3659092825f484ded40e690037283996").hide();

	$("#subtit_datos").hide();
	$("#6479360225f976335c43157021199308").hide();

	$("#subtit_docs").hide();
	$("#7232410255f4510e7ddb431040314312").hide();
	$("#4134920295f9c8c87b37d96033269232").hide();
	$("#subtit_sise").hide();
	$("#3935476835faeb6446abb62086515001").hide();
	$("#7630948545faeb652af6268064318900").hide();
	$("#9339587925faeb65b4e6c46077220923").hide();

	$("#subtit_cambios").hide();
	$("#frm_accion").hide();
	$("#frm_comentario").hide();
}