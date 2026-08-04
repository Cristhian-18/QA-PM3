//created by Henry
//$("#361044504624e0b4c74a4c2046528217").hide();
$("#frm_sbt_medico").hide();
$("#1065908656256d3f6ddeb65015003083").hide();
$("#frm_fecha_diagnostico").disableValidation();
$("#frm_diagnostico_medico").disableValidation();
$("#frm_antecedentes_medico").disableValidation();
$("#frm_motivo_medica").disableValidation();
$("#frm_resumen_medico").disableValidation();
//$("#frm_comentario").setValue('');
$("#frm_accion").setValue('');
$("#subtitle-negativa").hide();
$("#lbl_antecdentes").hide();
$("#frm_negativa_antecedentes").hide();
$("#lbl_ley").hide();
$("#frm_negativa_ley").hide();
$("#frm_negativa_ley_1").hide();
$("#lbl_resolucion").hide();
$("#frm_negativa_nota").hide();

/*tinymce.init({
  selector: 'textarea',
  language: 'es'
});
*/


if($("#tri_bandera_analista").getValue() == 'true'){
	$("#frm_sbt_medico").show()
	$("#1065908656256d3f6ddeb65015003083").show()
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
  
  $("#frm_monto_liquidar").enableValidation();
  $("#frm_causa_espera").hide();
  $("#tri_user_auditor").hide();
  $("#frm_razon_negativa").hide();
  $("#frm_auditores_medicos").hide();
  $("#chk_docs_faltantes").hide();
  $("#fle_negativa").hide();
  $("#frm_accion").getControl().val();
  var x = document.getElementById("frm_comentario");
  $("#frm_negativa_asunto").hide();
  $("#frm_negativa_dirigido").hide();
  $("#tri_bandera_cliente").setValue('');
  
  if(newValue == 'MEDICO'){
    $("#frm_auditores_medicos").show();
  }
  
   if(newValue == 'REASIGNAR'){
    $("#tri_user_auditor").show();
  }
  
  if(newValue == 'DEVOLVER'){
    $("#tri_bandera_cliente").setValue('true');
  }
 
   if(newValue == 'NEGAR' || newValue == 'NO_PROCEDER'){
    $("#frm_razon_negativa").show();
     $("#fle_negativa").show();
     $("#frm_negativa_asunto").show();
     $("#frm_negativa_dirigido").show();
     if($("#tri_bandera_parcial").getValue() == 'true' || $("#tri_bandera_alcance").getValue() == 'ALCANCE'){
       alert("Por favor realice la gestion de baja en SISE");
     }else{
       $("#frm_monto_liquidar").setValue('0');
       $("#frm_monto_liquidar").disableValidation();
     }
     if(newValue == 'NEGAR'){
       $("#subtitle-negativa").show();
       $("#lbl_antecdentes").show();
       $("#frm_negativa_antecedentes").show();
       $("#lbl_ley").show();
       $("#frm_negativa_ley").show();
       $("#frm_negativa_ley_1").show();
       $("#frm_negativa_nota").show();
       $("#lbl_resolucion").show();
       $("#frm_comentario").setLabel('RESOLUCION');
     // x.innerHTML = '<div class="row"><div class="col-md-2" style="text-align:end"><label>RESOLUCION</label></div><div class="col-md-10"><textarea id="form[frm_comentario]" name="form[frm_comentario]" class="pmdynaform-control-textarea form-control" rows="5" value="" placeholder="" style="box-shadow: none;"></textarea></div></div>';
    }else{
      $("#subtitle-negativa").hide();
      $("#lbl_antecdentes").hide();
       $("#frm_negativa_antecedentes").hide();
       $("#lbl_ley").hide();
       $("#frm_negativa_ley").hide();
      $("#frm_negativa_ley_1").hide();
       $("#frm_negativa_nota").hide();
       $("#lbl_resolucion").hide();
        $("#frm_comentario").setLabel('Observaciones');
     // x.innerHTML = '<div class="row"><div class="col-md-2" style="text-align:end"><label>Observacion</label></div><div class="col-md-10"><textarea id="form[frm_comentario]" name="form[frm_comentario]" class="pmdynaform-control-textarea form-control" rows="5" value="" placeholder="" style="box-shadow: none;"></textarea></div></div>';
    }
   }
  
  if(newValue == 'APROBAR'){
    if($("#grd_coberturas").getSummary(12) != 0)
       $("#frm_monto_liquidar").setValue($("#grd_coberturas").getSummary(12));
    else
      $("#frm_monto_liquidar").setValue($("#grd_coberturas").getSummary(11));
   }     
   
   if(newValue == 'MANTENER'){
	//$("#frm_causa_espera").show();
   }
  
  if(newValue == 'DOCUMENTAR'){
	  $("#chk_docs_faltantes").show();
    $("#frm_monto_liquidar").disableValidation();
    $("#frm_comentario").setLabel('Mensaje para enviar al cliente');
   }
}
accion();
$("#frm_accion").setOnchange(accion);


function dirigido(newValue, oldValue) {  
  $("#frm_negativa_dirigido").show();
  if(newValue == 'OTRO'){
    $("#frm_negativa_dirigido").setValue('');
  }
  if(newValue == 'BROKER'){
    $("#frm_negativa_dirigido").setValue($("#frm_broker").getValue());
  }
  if(newValue == 'CONTRATANTE'){
    $("#frm_negativa_dirigido").setValue($("#frm_contratante").getValue());
  }
  if(newValue == 'ASEGURADO'){
    $("#frm_negativa_dirigido").setValue($("#frm_apellido_paterno").getValue()+' '+$("#frm_apellido_materno").getValue()+' '+$("#frm_nombres").getValue());
  }
}

dirigido();
$("#frm_negativa_asunto").setOnchange(dirigido);

$("#19704822661d89a84dc5eb6067966042").setOnSubmit(function(){
    var totalReser = parseFloat($("#grd_coberturas").getSummary(12));
    if (totalReser == 0 && $("#grd_coberturas").getValue(1, 1) != '' ) {
        alert("Por favor ingrese un monto valido en el grid de Coberturas");
        return false; //stop submit action
    }
    else {
        return true;  //allow submit action
    }
} );