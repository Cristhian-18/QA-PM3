validarOblogatorios();

function validarOblogatorios(){
	//Pasaporte
if ($("#frm_tipo_identificacion").getValue() == 'P') {
        $("#frm_aclaraciones_file_visa").parent().parent().show("slow");
        jQuery("#frm_aclaraciones_file_visa").enableValidation();
		$("#frm_aclaraciones_file_pasaporte").parent().parent().show("slow");
        jQuery("#frm_aclaraciones_file_pasaporte").enableValidation();
    }
    else {
        $("#frm_aclaraciones_file_visa").parent().parent().hide("slow");
        jQuery("#frm_aclaraciones_file_visa").disableValidation();
		$("#frm_aclaraciones_file_pasaporte").parent().parent().hide("slow");
        jQuery("#frm_aclaraciones_file_pasaporte").disableValidation();
}
//RUC
if ($("#frm_ocupacion_tipo_empleo").getValue() == 'INDEPENDIENTE') {
        $("#frm_aclaraciones_file_ruc").parent().parent().show("slow");
        jQuery("#frm_aclaraciones_file_ruc").enableValidation();
		
    }
    else {
        $("#frm_aclaraciones_file_ruc").parent().parent().hide("slow");
        jQuery("#frm_aclaraciones_file_ruc").disableValidation();
		
}
//Discapacidad
if ($("#frm_declaracion_a_discapacidad").getValue() == 'S') {
        $("#frm_aclaraciones_file_discapacidad").parent().parent().show("slow");
        jQuery("#frm_aclaraciones_file_discapacidad").enableValidation();
		
    }
    else {
        $("#frm_aclaraciones_file_discapacidad").parent().parent().hide("slow");
        jQuery("#frm_aclaraciones_file_discapacidad").disableValidation();
		
}
//PEP
if ($("#frm_trabajo_expuesta_politicamente").getValue() == 'S') {
        $("#frm_aclaraciones_file_pep").parent().parent().show("slow");
        jQuery("#frm_aclaraciones_file_pep").enableValidation();
		
    }
    else {
        $("#frm_aclaraciones_file_pep").parent().parent().hide("slow");
        jQuery("#frm_aclaraciones_file_pep").disableValidation();
		
}


//Conyugue
if ($("#frm_estado_civil").val() == 'Casado') {
        $("#frm_aclaraciones_file_copia_identidad_conyugue").parent().parent().show("slow");
        jQuery("#frm_aclaraciones_file_copia_identidad_conyugue").enableValidation();
		
    }
    else {
        $("#frm_aclaraciones_file_copia_identidad_conyugue").parent().parent().hide("slow");
        jQuery("#frm_aclaraciones_file_copia_identidad_conyugue").disableValidation();
		
}
}