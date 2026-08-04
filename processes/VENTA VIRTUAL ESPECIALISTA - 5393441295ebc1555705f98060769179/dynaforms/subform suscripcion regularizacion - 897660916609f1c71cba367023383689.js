grid_col_especifique();

function grid_col_especifique() {

    if ($("#grid_regularizacion").getNumberRows() !== 0) {
        for (var f = 1; f <= $("#grid_regularizacion").getNumberRows(); f++) {

            var respuesta = $("#grid_regularizacion").getValue(f, 2);
			var especifique = jQuery("#grid_regularizacion").getControl(f, 3).val().trim();
			
            if (respuesta == 'S') {
                $("#grid_regularizacion").getControl(f, 3).attr("disabled", false);

				if (especifique != '') {
					$("#grid_regularizacion").getControl(f, 3).css("borderColor", "");
				} else {
					$("#grid_regularizacion").getControl(f, 3).css("borderColor", "red");
				}
	
            } else {
				
                $("#grid_regularizacion").getControl(f, 3).attr("disabled", true);
				
            }
			
			files_hideShow_2(f, respuesta);
			
        }
    }

}

function files_hideShow_2(fila, respuesta){
	
	if (fila == 3){
		if (respuesta == 'S'){
			$("#grd_obligatorios_incorrectos").show();
			$("#grd_especificos_incorrectos").show();
			$("#frm_opcionales").show();
			jQuery("#grd_obligatorios_incorrectos").enableValidation(2);
			jQuery("#grd_especificos_incorrectos").enableValidation(2);
		}else{
			$("#grd_obligatorios_incorrectos").hide();
			$("#grd_especificos_incorrectos").hide();
			$("#frm_opcionales").hide();
			jQuery("#grd_obligatorios_incorrectos").disableValidation(2);
			jQuery("#grd_especificos_incorrectos").disableValidation(2);
		}
	}
	
}


$("#grid_regularizacion select").on('change', function () {

    var fila = $(this).attr("id").toString();
    fila = fila.replace('form[grid_regularizacion][', '');
    fila = fila.replace('][frm_regularizacion_respuesta]', '');
// alert(fila);
    var respuesta = $(this).val();
    if (respuesta == 'S') {
        $("#grid_regularizacion").getControl(fila, 3).attr("disabled", false);
		$("#grid_regularizacion").getControl(fila, 3).css("borderColor", "red");
    } else {
        $("#grid_regularizacion").getControl(fila, 3).attr("disabled", true);
		$("#grid_regularizacion").getControl(fila, 3).css("borderColor", "");
    }

    $("#grid_regularizacion").setValue("",fila, 3);
	
	files_hideShow_2(fila, respuesta);

});

$("#grid_regularizacion .pmdynaform-edit-text").on('change', function () {

    var fila = $(this).attr("id").toString();
    fila = fila.replace('[grid_regularizacion][', '');
    fila = fila.replace('][frm_regularizacion_especifique]', '');

	var especifique = jQuery("#grid_regularizacion").getControl(fila, 3).val().trim();

    if (especifique != '') {
        $("#grid_regularizacion").getControl(fila, 3).css("borderColor", "");
    } else {
        $("#grid_regularizacion").getControl(fila, 3).css("borderColor", "red");
    }
	
	

});


$("#grd_agente .pmdynaform-edit-text").on('change', function () {
	
	var suma = 0;
	
    if ($("#grd_agente").getNumberRows() !== 0) {
        for (var f = 1; f <= $("#grd_agente").getNumberRows(); f++) {
			
			var porcentaje = $("#grd_agente").getControl(f, 3).val().trim();
			
			if (!isNaN(porcentaje)) {
				suma += porcentaje*1;
			}

			
			// alert(1111111);
			
        }
		
		$("#frm_agente_suma").setValue(suma);
		
    }
	
    // var fila = $(this).attr("id").toString();
    // fila = fila.replace('[grid_regularizacion][', '');
    // fila = fila.replace('][frm_regularizacion_especifique]', '');

	// var especifique = jQuery("#grid_regularizacion").getControl(fila, 3).val().trim();

    // if (especifique != '') {
        // $("#grid_regularizacion").getControl(fila, 3).css("borderColor", "");
    // } else {
        // $("#grid_regularizacion").getControl(fila, 3).css("borderColor", "red");
    // }
	
	

});














