//created by Henry

$("#frm_sbt_medico").hide()
$("#71422138261da327fe6a4d5053466166").hide()
$("#frm_fecha_diagnostico").disableValidation()
$("#frm_diagnostico_medico").disableValidation()
$("#frm_antecedentes_medico").disableValidation()
$("#frm_motivo_medica").disableValidation()
$("#frm_resumen_medico").disableValidation()

if($("#tri_bandera_analista").getValue() == 'true'){
	$("#frm_sbt_medico").show();
	$("#71422138261da327fe6a4d5053466166").show();
}


function accion(newValue, oldValue) {

  $("#frm_causa_espera").hide();
   
   if(newValue == 'MANTENER'){
	$("#frm_causa_espera").show();
   }
  
  if(newValue == 'ADJUNTAR'){
   	$("#frm_comentario").setLabel('Mensaje para enviar a cliente'); 
   }else{
   	$("#frm_comentario").setLabel('Observaciones'); 
   }
  
  
}
accion();
$("#frm_accion").setOnchange(accion);


$("#chk_docs_faltantes").hide();

if($("#tri_bandera_docs").getValue() == 'true')
  $("#chk_docs_faltantes").show();