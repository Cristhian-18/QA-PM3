$('#3662047915f238f68a7fa92019816378').toggle();
$('#3305631365ed3f8c0d976d6071754916').toggle();
$('#2200289695ec4351a1bd6d3027166827').toggle();
$('#3659092825f484ded40e690037283996').toggle();

var deposito = $("#frm_recibio_deposito").getValue();

if(deposito == 'S'){
  $('#frm_sbt_confirmar_autorizacion_debito_primera_cuota').hide();
  $('#3662047915f238f68a7fa92019816378').hide();
}


$("#3311398795f8f17802ffbc4030855427").setOnSubmit(function(){

  var tt = $("#frm_monto_deposito_provisional").getValue();
  $("#3311398795f8f17802ffbc4030855427").saveForm() ;
  return showConfirmDlg();
});

$("#btn_financiera_save").find("button").on("click" , function() {
  $("#3311398795f8f17802ffbc4030855427").saveForm();
  alert ("Formulario guardado ...");  
});

$("#frm_cliente_medio_aprobacion").hide();
$("#frm_pagador_medio_aprobacion").hide();
$("#frm_pagador_medio_aprobacion").disableValidation();
$("#frm_cliente_medio_aprobacion").disableValidation();

if($("#frm_pago_terceros").getValue() == 'S'){
  $("#frm_pagador_medio_aprobacion").show();
  $("#frm_pagador_medio_aprobacion").enableValidation();
}else{
  $("#frm_cliente_medio_aprobacion").show();
  $("#frm_cliente_medio_aprobacion").enableValidation();
}
