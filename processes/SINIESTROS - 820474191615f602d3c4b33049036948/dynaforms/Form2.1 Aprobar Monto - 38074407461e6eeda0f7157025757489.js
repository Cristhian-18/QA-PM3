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

  $("#frm_monto_aprobado").show();
  $("#frm_monto_aprobado").disableValidation();
  $("#frm_monto_aprobado").setValue($("#frm_monto_liquidar").getValue());
  
  if(newValue == 'APROBAR'){
    $("#frm_monto_aprobado").enableValidation();
    $("#frm_monto_aprobado").setValue($("#grd_coberturas").getSummary(12));
  }
}
accion();
$("#frm_accion").setOnchange(accion);