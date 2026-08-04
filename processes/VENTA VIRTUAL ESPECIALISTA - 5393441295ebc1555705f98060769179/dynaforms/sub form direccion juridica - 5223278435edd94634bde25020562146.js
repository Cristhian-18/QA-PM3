if(typeof validarExpresionRegular === 'function') {
	validarExpresionRegular("frm_juridica_barrio", 2);
	validarExpresionRegular("frm_juridica_calle_principal", 2);
	validarExpresionRegular("frm_juridica_numero", 3);
	validarExpresionRegular("frm_juridica_calle_transversal", 2);
	validarExpresionRegular("frm_juridica_conjunto_edificio", 2);
	validarExpresionRegular("frm_juridica_departamento_casa", 2)
}

$(document).ready ( function(){
	
	$('#frm_canton_auxiliar').hide();
	if(typeof canton_2 === 'function') {
		canton_2(false, 'frm_juridica_provincia', 'frm_juridica_canton');
	}
});

$('#frm_juridica_provincia').on('change', function() {
	if(typeof canton_2 === 'function') {
		canton_2(true, 'frm_juridica_provincia', 'frm_juridica_canton');
	}	
});



