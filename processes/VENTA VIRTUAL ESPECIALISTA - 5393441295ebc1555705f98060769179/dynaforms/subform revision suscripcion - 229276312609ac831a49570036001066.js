// $("#frm_InfSus_pregunta_1 .textlabel").parent().parent().css("width", "70%");
// $("#frm_InfSus_pregunta_1 select").parent().css("width", "20%");
// $("#frm_InfSus_pregunta_1 .textlabel").parent().css("display", "inline");

$("#frm_suscripcion_medico_1").find("button").html("Seleccionar archivos");
$("#frm_suscripcion_orden_1").find("button").html("Seleccionar archivos");
$("#frm_suscripcion_informe_aprobacion_1").find("button").html("Seleccionar archivos");

$(function() {
    grid_columnaEspecifique();
    //calcular_imc();
});

function grid_columnaEspecifique() {
  $("#grid_suscripcion").hideColumn(3);

    if ($("#grid_suscripcion").getNumberRows() !== 0) {
        for (var f = 1; f <= $("#grid_suscripcion").getNumberRows(); f++) {

            var respuesta = $("#grid_suscripcion").getValue(f, 2);
			var especifique = jQuery("#grid_suscripcion").getControl(f, 3).val().trim();


            if (respuesta == 'N') {
                $("#grid_suscripcion").getControl(f, 3).attr("disabled", false);
				
				if (especifique != '') {
					$("#grid_suscripcion").getControl(f, 3).css("borderColor", "");
				} else {
					$("#grid_suscripcion").getControl(f, 3).css("borderColor", "red");
				}
				
            } else {
				
                $("#grid_suscripcion").getControl(f, 3).attr("disabled", true);
				
            }
			
			//files_hideShow(f, respuesta);

        }
    }

}

function files_hideShow(fila, respuesta){
	
	if (fila == 11){
		if (respuesta == 'S'){
			$("#frm_suscripcion_medico").show();
			$("#frm_suscripcion_medico").enableValidation();
		}else{
			$("#frm_suscripcion_medico").hide();
			$("#frm_suscripcion_medico").disableValidation();
		}
	}
	
	if (fila == 12){
		if (respuesta == 'S'){
			$("#frm_suscripcion_informe_aprobacion").show();
			$("#frm_suscripcion_informe_aprobacion").enableValidation();
		}else{
			$("#frm_suscripcion_informe_aprobacion").hide();
			$("#frm_suscripcion_informe_aprobacion").disableValidation();
		}
	}

	if (fila == 13){
		if (respuesta == 'S'){
			$("#frm_suscripcion_orden").show();
			$("#frm_suscripcion_orden").enableValidation();
		}else{
			$("#frm_suscripcion_orden").hide();
			$("#frm_suscripcion_orden").disableValidation();
		}
	}
	
}

$("#grid_suscripcion select").on('change', function () {

    var fila = $(this).attr("id").toString();
    fila = fila.replace('form[grid_suscripcion][', '');
    fila = fila.replace('][frm_suscripcion_respuesta]', '');

    var respuesta = $(this).val();
    if (respuesta == 'N') {
        //$("#grid_suscripcion").getControl(fila, 3).attr("disabled", false);
		//$("#grid_suscripcion").getControl(fila, 3).css("borderColor", "red");
    } else {
        $("#grid_suscripcion").getControl(fila, 3).attr("disabled", true);
		$("#grid_suscripcion").getControl(1, 3).css("borderColor", "");
    }

	$("#grid_suscripcion").setValue("",fila, 3);
    
	files_hideShow(fila, respuesta);

});

$("#grid_suscripcion .pmdynaform-edit-text").on('change', function () {

    var fila = $(this).attr("id").toString();
    fila = fila.replace('[grid_suscripcion][', '');
    fila = fila.replace('][frm_suscripcion_especifique]', '');

	var especifique = jQuery("#grid_suscripcion").getControl(fila, 3).val().trim();

    if (especifique != '') {
        $("#grid_suscripcion").getControl(fila, 3).css("borderColor", "");
    } else {
        $("#grid_suscripcion").getControl(fila, 3).css("borderColor", "red");
    }
	
	

});


if ($("#grid_suscripcion").getNumberRows() !== 0) {
	
	for (var f = 1; f <= $("#grid_suscripcion").getNumberRows(); f++) {

		if (f != 14 && f != 15) {
			//$("#form\\[grid_suscripcion\\]\\[" + f + "\\]\\[frm_suscripcion_respuesta\\] option[value='N/A']").remove();
		}
	}
}

//Precargar campo "Cotizacion acorde a condicion"
/*$("#frm_sexo").hide();
$("#frm_declaracion_h_combo").hide();

var sexo = $("#frm_sexo").getValue();
var declaracion_h_combo = $("#frm_declaracion_h_combo").getValue();
if (sexo == 'F' && declaracion_h_combo == 'S') {
   $("#frm_suscripcion_condicion").setValue("FEMENINO_FUMADOR");
} else if (sexo == 'F' && declaracion_h_combo == 'N') {
      $("#frm_suscripcion_condicion").setValue("FEMENINO_NO_FUMADOR");
} else if (sexo == 'M' && declaracion_h_combo == 'S') {
      $("#frm_suscripcion_condicion").setValue("MASCULINO_FUMADOR");
} else if (sexo == 'M' && declaracion_h_combo == 'N') {
      $("#frm_suscripcion_condicion").setValue("MASCULINO_NO_FUMADOR");
}

// Calcular el IMC
// IMC = frm_declaracion_peso / frm_declaracion_estatura
function calcular_imc() {

	var peso = $("#frm_declaracion_peso").getControl().val();
	var estatura = $("#frm_declaracion_estatura").getControl().val();

	var IMC = peso/ estatura;
	$("#frm_suscripcion_imc").setValue(IMC);

}

$("#frm_declaracion_peso, #frm_declaracion_estatura").change(function () {
	calcular_imc();
});
*/