//created by Henry

if($("#frm_asegurado_mail_1").getValue() == ''){
	$("#frm_asegurado_mail_1").setValue($("#frm_asegurado_mail").getValue());
}

if($("#frm_monto_reportado").getValue() == 0){
	$("#frm_monto_reportado").setValue($("#grd_coberturas").getSummary(11));
}

$("#frm_sbt_medico").hide();
$("#71422138261da327fe6a4d5053466166").hide();
$("#frm_fecha_diagnostico").disableValidation();
$("#frm_diagnostico_medico").disableValidation();
$("#frm_antecedentes_medico").disableValidation();
$("#frm_motivo_medica").disableValidation();
$("#frm_resumen_medico").disableValidation();
var monto = $("#frm_monto_liquidar").getValue()*1;

if($("#tri_bandera_analista").getValue() == 'true'){
	$("#frm_sbt_medico").show()
	$("#71422138261da327fe6a4d5053466166").show()
}


function mensaje(){
  if($("#tri_message_update").getValue() != ''){
    window.dynaform.flashMessage( {
       duration : 8000,
       emphasisMessage: "ERROR: ",
       message:$("#tri_message_update").getValue(),
       type : 'danger',
       appendTo:$('#title0000000001')
    } )
  }
}

mensaje();

function accion(newValue, oldValue) {
  
  $("#fle_actaComite").disableValidation();
  $("#fle_actaComite").hide();
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
  if(newValue == 'APROBAR' && monto > 300000){
    $("#fle_actaComite").show();
    $("#fle_actaComite").enableValidation();
  }
  
}

accion();
$("#frm_accion").setOnchange(accion);