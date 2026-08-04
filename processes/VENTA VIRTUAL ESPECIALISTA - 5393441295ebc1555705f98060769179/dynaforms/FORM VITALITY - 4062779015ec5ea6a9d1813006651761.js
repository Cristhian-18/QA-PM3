

$('#5236057115ec5e364de7d10079797665').toggle();
$('#8289982305ec5e457199fd7088050775').toggle();
$('#7455655435ec5e04de42eb2043075382').toggle();

$("#1464965025e829ed50cfdc8090924667").setOnSubmit(function(){
	//return false;
	//alert( showConfirmDlg() );
	
	return showConfirmDlg();
	//validarPeso();
	//validarEstatura();  
	$("#1464965025e829ed50cfdc8090924667").saveForm() ;
});

$("#btn_declaracion_save").find("button").on("click" , function() {
	//validarPeso();
	//validarEstatura();
	$("#1464965025e829ed50cfdc8090924667").saveForm();
	alert ("Formulario guardado ...");  
});


/*
$("#frm_declaracion_peso").on( "focusout", function() {
	validarPeso();
});

$("#frm_declaracion_estatura").on( "focusout", function() {
	validarEstatura();
});
*/

/*
alert($("#frm_monto").getValue());
alert($("#frm_trabajo_expuesta_politicamente").getValue());
alert($("#frm_plan_tipo_identificacion").getValue());
*/

//Para sumas aseguradas mayores a $50.000: 
//Confirmacion de pago del Impuesto a la Renta del año inmediato anterior 
//(se permite impresiones del portal web del SRI)
if($("#frm_monto").getValue() < 50000){
	$("#frm_aclaraciones_sumas_aseguradas").hide();
	$("#frm_aclaraciones_file_sumas_aseguradas").hide();	
}

if($("#frm_trabajo_expuesta_politicamente").getValue() == 'N'){
	$("#frm_aclaraciones_file_pep").hide();
}

if($("#frm_plan_tipo_identificacion").getValue() != 'C'){
	$("#frm_aclaraciones_file_sol_natural").hide();
}

if($("#frm_plan_tipo_identificacion").getValue() != 'R'){
	$("#frm_aclaraciones_file_sol_juridico").hide();
}

$("#frm_misma_cuenta_vitality").change(function () {
    mismacuentavitality();
});

function mismacuentavitality() {
  if ($("#frm_misma_cuenta_vitality option:selected").val() == 'CTAVITALITY') {
        $("#frm_devolucion_titular").setValue( $("#frm_vitality_titular").getValue() );
        $("#frm_devolucion_tipo_cuenta").setValue( $("#frm_vitality_tipo_cuenta").getValue() );
     	$("#frm_devolucion_banco").setValue( $("#frm_vitality_banco").getValue() );
        $("#frm_devolucion_numero_cuenta").setValue( $("#frm_vitality_numero_cuenta").getValue() );
     	$("#frm_devolucion_tipo_identificacion").setValue( $("#frm_vitality_tipo_identificacion").getValue() );
        $("#frm_devolucion_identificacion").setValue( $("#frm_vitality_identificacion").getValue() );

    }
    else {
      $("#frm_devolucion_titular").setValue('');
      
      $("#frm_devolucion_tipo_cuenta").setValue( '');
      $("#frm_devolucion_banco").setValue('');
      $("#frm_devolucion_numero_cuenta").setValue('');
      $("#frm_devolucion_tipo_identificacion").setValue('');
      $("#frm_devolucion_identificacion").setValue('');
        
    }
}


