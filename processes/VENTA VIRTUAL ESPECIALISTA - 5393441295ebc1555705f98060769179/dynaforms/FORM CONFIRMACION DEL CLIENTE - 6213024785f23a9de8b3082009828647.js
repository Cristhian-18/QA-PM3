$('#3662047915f238f68a7fa92019816378').toggle();
$('#3305631365ed3f8c0d976d6071754916').toggle();
$('#2200289695ec4351a1bd6d3027166827').toggle();
$('#3659092825f484ded40e690037283996').toggle();
$('#3221517146093154b8e19b5021092993').toggle();


// Cuando Cobro anticipado sea SI no se debera desplegar bloque de datos Cobro Primera Cuota
// Cuando Cobro anticipado sea NO se debera desplegar bloque de datos Cobro Primera Cuota
if($("#frm_recibio_deposito").getValue() == 'S'){
  $('#frm_sbt_debito_primera_cuota').hide();
  $('#3305631365ed3f8c0d976d6071754916').hide();
}

$("#6213024785f23a9de8b3082009828647").setOnSubmit(function(){

  var medio = $("#frm_deposito_medio").getControl().val();
  var pago = $("#frm_monto_deposito_provisional").getControl().val();
  //alert (medio + ' '+pago);
  if (medio == 'GRATIS' && pago != 0){
    alert ("el cobro debe realizarse por anticipado y registrarse en la seccion deposito provisional");
    var medio = $("#frm_deposito_medio").setValue('');
    $("#frm_provisional_descuento").setValue(0);
    sumar_monto_cobro_anticipado();
    return false;
  }

  if (medio != 'GRATIS' && pago <= 0){
    alert ("Revise valor a pagar ");
    $("#frm_provisional_descuento").setValue(0);
    sumar_monto_cobro_anticipado();
    return false;
  }  
  $("#6213024785f23a9de8b3082009828647").saveForm() ;

  return showConfirmDlg();
});

$("#btn_confirmar_autorizacion_save").find("button").on("click" , function() {
  $("#6213024785f23a9de8b3082009828647").saveForm();
  alert ("Formulario guardado ...");  
});

