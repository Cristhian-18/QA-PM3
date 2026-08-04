

$("#9445281465ec5e92ef2bd88072579424").setOnSubmit(function(){
	//return false;
	//alert( showConfirmDlg() );
	
	return showConfirmDlg();
	//validarPeso();
	//validarEstatura();  
	$("#9445281465ec5e92ef2bd88072579424").saveForm() ;
});

$("#btn_declaracion_save").find("button").on("click" , function() {
	//validarPeso();
	//validarEstatura();
	$("#9445281465ec5e92ef2bd88072579424").saveForm();
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
