// $('#3662047915f238f68a7fa92019816378').toggle();
$('#3305631365ed3f8c0d976d6071754916').toggle();

var sw = $("#frm_recibio_deposito").getValue();
$('#3305631365ed3f8c0d976d6071754916').show();
//sumar_monto_cobro_anticipado();
$("#frm_provisional_tipo_tarjeta").hide();
$("#frm_provisional_banco").hide();
$("#frm_provisional_numero_tarjeta").hide();
$("#frm_provisional_plan_pago").hide();
$("#frm_provisional_plan_cobro_cuota").hide();

//alert (sw);
if (sw == 'S') {
  $('#frm_sbt_debito_primera_cuota').hide();
  $('#3662047915f238f68a7fa92019816378').hide();

  $('#frm_primera_cuota_medio_pago').disableValidation();
  $('#frm_primera_cuota_modalidad').disableValidation();
  $('#frm_primera_cuota_plan').disableValidation();
  $('#frm_primera_cuota_total_primer_pago').disableValidation();
  $('#frm_primera_cuota_descuento').disableValidation();
  $('#frm_primera_cuota_total_pagar').disableValidation();
}


$("#4713209005ebc185c5bd448012926908").setOnSubmit(function () {
  $("#4713209005ebc185c5bd448012926908").saveForm();
  var medio = $("#frm_deposito_medio").getControl().val();
  var pago = $("#frm_monto_deposito_provisional").getControl().val();

  if (medio != 'GRATIS' && pago <= 0){
    alert ("Revise valor a pagar ");
    $("#frm_provisional_descuento").setValue(0);
    //sumar_monto_cobro_anticipado();
    return false;
  }

  var inicial = $("#frm_provisional_saldo_inicial").getControl().val()*1;
  if (medio == 'GRATIS' && inicial > 0){
    alert ("Cliente mantiene saldo inicial gestionar el pago como pago provisional");
    $("#frm_provisional_descuento").setValue(0);
    $("#frm_deposito_medio").setValue('');
    //sumar_monto_cobro_anticipado();
    return false;
  }

  return showConfirmDlg();
});

$("#btn_financiera_save").on("click", function () {
  $("#4713209005ebc185c5bd448012926908").saveForm();
  alert("Formulario guardado ...");
});

$("#btn_financiera_submit").on("click", function () {
  var pago = $("#frm_medio_pago").getControl().val();
  var tipo = $("#eqfx_pagador_tipo").getControl().val();
  if (pago != 'TARJETA' && (tipo == 'C' || tipo == 'D'))
  {
    alert ("No olvide subir un documento que valide que tiene los fondos para el pago de prima mensual o anual");
  }
  
  return showConfirmDlg();
});