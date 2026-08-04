//Subform Check List Documentos
//$("#grd_obligatorios").hideColumn(3);
//$("#grd_especificos").hideColumn(3);

$(".pmdynaform-grid-title").removeClass("pmdynaform-grid-title");
//getFieldById("grd_especificos").$el.css("padding-bottom", "150px")
$("#fle_poliza").find("button").html("Seleccionar archivos");
$("#fle_endosos").find("button").html("Seleccionar archivos");

$('#frm_accion').setOnchange(acciones);
acciones();

ocultar_todo();
$("#subtit_datos").show();
$("#25830987060590cf686aa76067215111").show();
$("#3659092825f484ded40e690037283996").hide();
$("#6663629995fa42bedd1f833054954588").show();

/*$("#subtit_datos").show();
$("#25830987060590cf686aa76067215111").show();
$("#subtit_commen").show();
$("#3659092825f484ded40e690037283996").show();
$("#subt_depen_bene").show();
$("#5637859396697de7e3b2ed3058496123").show();
$("#6663629995fa42bedd1f833054954588").show();*/

$('.menu').on('click', function () {
	ocultar_todo();
	switch (this.id) {
		case 'solicitud':
			$("#subtit_datos").show();

			//if($('#subtit_datos i').attr('class').indexOf("glyphicon-minus") > 0){
			$("#25830987060590cf686aa76067215111").show();
			$("#subtit_commen").hide();
			$("#3659092825f484ded40e690037283996").hide();
			//}
			ocultarDentalExequial();
			$("#6663629995fa42bedd1f833054954588").show();
        	$("#fle_poliza").hide();
			$("#fle_endosos").hide();

			break;

		case 'documentos':
			$("#subtit_docs").show();

			//if($('#subtit_docs i').attr('class').indexOf("glyphicon-minus") > 0){
			$("#7232410255f4510e7ddb431040314312").show();
			$("#4134920295f9c8c87b37d96033269232").show();
			$("#4240566656458731d63f9a5040971812").show();
        	$("#fle_poliza").hide();
			$("#fle_endosos").hide();
			//}

			break;

		case 'suscripcion':
			//$("#subtit_revision").show();

			//if($('#subtit_revision i').attr('class').indexOf("glyphicon-minus") > 0){
			//$("#9379493576457c9284775a0019336286").show();
			//$("#897660916609f1c71cba367023383689").show();
			//}

			break;

		case 'historial':
			$("#subtit_cambios").show();
			$("#subtit_commen").show();
			$("#subtit_revision").show();

			$("#frm_accion").show();
			$("#frm_comentario").show();

			//if($('#ifrm_sbt_commen i').attr('class').indexOf("glyphicon-minus") > 0){
			$("#3659092825f484ded40e690037283996").show();
			//}		
			//$("#9379493576457c9284775a0019336286").show();
			//if($('#ifrm_sbt_acc i').attr('class').indexOf("glyphicon-minus") > 0){
			$("#9458715575fa435e25efcc4029990032").show();

			$("#btn_emision_save").show();
			$("#btn_continuar").show();
			$("#frm_numero_poliza").show();
			$("#frm_numero_factura").show();
			$("#frm_vendedor_email").show();
        	$("#fle_poliza").show();
			$("#fle_endosos").show();
			//}
			break;
	}
});


function ocultar_todo() {
	$("#subtit_commen").hide();
  	$("#fle_poliza").hide();
	$("#fle_endosos").hide();
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

	//$("#subtit_revision").hide();
	//$("#9379493576457c9284775a0019336286").hide();
	//$("#897660916609f1c71cba367023383689").hide();

	$("#btn_emision_save").hide();
	$("#btn_continuar").hide();


	$("#7143229796457cc4c0f1d64039882781").hide();
	$("#frm_numero_poliza").hide();
    $("#frm_numero_poliza").disableValidation();
	$("#frm_numero_factura").hide();
    $("#frm_numero_factura").disableValidation();
	$("#frm_vendedor_email").hide();
  	$("#frm_vendedor_email").disableValidation();
	$("#subt_depen_bene").hide();
	$("#5637859396697de7e3b2ed3058496123").hide();
  	$("#frm_num_exequial").hide();
    $("#frm_num_exequial").disableValidation();

}

$("#btn_emision_save").find("button").on("click", function () {
	$("#3382823306457c569d9a864093487913").saveForm();
	alert("Formulario guardado ...");
});


$("#7180710025fa41a3ccadfb4005520079").setOnSubmit(function () {
	
	//Encerar campos que no se ocuparon, pestaa "Informe Suscripcion"
	/*if ($("#grid_suscripcion").getValue(11, 2) != 'S') {
		$("#frm_suscripcion_medico").clear();
		$("#frm_suscripcion_medico").hide();
	}
	if ($("#grid_suscripcion").getValue(12, 2) != 'S') {
		$("#frm_suscripcion_informe_aprobacion").clear();
		$("#frm_suscripcion_informe_aprobacion").hide();
	}
	if ($("#grid_suscripcion").getValue(13, 2) != 'S') {
		$("#frm_suscripcion_orden").clear();
		$("#frm_suscripcion_orden").hide();
	}
	*/
	$("#7180710025fa41a3ccadfb4005520079").saveForm();	//debe ir despues de "Encerar campos"
	/*
	var bandera = true;
	var alert_1 = true;
	
	//Validar si lleno las especificaciones, "Revision de suscripcion"
	for (var f = 1; f <= $("#grid_suscripcion").getNumberRows(); f++) {

		var respuesta = $("#grid_suscripcion").getValue(f, 2);
		var especifique = jQuery("#grid_suscripcion").getControl(f, 3).val().trim();

		if (respuesta == 'N' && especifique == '') {
			bandera = false;
			alert_1 = false;
		}
		
	}
	
	if (alert_1 == false) {
		alert('Falta ingresar informacion en GRILLA: ' + jQuery("#grid_suscripcion").getLabel() + ', COLUMNA :' + jQuery("#grid_suscripcion").getLabel(3));
	}
	
	
	//Validar si lleno las especificaciones, "Seccion regularizacion"
	var alert_2 = true;
	
	for (var f = 1; f <= $("#grid_regularizacion").getNumberRows(); f++) {

		var respuesta = $("#grid_regularizacion").getValue(f, 2);
		var especifique = jQuery("#grid_regularizacion").getControl(f, 3).val().trim();

		if (respuesta == 'S' && especifique == '') {
			bandera = false;
			alert_2 = false;
		}
		
	}
	
	if (alert_2 == false) {
		alert('Falta ingresar informacion en GRILLA: ' + jQuery("#grid_regularizacion").getLabel() + ', COLUMNA :' + jQuery("#grid_regularizacion").getLabel(3));
	}
	
	// Validar que el porcentaje sea igual a 100%
	if ($("#frm_agente_suma").getValue() != 100) {
		alert('La suma de los porcentajes en la grilla Agentes debe ser igual a 100');
		bandera = false;
	}
	*/
	console.log("bandera: " + bandera);
	return true;

});

function acciones() {
	var accion = $("#frm_accion").getControl().val();
	//alert (accion);
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
	}
	else {
		if (accion == 'CONTINUAR') {
			$("#fle_poliza").show();
			$("#fle_endosos").show();
			//$("#fle_poliza").disableValidation();
			$("#fle_endosos").disableValidation();
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

      $("#grid_dental").disableValidation(1);
      $("#grid_dental").disableValidation(2);
      $("#grid_dental").disableValidation(3);
      $("#grid_dental").disableValidation(4);
      $("#grid_dental").disableValidation(5);
      $("#grid_dental").disableValidation(6);
      $("#grid_dental").disableValidation(7);
      $("#grid_dental").disableValidation(8);
      $("#grid_dental").disableValidation(9);
      $("#grid_dental").disableValidation(10);
      $("#grid_dental").disableValidation(11);
      $("#grid_dental").disableValidation(12);
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
      $("#grid_seguro_exequial").disableValidation(6);
      $("#grid_seguro_exequial").disableValidation(7);
      $("#grid_seguro_exequial").disableValidation(8);
      $("#grid_seguro_exequial").disableValidation(9);
      $("#grid_seguro_exequial").disableValidation(10);
      $("#grid_seguro_exequial").disableValidation(11);
      $("#grid_seguro_exequial").disableValidation(12);
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

function ocultarInfoDependietes() {
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
	$("#frm_tipo_plan_dental").disableValidation();
	$("#tri_bandera_dental").disableValidation();
	$("#tri_bandera_exquial").disableValidation();
	$("#frm_plan_total_beneficiarios").disableValidation();
	$("#frm_plan_total_beneficiarios_contingentes").disableValidation();

	$("#grid_beneficiarios_contingentes").disableValidation(1);
	$("#grid_beneficiarios_contingentes").disableValidation(2);
	$("#grid_beneficiarios_contingentes").disableValidation(3);
	$("#grid_beneficiarios_contingentes").disableValidation(4);
	$("#grid_beneficiarios_contingentes").disableValidation(5);
	$("#grid_beneficiarios_contingentes").disableValidation(6);
	$("#grid_beneficiarios_contingentes").disableValidation(7);
	$("#grid_beneficiarios_contingentes").disableValidation(8);
	$("#grid_beneficiarios_contingentes").disableValidation(9);
	$("#grid_beneficiarios_contingentes").disableValidation(10);
	$("#grid_beneficiarios_contingentes").disableValidation(11);

	$("#grd_beneficiario").disableValidation(1);
	$("#grd_beneficiario").disableValidation(2);
	$("#grd_beneficiario").disableValidation(3);
	$("#grd_beneficiario").disableValidation(4);
	$("#grd_beneficiario").disableValidation(5);
	$("#grd_beneficiario").disableValidation(6);
	$("#grd_beneficiario").disableValidation(7);
	$("#grd_beneficiario").disableValidation(8);
	$("#grd_beneficiario").disableValidation(9);
	$("#grd_beneficiario").disableValidation(10);
	$("#grd_beneficiario").disableValidation(11);
}

ocultarDentalExequial();
ocultarInfoDependietes();




