//Subform Check List Documentos
/*$("#grd_obligatorios").hideColumn(3);*/
//$("#grd_especificos").hideColumn(3);

$(".pmdynaform-grid-title").removeClass("pmdynaform-grid-title");
/*getFieldById("grd_especificos").$el.css("padding-bottom", "150px");*/



ocultar_todo();
$("#subtit_datos").show();
$("#25830987060590cf686aa76067215111").show();
$("#32832123863dc1b7ca05b77080881437").show();
$("#9477586566618b7d5e77c52053147688").show();


$('.menu').on('click', function () {
    ocultar_todo();
    switch (this.id) {
        case 'solicitud':
            $("#subtit_datos").show();

			//if($('#subtit_datos i').attr('class').indexOf("glyphicon-minus") > 0){
				$("#25830987060590cf686aa76067215111").show();
        		$("#32832123863dc1b7ca05b77080881437").show();
        		$("#9477586566618b7d5e77c52053147688").show();
			//}

            break;

        case 'documentos':
            $("#subtit_docs").show();
			
			//if($('#subtit_docs i').attr('class').indexOf("glyphicon-minus") > 0){
				$("#7232410255f4510e7ddb431040314312").show();
				$("#4134920295f9c8c87b37d96033269232").show();
        		$("#4240566656458731d63f9a5040971812").show();
			//}
			
            break;
			
        case 'suscripcion':
            $("#subtit_revision").show();
			
			//if($('#subtit_revision i').attr('class').indexOf("glyphicon-minus") > 0){
				$("#229276312609ac831a49570036001066").show();
				//$("#897660916609f1c71cba367023383689").show();
			//}
        if($("#tri_bandera_magnum").getValue() == 'true'){
          $("#subtit_datos").show();
          $("#26770765663c55d39d9a8d3040722455").show();
         }else{
          $("#subtit_datos").hide();
          $("#26770765663c55d39d9a8d3040722455").hide();
         }
			
            break;

        case 'historial':
            $("#subtit_cambios").show();
            $("#subtit_commen").show();

            $("#frm_accion").show();
            $("#frm_comentario").show();
			
			//if($('#ifrm_sbt_commen i').attr('class').indexOf("glyphicon-minus") > 0){
				$("#3659092825f484ded40e690037283996").show();
			//}		
			
			//if($('#ifrm_sbt_acc i').attr('class').indexOf("glyphicon-minus") > 0){
				$("#9458715575fa435e25efcc4029990032").show();
        		$("#subtit_datos").hide();
				$("#26770765663c55d39d9a8d3040722455").hide();
        
        	$("#btn_emision_save").show();
  			$("#btn_continuar").show();
			//}
            break;
    }
});


function ocultar_todo() {
    $("#subtit_commen").hide();
    $("#3659092825f484ded40e690037283996").hide();
    $("#subtit_datos").hide();
  	$("#32832123863dc1b7ca05b77080881437").hide();
    $("#6479360225f976335c43157021199308").hide();
    $("#subtit_docs").hide();
    $("#7232410255f4510e7ddb431040314312").hide();
    $("#4134920295f9c8c87b37d96033269232").hide();
  	$("#4240566656458731d63f9a5040971812").hide();
    $("#subtit_cambios").hide();
    $("#subtit_sise").hide();
    $("#7322237105fa4354c1c5cc1002811158").hide();
    $("#frm_accion").hide();
    $("#frm_comentario").hide();

    $("#25830987060590cf686aa76067215111").hide();
    $("#9458715575fa435e25efcc4029990032").hide();
	
	$("#subtit_revision").hide();
	$("#229276312609ac831a49570036001066").hide();
	//$("#897660916609f1c71cba367023383689").hide();
  	$("#26770765663c55d39d9a8d3040722455").hide();
  
  $("#btn_emision_save").hide();
  $("#btn_continuar").hide();
	
  $("#9477586566618b7d5e77c52053147688").hide();
	
}

$("#btn_emision_save").find("button").on("click", function () {
  $("#7180710025fa41a3ccadfb4005520079").saveForm();
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
	
    return true;

});
