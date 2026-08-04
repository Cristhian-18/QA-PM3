$("#btn_declaracion_save").hide();

//$('#6806220925ecdb97edcd804036713362').toggle();
//$('#7309268585ecd73eeba6187092519255').toggle();
//$('#frm_infconf_observaciones,frm_infdec_ok').toggle();
//$('#pnl_dec').toggle();


$("#9089156865ecdbe60a4f240049416002").setOnSubmit(function(){
	//return false;
	//alert( showConfirmDlg() );
	
	return showConfirmDlg();
	//validarPeso();
	//validarEstatura();  
	$("#9089156865ecdbe60a4f240049416002").saveForm() ;
});

$("#btn_declaracion_save").find("button").on("click" , function() {
	//validarPeso();
	//validarEstatura();
	$("#9089156865ecdbe60a4f240049416002").saveForm();
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
//Confirmacion de pago del Impuesto a la Renta del ao inmediato anterior 
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
