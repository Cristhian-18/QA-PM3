//created by Henry

if($("#frm_asegurado_mail_1").getValue() == ''){
	$("#frm_asegurado_mail_1").setValue($("#frm_asegurado_mail").getValue());
}

$("#frm_sbt_medico").hide();
$("#71422138261da327fe6a4d5053466166").hide();
$("#frm_fecha_diagnostico").disableValidation();
$("#frm_diagnostico_medico").disableValidation();
$("#frm_antecedentes_medico").disableValidation();
$("#frm_motivo_medica").disableValidation();
$("#frm_resumen_medico").disableValidation();

if($("#tri_bandera_analista").getValue() == 'true'){
	$("#frm_sbt_medico").show()
	$("#71422138261da327fe6a4d5053466166").show()
}


/*function accion(newValue, oldValue) {
  
  $("#tri_user_pda").hide();
  $("#tri_user_auditor").hide();
  $("#fle_negativa").hide();
  
  if(newValue == 'REASIGNAR_PDA'){
    $("#tri_user_pda").show();
  }
  if(newValue == 'NEGAR'){
    $("#fle_negativa").show();
  }
  if(newValue == 'REASIGNAR'){
    $("#tri_user_auditor").show();
    $("#frm_monto_liquidar").disableValidation();
  }
  
}

accion();
$("#frm_accion").setOnchange(accion);
*/