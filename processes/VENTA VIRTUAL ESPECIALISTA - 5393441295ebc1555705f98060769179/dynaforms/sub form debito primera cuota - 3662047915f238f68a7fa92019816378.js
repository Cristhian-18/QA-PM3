//<?php
var inicial = $("#frm_provisional_saldo_inicial").getControl().val()*1;
if (inicial > 0 ){ $("#frm_provisional_saldo").setValue('S'); }
else{ $("#frm_provisional_saldo").setValue('N'); } 

$("#frm_banco_equivida").getControl().attr('disabled', true);
$("#frm_deposito_fecha").getControl().attr('disabled', true);
$("#frm_deposito_comprobante").getControl().attr('disabled', true);
$("#frm_provisional_numero_lote").getControl().attr('disabled', true);
$("#frm_provisional_numero_autorizacion").getControl().attr('disabled', true);
$("#frm_provisional_numero_transaccion").getControl().attr('disabled', true);

$("#frm_banco_equivida").disableValidation();
$("#frm_deposito_fecha").disableValidation();
$("#frm_deposito_comprobante").disableValidation();
$("#frm_provisional_numero_lote").disableValidation();
$("#frm_provisional_numero_autorizacion").disableValidation();
$("#frm_provisional_numero_transaccion").disableValidation();

$("#frm_banco_equivida").hide();
$("#frm_deposito_fecha").hide();
$("#frm_deposito_comprobante").hide();
$("#frm_provisional_numero_lote").hide();
$("#frm_provisional_numero_autorizacion").hide();
$("#frm_provisional_numero_transaccion").hide();

////////////////

$("#frm_provisional_tipo_tarjeta").getControl().attr('disabled', true);
$("#frm_provisional_banco").getControl().attr('disabled', true);
$("#frm_provisional_numero_tarjeta").getControl().attr('disabled', true);
$("#frm_provisional_plan_pago").getControl().attr('disabled', true);
$("#frm_provisional_plan_cobro_cuota").getControl().attr('disabled', true);

$("#frm_provisional_tipo_tarjeta").disableValidation();
$("#frm_provisional_banco").disableValidation();
$("#frm_provisional_numero_tarjeta").disableValidation();
$("#frm_provisional_plan_pago").disableValidation();
$("#frm_provisional_plan_cobro_cuota").disableValidation();

$("#frm_provisional_tipo_tarjeta").hide();
$("#frm_provisional_banco").hide();
$("#frm_provisional_numero_tarjeta").hide();
$("#frm_provisional_plan_pago").hide();
$("#frm_provisional_plan_cobro_cuota").hide();


$("#frm_provisional_pago").setValue($("#frm_monto").getValue());
sumar_monto_cobro_anticipado();

depositoProvisional_medio();
saldo_change();

$("#frm_banco_ccontable").hide();

// $("#frm_Sucursal").setValue(''); //solo para probar
if ($("#frm_Sucursal").getValue() != '') {
  $("#frm_Sucursal").getControl().attr('disabled', true);
} else {
  $("#frm_Sucursal").getControl().attr('disabled', false);
}

$("#frm_monto_deposito_provisional").focusout(function () {
  var monto = $("#frm_monto_deposito_provisional").getValue();
  if (monto <= 1) {
    alert('El monto no puede ser menor a 1');
    $("#frm_monto_deposito_provisional").setValue('');
  }
});

$("#frm_deposito_medio").change(function () {

  depositoProvisional_medio();
  depositoProvisional_encerar();
  cuota_gratis();
  sumar_monto_cobro_anticipado();

});

function cuota_gratis() {

  var medio = $("#frm_deposito_medio").getControl().val();

  if (medio == "GRATIS") {
    $("#frm_provisional_descuento").setValue($("#frm_monto").getValue());
    $("#frm_provisional_promocion").setValue(1);
    $("#frm_provisional_promocion").getControl().attr('disabled',true);
    $("#frm_provisional_descuento").getControl().attr('disabled',true);
    sumar_monto_cobro_anticipado();
  }
  else
  {
    $("#frm_provisional_promocion").getControl().attr('disabled',false);
    $("#frm_provisional_descuento").getControl().attr('disabled',false);
  }

}

function depositoProvisional_medio() {


  var medio = $("#frm_deposito_medio").getControl().val();

  if (medio == "GRATIS" || medio == "PAGOSMEDIOS" || medio == "DEBITO") {

    $estado =  (medio == "GRATIS" ? 'PAGADO' : 'EN_PROCESO');
    $("#frm_control_pago").setValue($estado);
    $("#frm_banco_equivida").getControl().attr('disabled', true);
    $("#frm_deposito_fecha").getControl().attr('disabled', true);
    $("#frm_deposito_comprobante").getControl().attr('disabled', true);
    $("#frm_provisional_numero_lote").getControl().attr('disabled', true);
    $("#frm_provisional_numero_autorizacion").getControl().attr('disabled', true);
    $("#frm_provisional_numero_transaccion").getControl().attr('disabled', true);

    $("#frm_banco_equivida").disableValidation();
    $("#frm_deposito_fecha").disableValidation();
    $("#frm_deposito_comprobante").disableValidation();
    $("#frm_provisional_numero_lote").disableValidation();
    $("#frm_provisional_numero_autorizacion").disableValidation();
    $("#frm_provisional_numero_transaccion").disableValidation();

    $("#frm_banco_equivida").hide();
    $("#frm_deposito_fecha").hide();
    $("#frm_deposito_comprobante").hide();
    $("#frm_provisional_numero_lote").hide();
    $("#frm_provisional_numero_autorizacion").hide();
    $("#frm_provisional_numero_transaccion").hide();

    ////////////////

    $("#frm_provisional_tipo_tarjeta").getControl().attr('disabled', true);
    $("#frm_provisional_banco").getControl().attr('disabled', true);
    $("#frm_provisional_numero_tarjeta").getControl().attr('disabled', true);
    $("#frm_provisional_plan_pago").getControl().attr('disabled', true);
    $("#frm_provisional_plan_cobro_cuota").getControl().attr('disabled', true);

    $("#frm_provisional_tipo_tarjeta").disableValidation();
    $("#frm_provisional_banco").disableValidation();
    $("#frm_provisional_numero_tarjeta").disableValidation();
    $("#frm_provisional_plan_pago").disableValidation();
    $("#frm_provisional_plan_cobro_cuota").disableValidation();

    $("#frm_provisional_tipo_tarjeta").hide();
    $("#frm_provisional_banco").hide();
    $("#frm_provisional_numero_tarjeta").hide();
    $("#frm_provisional_plan_pago").hide();
    $("#frm_provisional_plan_cobro_cuota").hide();

  }
  else
  {
    /*

    $("#frm_banco_equivida").getControl().attr('disabled', false);
    $("#frm_deposito_fecha").getControl().attr('disabled', false);
    $("#frm_deposito_comprobante").getControl().attr('disabled', false);
    $("#frm_provisional_numero_lote").getControl().attr('disabled', false);
    $("#frm_provisional_numero_autorizacion").getControl().attr('disabled', false);
    $("#frm_provisional_numero_transaccion").getControl().attr('disabled', false);

    $("#frm_banco_equivida").enableValidation();
    $("#frm_deposito_fecha").enableValidation();
    $("#frm_deposito_comprobante").enableValidation();
    $("#frm_provisional_numero_lote").enableValidation();
    $("#frm_provisional_numero_autorizacion").enableValidation();
    $("#frm_provisional_numero_transaccion").enableValidation();

    $("#frm_banco_equivida").show();
    $("#frm_deposito_fecha").show();
    $("#frm_deposito_comprobante").show();
    $("#frm_provisional_numero_lote").show();
    $("#frm_provisional_numero_autorizacion").show();
    $("#frm_provisional_numero_transaccion").show();

    ////////////////

    $("#frm_provisional_tipo_tarjeta").getControl().attr('disabled', false);
    $("#frm_provisional_banco").getControl().attr('disabled', false);
    $("#frm_provisional_numero_tarjeta").getControl().attr('disabled', false);
    $("#frm_provisional_plan_pago").getControl().attr('disabled', false);
    $("#frm_provisional_plan_cobro_cuota").getControl().attr('disabled', false);

    $("#frm_provisional_tipo_tarjeta").enableValidation();
    $("#frm_provisional_banco").enableValidation();
    $("#frm_provisional_numero_tarjeta").enableValidation();
    $("#frm_provisional_plan_pago").enableValidation();
    $("#frm_provisional_plan_cobro_cuota").enableValidation();

    $("#frm_provisional_tipo_tarjeta").show();
    $("#frm_provisional_banco").show();
    $("#frm_provisional_numero_tarjeta").show();
    $("#frm_provisional_plan_pago").show();
    $("#frm_provisional_plan_cobro_cuota").show();	 
    */
  }

  //"3" TRANSFERENCIA, "4" DEPOSITO
  //"5" CHEQUE
  //"6" EFECTIVO
  if (medio == 3 || medio == 4 || medio == 5 || medio == 6 ) {
    $("#frm_control_pago").setValue('PAGADO');
    $("#frm_provisional_tipo_tarjeta").getControl().attr('disabled', true);
    $("#frm_provisional_banco").getControl().attr('disabled', true);
    $("#frm_provisional_numero_tarjeta").getControl().attr('disabled', true);
    $("#frm_provisional_plan_pago").getControl().attr('disabled', true);
    $("#frm_provisional_plan_cobro_cuota").getControl().attr('disabled', true);

    $("#frm_provisional_tipo_tarjeta").disableValidation();
    $("#frm_provisional_banco").disableValidation();
    $("#frm_provisional_numero_tarjeta").disableValidation();
    $("#frm_provisional_plan_pago").disableValidation();
    $("#frm_provisional_plan_cobro_cuota").disableValidation();

    $("#frm_provisional_tipo_tarjeta").hide();
    $("#frm_provisional_banco").hide();
    $("#frm_provisional_numero_tarjeta").hide();
    $("#frm_provisional_plan_pago").hide();
    $("#frm_provisional_plan_cobro_cuota").hide();

  }


  if (medio == 1 || medio == 2 || medio == 5)	//	"2" TARJETA CREDITO, "1" TARJETA DEBITO, "5" CHEQUE
  {
    $("#frm_deposito_comprobante").disableValidation();
    $("#frm_provisional_numero_transaccion").disableValidation();
  }
  else if (medio == 3 || medio == 4)	//"3" TRANSFERENCIA, "4" DEPOSITO
  {
    // $("#frm_deposito_comprobante").enableValidation();
    $("#frm_provisional_numero_transaccion").disableValidation();
  }
  else if (medio == 6)	//"6" EFECTIVO
  {
    $("#frm_deposito_comprobante").disableValidation();
    // $("#frm_provisional_numero_transaccion").enableValidation();
  }

}

$("#frm_provisional_saldo_inicial, #frm_provisional_pago, #frm_provisional_descuento").focusout(function () {
  sumar_monto_cobro_anticipado();
});

function sumar_monto_cobro_anticipado() {

  var num_1 = $("#frm_provisional_saldo_inicial").getValue() * 1;
  var num_2 = $("#frm_provisional_pago").getValue() * 1;
  var num_3 = $("#frm_provisional_descuento").getValue() * 1;
  var suma = num_1 + num_2 - num_3;
  suma = suma.toFixed(2);
  $("#frm_monto_deposito_provisional").setValue(suma);
  /*
    var medio = $("#frm_deposito_medio").getControl().val();
  if (medio != 'GRATIS' && suma == 0 ) {
    alert ('Total a pagar no puede ser 0');
    $("#frm_monto_deposito_provisional").setValue(num_2);
    $("#frm_provisional_descuento").setValue(0);
    return false;}
  else
  {
      suma = suma.toFixed(2);
    $("#frm_monto_deposito_provisional").setValue(suma);
  }

*/


}

/*

$("#frm_tipo_tarjeta").change(function () {
  $("#frm_numero_tarjeta").setValue("");
  $("#frm_fecha_caducidad_tarjeta").setValue("");  

});

*/

//Validar tarjeta
$("#frm_provisional_numero_tarjeta").focusout(function () {

  var tipo_tarjeta = $("#frm_provisional_tipo_tarjeta").getControl().val();
  if (tipo_tarjeta == '') {
    alert("Seleccione el tipo de tarjeta ");
    return false;
  }
  var numero_tarjeta = $("#frm_provisional_numero_tarjeta").getValue();
  // if ($("#frm_medio_pago option:selected").val() == 'TARJETA') {
  if (!validarTarjetas(tipo_tarjeta, numero_tarjeta)) {
    alert('Revise el # de Tarjeta');
    $("#frm_provisional_numero_tarjeta").setValue("");
  }
  // }
  // alert($("#frm_tipo_tarjeta").getValue());
});

$("#frm_provisional_tipo_tarjeta").change(function () {
  tipo_tarjeta_encerar();
});

function tipo_tarjeta_encerar() {

  $("#frm_provisional_banco").setValue("");
  $("#frm_provisional_numero_tarjeta").setValue("");
  $("#frm_provisional_plan_pago").setValue("");
  $("#frm_provisional_plan_cobro_cuota").setValue("");

}

$("#frm_provisional_saldo").change(function () {
  saldo_change();
  sumar_monto_cobro_anticipado();
});

function saldo_change() {
  if ($("#frm_provisional_saldo").getControl().val() == 'S') {
    //$("#frm_provisional_saldo_inicial").setValue(0);
    //  $("#frm_provisional_saldo_inicial").getControl().attr('disabled', false);
    $("#frm_provisional_saldo_inicial").enableValidation();
  } else {
    //		$("#frm_provisional_saldo_inicial").setValue("");
    //   $("#frm_provisional_saldo_inicial").getControl().attr('disabled', true);
    //$("#frm_provisional_saldo_inicial").setValue(0); damian 
    $("#frm_provisional_saldo_inicial").disableValidation();
  }
}

function depositoProvisional_encerar() {
  // $("#frm_Sucursal").setValue('');
  // $("#frm_deposito_medio").setValue('');
  $("#frm_banco_equivida").setValue('');
  $("#frm_deposito_fecha").setValue('');
  $("#frm_deposito_comprobante").setValue('');
  $("#frm_banco_ccontable").setValue('');
  $("#frm_provisional_numero_lote").setValue('');
  $("#frm_provisional_numero_autorizacion").setValue('');
  $("#frm_provisional_numero_transaccion").setValue('');
  $("#frm_provisional_tipo_tarjeta").setValue('');
  $("#frm_provisional_banco").setValue('');
  $("#frm_provisional_numero_tarjeta").setValue('');
  $("#frm_provisional_plan_pago").setValue('');
  $("#frm_provisional_plan_cobro_cuota").setValue('');
  var inicial = $("#frm_provisional_saldo_inicial").getControl().val();
  if (inicial > 0 ){ $("#frm_provisional_saldo").setValue('S'); }
  else{ $("#frm_provisional_saldo").setValue('N'); }   
  $("#frm_provisional_promocion").setValue('');
  // $("#frm_provisional_pago").setValue('');
  $("#frm_provisional_descuento").setValue('');
  // $("#frm_monto_deposito_provisional").setValue('');

}

