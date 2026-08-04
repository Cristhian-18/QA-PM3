//created by Henry
//$("#361044504624e0b4c74a4c2046528217").hide();

//*************************
//$(document).ready(function() {
// Seleccionar todos los campos cuyo ID comienza con 'frm' y deshabilitar la validacion
  //$("[id^='frm']").each(function() {
    //$(this).disableValidation();
//});
//});
//**************************.prop("disabled", true); 
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
$("#frm_negativa_dirigido_1").show();
$("#frm_negativa_email_1").hide();
$("#frm_negativa_email_2").hide();
$("#frm_negativa_email_3").hide();
$("#frm_falta_documentos_dirigido").hide();
$("#frm_falta_documentos_dirigido").disableValidation();

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
  $("#frm_comentario").setValue("");
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
  $("#frm_negativa_asunto").disableValidation();
  $("#frm_negativa_asunto_2").hide();
  $("#frm_negativa_asunto_3").hide();
  $("#frm_negativa_dirigido_1").hide();
  $("#frm_negativa_dirigido_2").hide();
  $("#frm_negativa_dirigido_3").hide();
  $("#frm_negativa_email_1").hide();
  $("#frm_negativa_email_2").hide();
  $("#frm_negativa_email_3").hide();
  $("#tri_bandera_cliente").setValue('');
  $("#frm_falta_documentos_dirigido").hide();
$("#frm_falta_documentos_dirigido").disableValidation();
  
  if(newValue == 'MEDICO'){
    closeDataNegar();
    $("#frm_comentario").setLabel('Observaciones');
    $("#frm_negativa_dirigido_1").hide();
    $("#frm_auditores_medicos").show();
    
  }
  
   if(newValue == 'REASIGNAR'){
    closeDataNegar();
    $("#frm_comentario").setLabel('Observaciones');
     $("#frm_negativa_dirigido_1").hide();
    $("#tri_user_auditor").show();
     
  }
  
  if(newValue == 'SOLICITAR' || newValue == 'DESBLOQUEAR' || newValue == 'GENERAR' ){
    closeDataNegar();
    $("#frm_comentario").setLabel('Observaciones');
    $("#frm_negativa_dirigido_1").hide();
  }
  
  if(newValue == 'DEVOLVER'){
    closeDataNegar();
    $("#frm_comentario").setLabel('Observaciones');
    $("#frm_negativa_dirigido_1").hide();
    $("#tri_bandera_cliente").setValue('true');
    
  }
 
   if(newValue == 'NEGAR' || newValue == 'NO_PROCEDER'){
   
     $("#frm_razon_negativa").show();
     $("#fle_negativa").show();
     $("#frm_negativa_asunto").show();
     $("#frm_negativa_asunto").enableValidation();
     $("#frm_negativa_dirigido_1").show();
     //$("#frm_negativa_asunto_2").show();
     //$("#frm_negativa_asunto_3").show();
     //$("#frm_negativa_dirigido_2").show();
     //$("#frm_negativa_dirigido_3").show();
     
     if($("#tri_bandera_parcial").getValue() == 'true' || $("#tri_bandera_alcance").getValue() == 'ALCANCE'){
       alert("Por favor realice la gestion de baja en SISE");
     }else{
       $("#frm_monto_liquidar").setValue('0');
       $("#frm_monto_liquidar").disableValidation();
     }
     if(newValue == 'NEGAR'){
     $("#frm_negativa_asunto_2").show();
     $("#frm_negativa_asunto_3").show();
     $("#frm_negativa_dirigido_2").show();
     $("#frm_negativa_dirigido_3").show();
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
      closeDataNegar();
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
    closeDataNegar();
    $("#frm_negativa_dirigido_1").hide();
    $("#frm_comentario").setLabel('Observaciones');
    if($("#grd_coberturas").getSummary(12) != 0)
       $("#frm_monto_liquidar").setValue($("#grd_coberturas").getSummary(12));
    else
      $("#frm_monto_liquidar").setValue($("#grd_coberturas").getSummary(11));
   }     
   
   if(newValue == 'MANTENER'){
     closeDataNegar();
    $("#frm_comentario").setLabel('Observaciones');
     $("#frm_negativa_dirigido_1").hide();
	$("#frm_causa_espera").show();
     
   }
  
  if(newValue == 'DOCUMENTAR'){
	$("#chk_docs_faltantes").show();
    $("#frm_monto_liquidar").disableValidation();
    closeDataNegar();
    //$("#frm_negativa_asunto").show();
    //$("#frm_negativa_asunto").enableValidation();
    $("#frm_falta_documentos_dirigido").show();
    $("#frm_falta_documentos_dirigido").enableValidation();
    $("#frm_comentario").setLabel('Mensaje para enviar al cliente');
    
   }
}
accion();
$("#frm_accion").setOnchange(accion);
$("#chk_docs_faltantes").setOnchange(function(newV, oldV){
  let def_mensaje = "Se requiere historia clinica completa; examenes complementarios, certificado de discapacidad, indice de karnoski";

  if($("#frm_accion").getValue() == "DOCUMENTAR"){
  
    // Verificar si el numero 40 esta en el array
    if (newV.includes("40")) {
      
      $("#frm_comentario").setValue(def_mensaje);
    } else {
      $("#frm_comentario").setValue('');
    }
  
  }
});

function dirigido(newValue, oldValue, id) {  
  
  $(id).show();
  if(newValue == 'OTRO'){
    $(id).setValue('');
  }
  if(newValue == 'BROKER'){
    $(id).setValue($("#frm_broker").getValue());
  }
  if(newValue == 'CONTRATANTE'){
    $(id).setValue($("#frm_contratante").getValue());
  }
  if(newValue == 'ASEGURADO'){
    $(id).setValue($("#frm_apellido_paterno").getValue()+' '+$("#frm_apellido_materno").getValue()+' '+$("#frm_nombres").getValue());
  }
}

dirigido();
$("#frm_negativa_asunto").setOnchange(function(newV, oldV){
  var datoSelect = $("#frm_negativa_asunto").getText();
  if (datoSelect == "CONTRATANTE"){
    $("#frm_negativa_email_1").setValue('');
    $("#frm_negativa_email_1").setLabel("Email Contratante");
    //$("#frm_negativa_email_1").removeAttr("disabled");
    $("#frm_negativa_email_1").show();
  } else if (datoSelect == "ADICIONAL"){
    var emailOtro = $("#frm_asegurado_mailAdicional").getValue();
    $("#frm_negativa_email_1").setLabel("Email Adicional");
    $("#frm_negativa_email_1").setValue(emailOtro);
    //$("#frm_negativa_email_1").removeAttr("disabled");
    $("#frm_negativa_email_1").hide();
  } else if (datoSelect == "BROKER"){
    var emailBroker = $("#frm_asegurado_mail").getValue();
    $("#frm_negativa_email_1").setLabel("Email Broker");
    $("#frm_negativa_email_1").setValue(emailBroker);
    //$("#frm_negativa_email_1").hide();
	//$("#frm_negativa_email_1").prop("disabled", true);       
    $("#frm_negativa_email_1").show();
  } else if (datoSelect == "ASEGURADO"){
    var emailAsegurado = $("#frm_asegurado_mail_1").getValue();
    $("#frm_negativa_email_1").setLabel("Email Asegurado");
    $("#frm_negativa_email_1").setValue(emailAsegurado);
    //$("#frm_negativa_email_1").attr("disabled", "");
    //$("#frm_negativa_email_1").hide();         
    $("#frm_negativa_email_1").show();         
  } else {
    $("#frm_negativa_email_1").setValue('');
    $("#frm_negativa_dirigido_1").setValue('');
    $("#frm_negativa_email_1").setLabel("Email");
    $("#frm_negativa_email_1").hide();
    //$("#frm_negativa_email_1").removeAttr("disabled");
  }
  //dirigido(newV,oldV,"#frm_negativa_dirigido_1");
  //dirigido(newV,oldV,"#frm_negativa_dirigido_2")
  //dirigido(newV,oldV,"#frm_negativa_dirigido_3");
});

$("#frm_negativa_asunto_2").setOnchange(function(newV, oldV){
  var datoSelect2 = $("#frm_negativa_asunto_2").getText();
  if (datoSelect2 == "CONTRATANTE"){
    $("#frm_negativa_email_2").setValue('');
    $("#frm_negativa_email_2").setLabel("Email Contratante");
    $("#frm_negativa_email_2").show();
  } else if (datoSelect2 == "ADICIONAL"){
    var emailOtro = $("#frm_asegurado_mailAdicional").getValue();
    $("#frm_negativa_email_2").setLabel("Email Adicional");
    $("#frm_negativa_email_2").setValue(emailOtro);
    //$("#frm_negativa_email_2").hide();
    $("#frm_negativa_email_2").show();
  } else if (datoSelect2 == "BROKER"){
    var emailBroker = $("#frm_asegurado_mail").getValue();
    $("#frm_negativa_email_2").setLabel("Email Broker");
    $("#frm_negativa_email_2").setValue(emailBroker);
    $("#frm_negativa_email_2").hide();       
  } else if (datoSelect2 == "ASEGURADO"){
    var emailAsegurado = $("#frm_asegurado_mail_1").getValue();
    $("#frm_negativa_email_2").setLabel("Email Asegurado");
    $("#frm_negativa_email_2").setValue(emailAsegurado);
    //$("#frm_negativa_email_2").hide();        
    $("#frm_negativa_email_2").show();        
  } else {
    $("#frm_negativa_email_2").setValue('');
    $("#frm_negativa_dirigido_2").setValue('');
    $("#frm_negativa_email_2").setLabel("Email");
    $("#frm_negativa_email_2").hide();
  }
  //dirigido(newV,oldV,"#frm_negativa_dirigido_1");
  //dirigido(newV,oldV,"#frm_negativa_dirigido_2")
  //dirigido(newV,oldV,"#frm_negativa_dirigido_3");
});

$("#frm_negativa_asunto_3").setOnchange(function(newV, oldV){
  var datoSelect3 = $("#frm_negativa_asunto_3").getText();
  if (datoSelect3 == "CONTRATANTE"){
    $("#frm_negativa_email_3").setValue('');
    $("#frm_negativa_email_3").setLabel("Email Contratante");
    $("#frm_negativa_email_3").show();
  } else if (datoSelect3 == "ADICIONAL"){
    var emailOtro = $("#frm_asegurado_mailAdicional").getValue();
    $("#frm_negativa_email_3").setLabel("Email Adicional");
    $("#frm_negativa_email_3").setValue(emailOtro);
    //$("#frm_negativa_email_3").hide();
    $("#frm_negativa_email_3").show();
  } else if (datoSelect3 == "BROKER"){
    var emailBroker = $("#frm_asegurado_mail").getValue();
    $("#frm_negativa_email_3").setLabel("Email Broker");
    $("#frm_negativa_email_3").setValue(emailBroker);
    //$("#frm_negativa_email_3").hide();       
    $("#frm_negativa_email_3").show();       
  } else if (datoSelect3 == "ASEGURADO"){
    var emailAsegurado = $("#frm_asegurado_mail_1").getValue();
    $("#frm_negativa_email_3").setLabel("Email Asegurado");
    $("#frm_negativa_email_3").setValue(emailAsegurado);
    //$("#frm_negativa_email_3").hide();    
    $("#frm_negativa_email_3").show();    
  } else {
    $("#frm_negativa_email_3").setValue('');
    $("#frm_negativa_dirigido_3").setValue('');
    $("#frm_negativa_email_3").setLabel("Email");
    $("#frm_negativa_email_3").hide();
  }
  //dirigido(newV,oldV,"#frm_negativa_dirigido_1");
  //dirigido(newV,oldV,"#frm_negativa_dirigido_2")
  //dirigido(newV,oldV,"#frm_negativa_dirigido_3");
});

$("#19704822661d89a84dc5eb6067966042").setOnSubmit(function(){  
  $("#frmTxtCodigoContratante").setValue('');
  $("#frmTxtCodigoContratante").disableValidation();
  $("#frmTxtNombreCobertura").setValue('');
  $("#frmTxtNombreCobertura").disableValidation();
  $("#frmTxtValorPagar").setValue('');
  $("#frmTxtValorPagar").disableValidation();
  $("#frmTxtObservaciones").setValue('');
  $("#frmTxtObservaciones").disableValidation(); 

  $('#form\\[frmCmbPagarAPago\\]').val("");
  $("#frmCmbPagarAPago").disableValidation();
  $('#form\\[frmTxtCodigoContratante\\]').val("");
  $("#frmTxtCodigoContratante").disableValidation();
  $('#form\\[frmTxtNombreCobertura\\]').val("");
  $("#frmTxtNombreCobertura").disableValidation();
  $('#form\\[frmChkPagoTransferencia\\]').val("");
  $('input[id="form\\[frmChkPagoTransferencia\\]"]').prop("checked", false);
  $('#form\\[frmCmbGenerarOp\\]').val("");
  $('#form\\[frmTxtObservaciones\\]').val("");
  $("#frmTxtObservaciones").disableValidation(); 

  var numPagos = $("#grdDetallePago").getNumberRows();
  console.log("numPagos: " + numPagos);
  if (numPagos == 0) {    
    $("#esAseguradoBenficiario").setValue("0");
  }else{
    for (var i = 1; i <= numPagos; i++){
      if ($("#grdDetallePago").getValue(i, 15) != '')
        $("#esAseguradoBenficiario").setValue("1");
    }
  }

  var totalReser = parseFloat($("#grd_coberturas").getSummary(12));
  if (totalReser == 0 && $("#grd_coberturas").getValue(1, 1) != '' ) {
      alert("Por favor ingrese un monto valido en el grid de Coberturas");
      return false; //stop submit action
  }
  else {
      console.log("Total Reservado: " + totalReser);
      return true;  //allow submit action
  }
  return true;
});


// Asignar un evento click al boton con id "btn_enviar"
$("#btn_enviar").click(function(event) {
  let newValue = $("#frm_accion").getValue();    
  if(newValue == "DOCUMENTAR"){
    event.preventDefault();    
    const confirmar = confirm("Verifique que los correos ingresados se encuentren correctos, ya que estos recibiran la notificacion de la solicitud de documentos adicionales.");
    if (confirmar) {
      const confirmar2 = confirm("Esta seguro de que el valor colocado en el Monto Aprobado es el valor correcto? VALIDAR EN SISE.");
      if (confirmar2) {
        $("#19704822661d89a84dc5eb6067966042").submit();
      }
    }
  }else if(newValue == 'NEGAR' || newValue == 'NO_PROCEDER'){
    event.preventDefault();
    const confirmar = confirm("Verifique que los correos ingresados se encuentren correctos, ya que estos recibiran la notificacion de la negativa.");
    if (confirmar) {
      $("#19704822661d89a84dc5eb6067966042").submit();
    }
  }else if(newValue == 'APROBAR'||newValue == 'MEDICO' || newValue == 'MANTENER'|| newValue == 'DEVOLVER'){
    event.preventDefault();    
    const confirmar = confirm("Esta seguro de que el valor colocado en el Monto Aprobado es el valor correcto? VALIDAR EN SISE.");
    console.log("confirmar: " + confirmar);
    if (confirmar) {
      $("#19704822661d89a84dc5eb6067966042").submit();
    }
  }
});

function closeDataNegar() {
  $("#subtitle-negativa").hide();
  $("#lbl_antecdentes").hide();
  $("#frm_negativa_antecedentes").hide();
  $("#lbl_ley").hide();
  $("#frm_negativa_ley").hide();
  $("#frm_negativa_ley_1").hide();
  $("#frm_negativa_nota").hide();
  $("#lbl_resolucion").hide();
  $("#frm_falta_documentos_dirigido").hide();
  $("#frm_falta_documentos_dirigido").disableValidation();
  //$("#frm_comentario").setLabel('');
};