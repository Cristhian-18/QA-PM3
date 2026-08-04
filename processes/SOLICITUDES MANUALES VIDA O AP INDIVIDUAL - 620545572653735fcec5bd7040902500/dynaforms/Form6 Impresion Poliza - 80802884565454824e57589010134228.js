function acciones(){
var accion =   $("#frm_accion").getControl().val();
  //alert ("accion");
  	$("#subtitle0000000004").hide();
  	$("#378147771654544cb8cef96099263996").hide();
  
  $("#frm_cobranza_banco").disableValidation();
  $("#frm_cobranza_tipo_pago").disableValidation();
  $("#frm_cobranza_fecha").disableValidation();
  $("#frm_cobranza_referencia").disableValidation();
  $("#frm_cobranza_valor").disableValidation();
  $("#frm_cobranza_comentario").disableValidation(); 
      
  if(accion == 'PAGAR'){
    $("#subtitle0000000004").show();
    $("#378147771654544cb8cef96099263996").show();  
    $("#frm_cobranza_banco").enableValidation();
  $("#frm_cobranza_tipo_pago").enableValidation();
  $("#frm_cobranza_fecha").enableValidation();
  $("#frm_cobranza_referencia").enableValidation();
  $("#frm_cobranza_valor").enableValidation();
  $("#frm_cobranza_comentario").enableValidation();
  }
}


$('#frm_accion').setOnchange(acciones);
acciones();