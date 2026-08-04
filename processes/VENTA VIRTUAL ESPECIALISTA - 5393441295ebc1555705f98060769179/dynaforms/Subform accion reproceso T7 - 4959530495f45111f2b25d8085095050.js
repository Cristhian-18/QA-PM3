// comentar por paso produ
//$("#frm_control_pago").hide();
//$("#frm_control_risk").hide();
//$("#frm_control_informe").hide();
//$("#frm_control_adjuntos").hide();

$("#frm_modificar_solicitud").hide();
$("#frm_modificar_debito").hide();
$("#frm_modificar_covid").hide();
$('#frm_modificar_covid').setValue('0');

$("#frm_accion").on("change" , function() {
  var sw = $("#frm_accion").getControl().val();
  $("#frm_comentario").setValue('');
  // alert (id);
  if (sw == 'MODIFICAR')
  {
    $("#frm_modificar_solicitud").show();
    if($('#frm_debito_si').getValue() == 'SI')
    	$("#frm_modificar_debito").show();
    //$("#frm_modificar_covid").show();
  }
  else
  {
    $('#frm_modificar_solicitud').setValue('0');
    $('#frm_modificar_debito').setValue('0');
    //$('#frm_modificar_covid').setValue('0'); 
     
    
    $("#frm_modificar_solicitud").hide();
    $("#frm_modificar_debito").hide();
    //$("#frm_modificar_covid").hide();
    //$("#frm_comentario").setValue(''); 

    
  }
  if (sw == 'ADJUNTAR')
  {
    $("#frm_comentario").setValue('Cliente entrega documentos');
  }
  if (sw == 'INFORME')
  {
    $("#frm_comentario").setValue('Declaracion agente');
  }  
  if (sw == 'FINALIZAR')
  {
    $("#frm_comentario").setValue('Cliente no cumple politica de riesgos');
  }    
   
});

