if(typeof validarExpresionRegular === 'function') {
	validarExpresionRegular("frm_barrio", 2);
	//validarExpresionRegular("frm_calle_principal", 2);
	validarExpresionRegular("frm_numero", 3);
//	validarExpresionRegular("frm_calle_transversal", 2);
	//validarExpresionRegular("frm_conjunto_edificio", 2);
	//validarExpresionRegular("frm_departamento_casa", 2)
}

function domicilio_val(newVal, oldVal){
	if(newVal != '56' && newVal != ''){
  	$('#frm_provincia').disableValidation();
    $('#frm_canton').disableValidation();
    $('#frm_provincia').hide();
    $('#frm_canton').hide();
    $('#frm_provincia_auxiliar').show();
    $('#frm_canton_auxiliar').show();
  }else{
    $('#frm_provincia').enableValidation();
    $('#frm_canton').enableValidation();
    $('#frm_provincia').show();
    $('#frm_canton').show();  
    $('#frm_provincia_auxiliar').hide();
    $('#frm_canton_auxiliar').hide();
  }
}

$(document).ready ( function(){
	
	//$('#frm_canton_auxiliar').hide();
	if(typeof canton_2 === 'function') {
		canton_2(false, 'frm_provincia', 'frm_canton');
	}
  domicilio_val($("#frm_pais").getValue(), 0);
});

$('#frm_provincia').on('change', function() {
	if(typeof canton_2 === 'function') {
		canton_2(true, 'frm_provincia', 'frm_canton');
	}
});


$("#frm_convencional").hide();
$('#frm_convencional').disableValidation();
$('#frm_pais').setOnchange(domicilio_val);