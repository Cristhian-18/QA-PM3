//Subform Check List Documentos
//$("#grd_obligatorios").hideColumn(3);
//$("#grd_especificos").hideColumn(3);

$(".pmdynaform-grid-title").removeClass("pmdynaform-grid-title");
$("#fle_poliza").find("button").html("Seleccionar archivos");
$("#fle_endosos").find("button").html("Seleccionar archivos");

$('#frm_accion').setOnchange(acciones);
acciones();

ocultar_todo();
$("#subtit_datos").show();
$("#25830987060590cf686aa76067215111").show();
$("#3659092825f484ded40e690037283996").hide();
$("#6663629995fa42bedd1f833054954588").show();

$('.menu').on('click', function () {
	ocultar_todo();
	switch (this.id) {
		case 'solicitud':
			$("#subtit_datos").show();

			$("#25830987060590cf686aa76067215111").show();
			$("#subtit_commen").hide();
			$("#3659092825f484ded40e690037283996").hide();			
			ocultarDentalExequial();
			$("#6663629995fa42bedd1f833054954588").show();
			break;

		case 'documentos':
			$("#subtit_docs").show();
			$("#7232410255f4510e7ddb431040314312").show();
			$("#4134920295f9c8c87b37d96033269232").show();
			$("#4240566656458731d63f9a5040971812").show();

			break;

		case 'suscripcion':

			break;

		case 'historial':
			$("#subtit_cambios").show();
			$("#subtit_commen").show();
			$("#subtit_revision").show();

			$("#frm_accion").show();
			$("#frm_comentario").show();

			$("#3659092825f484ded40e690037283996").show();
			$("#9458715575fa435e25efcc4029990032").show();

			$("#btn_emision_save").show();
			$("#btn_continuar").show();
			$("#frm_numero_poliza").show();
			$("#frm_numero_factura").show();
			$("#frm_vendedor_email").show();
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
	$("#4240566656458731d63f9a5040971812").hide();
	$("#subtit_cambios").hide();
	$("#subtit_sise").hide();
	$("#7322237105fa4354c1c5cc1002811158").hide();
	$("#6663629995fa42bedd1f833054954588").hide();
	$("#frm_accion").hide();
	$("#frm_comentario").hide();

	$("#25830987060590cf686aa76067215111").hide();
	$("#9458715575fa435e25efcc4029990032").hide();

	$("#btn_emision_save").hide();
	$("#btn_continuar").hide();


	$("#7143229796457cc4c0f1d64039882781").hide();
	$("#frm_numero_poliza").hide();
	$("#frm_numero_factura").hide();
	$("#fle_poliza").hide();
	$("#fle_endosos").hide();
	$("#frm_vendedor_email").hide();

	$("#subt_depen_bene").hide();
	$("#5637859396697de7e3b2ed3058496123").hide();
  	$("#frm_num_exequial").hide();
}

$("#btn_emision_save").find("button").on("click", function () {
	$("#3382823306457c569d9a864093487913").saveForm();
	alert("Formulario guardado ...");
});


$("#7180710025fa41a3ccadfb4005520079").setOnSubmit(function () {
	$("#7180710025fa41a3ccadfb4005520079").saveForm();
	return true;
});




function acciones() {
	var accion = $("#frm_accion").getControl().val();
	$("#frm_cobranza_banco").disableValidation();
	$("#frm_cobranza_tipo_pago").disableValidation();
	$("#frm_cobranza_fecha").disableValidation();
	$("#frm_cobranza_referencia").disableValidation();
	$("#frm_cobranza_valor").disableValidation();
	$("#frm_cobranza_comentario").disableValidation();

	if (accion == 'PAGAR') {
		$("#7143229796457cc4c0f1d64039882781").show();
		$("#frm_cobranza_banco").enableValidation();
		$("#frm_cobranza_tipo_pago").enableValidation();
		$("#frm_cobranza_fecha").enableValidation();
		$("#frm_cobranza_referencia").enableValidation();
		$("#frm_cobranza_valor").enableValidation();
		$("#frm_cobranza_comentario").enableValidation();
		$("#fle_poliza").hide();
		$("#fle_endosos").hide();
		$("#fle_poliza").disableValidation();
	}
	else {
		if (accion == 'CONTINUAR') {
			//$("#fle_poliza").enableValidation();
			$("#7143229796457cc4c0f1d64039882781").hide();
			$("#frm_cobranza_banco").disableValidation();
			$("#frm_cobranza_tipo_pago").disableValidation();
			$("#frm_cobranza_fecha").disableValidation();
			$("#frm_cobranza_referencia").disableValidation();
			$("#frm_cobranza_valor").disableValidation();
			$("#frm_cobranza_comentario").disableValidation();
		}
	}
}

function ocultarDentalExequial() {
  var rows_dental = $("#tri_bandera_dental").getValue();
  if (rows_dental == 0) {
      $("#grid_dental").hide();
      $("#lbl_dental").hide();

      $("#grid_dental").disableValidation(2);
      $("#grid_dental").disableValidation(5);
      $("#grid_dental").disableValidation(7);
      $("#grid_dental").disableValidation(9);
      $("#grid_dental").disableValidation(10);
      $("#grid_dental").disableValidation(13);
  }

  var rows_exequial = $("#tri_bandera_exquial").getValue();
  
  if (rows_exequial == 0) {
      $("#grid_seguro_exequial").hide();
      $("#lbl_exequial").hide();
	  $("#grid_seguro_exequial").disableValidation(1);
      $("#grid_seguro_exequial").disableValidation(2);
      $("#grid_seguro_exequial").disableValidation(3);
      $("#grid_seguro_exequial").disableValidation(4);
      $("#grid_seguro_exequial").disableValidation(5);
      $("#grid_seguro_exequial").disableValidation(7);
      $("#grid_seguro_exequial").disableValidation(9);
      $("#grid_seguro_exequial").disableValidation(10);
      $("#grid_seguro_exequial").disableValidation(13);
  }
  
  if (rows_dental == 0 && rows_exequial == 0){
    $("#5637859396697de7e3b2ed3058496123").hide();
  	$("#subt_depen_bene").hide();
  }else{
    $("#5637859396697de7e3b2ed3058496123").show();
  	$("#subt_depen_bene").show();
  }
}

function ocultarInfoDependietes(){
  $("#lbl_dental").hide();
  $("#lbl_exequial").hide();
  $("#frm_opcion_liquidacion_valor").hide();
  $("#frm_plazo_cuotas_liquidacion").hide();
  $("#frm_pago_unico_porcentaje").hide();
  $("#frm_pago_cuota_porcentaje").hide();
  $("#frm_plazo_cuotas_liquidacion_combinada").hide();
  $("#frm_cumulo_vida").hide();
  $("#frm_cumulo_vida_muerte").hide();
  $("#frm_tipo_plan_dental").hide();
  $("#tri_bandera_dental").hide();
  $("#tri_bandera_exquial").hide();
  $("#btn_copiar").hide();
  $("#grd_beneficiario").hide();  
  $("#frm_plan_total_beneficiarios").hide();
  $("#grid_beneficiarios_contingentes").hide();  
  $("#frm_plan_total_beneficiarios_contingentes").hide();
  $("#grid_otros_seguros").hide();
  
  $("#frm_opcion_liquidacion_valor").disableValidation();
  $("#frm_plazo_cuotas_liquidacion").disableValidation();
  $("#frm_pago_unico_porcentaje").disableValidation();
  $("#frm_pago_cuota_porcentaje").disableValidation();
  $("#frm_plazo_cuotas_liquidacion_combinada").disableValidation();
  $("#frm_cumulo_vida").disableValidation();
  $("#frm_cumulo_vida_muerte").disableValidation();
  
  $("#grid_beneficiarios_contingentes").disableValidation(3);
  $("#grid_beneficiarios_contingentes").disableValidation(5);
  $("#grid_beneficiarios_contingentes").disableValidation(7);
  $("#grid_beneficiarios_contingentes").disableValidation(8);
  $("#grid_beneficiarios_contingentes").disableValidation(9);
  $("#grid_beneficiarios_contingentes").disableValidation(10);
  $("#grid_beneficiarios_contingentes").disableValidation(11);
  
  $("#grd_beneficiario").disableValidation(3);
  $("#grd_beneficiario").disableValidation(5);
  $("#grd_beneficiario").disableValidation(7);
  $("#grd_beneficiario").disableValidation(8);
  $("#grd_beneficiario").disableValidation(9);
  $("#grd_beneficiario").disableValidation(10);
  $("#grd_beneficiario").disableValidation(11);
}

ocultarDentalExequial();
ocultarInfoDependietes();


