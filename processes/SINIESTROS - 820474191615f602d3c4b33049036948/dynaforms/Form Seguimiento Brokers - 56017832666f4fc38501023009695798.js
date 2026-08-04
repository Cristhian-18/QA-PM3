//created by Henry

$("#frm_sbt_medico").hide();
$("#71422138261da327fe6a4d5053466166").hide();
$("#frm_fecha_diagnostico").disableValidation();
$("#frm_diagnostico").disableValidation();
$("#frm_antecedentes_medico").disableValidation();
$("#frm_motivo_medica").disableValidation();
$("#frm_resumen_medico").disableValidation();

if($("#tri_bandera_analista").getValue() == 'true'){
	$("#frm_sbt_medico").show()
	$("#71422138261da327fe6a4d5053466166").show()
}


function accion(newValue, oldValue) {

  $("#frm_causa_espera").hide();
  $("#frm_auditores_tecnicos").hide();
  $("#frm_razon_negativa").hide();
  $("#frm_auditores_medicos").hide();
  
  if(newValue == 'MEDICO'){
    $("#frm_auditores_medicos").show();
  }
  
   if(newValue == 'REASIGNAR'){
    $("#frm_auditores_tecnicos").show();
  }
 
   if(newValue == 'NEGAR'){
    $("#frm_razon_negativa").show();
   }
   
   if(newValue == 'MANTENER'){
	$("#frm_causa_espera").show();
   }
}
accion();
$("#frm_accion").setOnchange(accion);