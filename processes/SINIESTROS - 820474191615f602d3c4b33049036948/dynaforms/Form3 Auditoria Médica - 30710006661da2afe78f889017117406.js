$("#frm_monto_liquidar").disableValidation();

if($("#frm_asegurado_mail_1").getValue() == ''){
	$("#frm_asegurado_mail_1").setValue($("#frm_asegurado_mail").getValue());
}