$( function(){
  if($("#frm_provisional_saldo_inicial").getValue() == ''){ $("#frm_provisional_saldo_inicial").setValue(0); }
  var inicial = $("#frm_provisional_saldo_inicial").getControl().val()*1;
  if (inicial > 0 ){ $("#frm_provisional_saldo").setValue('S'); }
  else{ $("#frm_provisional_saldo").setValue('N'); } 

  sumar_monto_cobro_anticipado();
  $("#frm_banco_ccontable").hide();
  depositoProvisional_hide();
  depositoProvisional_tarjeta();
})

$("#frm_recibio_deposito").change(function () {

  $("#frm_deposito_medio").setValue('');
  var suc =  $("#frm_Sucursal").getControl().val();
  $("#frm_Sucursal").setValue('');
  $("#frm_Sucursal").setValue(suc);
  //alert('inicializar');

  depositoProvisional_hide();

});

function depositoProvisional_hide() {
  if ($("#frm_recibio_deposito").getControl().val() == 'S') {

    $("#frm_control_pago").setValue('PAGADO');
    $("#frm_Sucursal").show();
    $("#frm_deposito_medio").show();

    $("#frm_Sucursal").enableValidation();
    $("#frm_deposito_medio").enableValidation();
  }
  else{
    $("#frm_control_pago").setValue('EN_PROCESO');
    $("#frm_Sucursal").hide();
    $("#frm_deposito_medio").hide();
    // $("#frm_deposito_medio").setValue('0');

    $("#frm_Sucursal").disableValidation();
    $("#frm_deposito_medio").disableValidation();	
  }


  $("#frm_banco_ccontable").disableValidation();
  $("#frm_banco_ccontable").hide();
  $("#frm_banco_equivida").disableValidation();
  $("#frm_banco_equivida").hide();
  $("#frm_deposito_comprobante").disableValidation();
  $("#frm_deposito_comprobante").hide();
  $("#frm_deposito_fecha").disableValidation();
  $("#frm_deposito_fecha").hide();
  $("#frm_monto_deposito_provisional").disableValidation();
  $("#frm_monto_deposito_provisional").hide();
  $("#frm_provisional_banco").disableValidation();
  $("#frm_provisional_banco").hide();
  $("#frm_provisional_descuento").disableValidation();
  $("#frm_provisional_descuento").hide();
  $("#frm_provisional_numero_autorizacion").disableValidation();
  $("#frm_provisional_numero_autorizacion").hide();
  $("#frm_provisional_numero_lote").disableValidation();
  $("#frm_provisional_numero_lote").hide();
  $("#frm_provisional_numero_tarjeta").disableValidation();
  $("#frm_provisional_numero_tarjeta").hide();
  $("#frm_provisional_numero_transaccion").disableValidation();
  $("#frm_provisional_numero_transaccion").hide();
  $("#frm_provisional_pago").disableValidation();
  $("#frm_provisional_pago").hide();
  $("#frm_provisional_plan_cobro_cuota").disableValidation();
  $("#frm_provisional_plan_cobro_cuota").hide();
  $("#frm_provisional_plan_pago").disableValidation();
  $("#frm_provisional_plan_pago").hide();
  $("#frm_provisional_promocion").disableValidation();
  $("#frm_provisional_promocion").hide();
  $("#frm_provisional_saldo").disableValidation();
  $("#frm_provisional_saldo").hide();
  $("#frm_provisional_saldo_inicial").disableValidation();
  $("#frm_provisional_saldo_inicial").hide();
  $("#frm_provisional_tipo_tarjeta").disableValidation();
  $("#frm_provisional_tipo_tarjeta").hide();
}



$("#frm_deposito_medio").change(function () {
  depositoProvisional_encerar();
  depositoProvisional_hide()
  depositoProvisional_tarjeta();
  sumar_monto_cobro_anticipado();
});

function depositoProvisional_tarjeta() {
  var medio = $("#frm_deposito_medio").getControl().val();
  // alert (medio);
  var pago =  $("#frm_recibio_deposito").getControl().val();
  if (medio >= '1' && medio <= '6' && pago == 'S' ){

    $("#frm_deposito_fecha").enableValidation();
    $("#frm_deposito_fecha").show();
    $("#frm_monto_deposito_provisional").enableValidation();
    $("#frm_monto_deposito_provisional").show();
    $("#frm_provisional_descuento").enableValidation();
    $("#frm_provisional_descuento").show();
    $("#frm_provisional_pago").enableValidation();
    $("#frm_provisional_pago").show();
    $("#frm_provisional_promocion").enableValidation();
    $("#frm_provisional_promocion").show();
    $("#frm_provisional_saldo").enableValidation();
    $("#frm_provisional_saldo").show();
    $("#frm_provisional_saldo_inicial").enableValidation();
    $("#frm_provisional_saldo_inicial").show();  
  }
  if ((medio == 1 || medio == 2) && pago == 'S')	//"2" TARJETA CREDITO, "1" TARJETA DEBITO
  {
    $("#frm_provisional_banco").enableValidation();
    $("#frm_provisional_banco").show();
    $("#frm_provisional_numero_tarjeta").enableValidation();
    $("#frm_provisional_numero_tarjeta").show();
    $("#frm_provisional_numero_transaccion").enableValidation();
    $("#frm_provisional_numero_transaccion").show();
    $("#frm_provisional_plan_cobro_cuota").enableValidation();
    $("#frm_provisional_plan_cobro_cuota").show();    
    $("#frm_provisional_plan_pago").enableValidation();
    $("#frm_provisional_plan_pago").show();
    $("#frm_deposito_comprobante").enableValidation();
    $("#frm_deposito_comprobante").show();
    $("#frm_provisional_tipo_tarjeta").enableValidation();
    $("#frm_provisional_tipo_tarjeta").show();
    $("#frm_provisional_numero_autorizacion").enableValidation();
    $("#frm_provisional_numero_autorizacion").show();
    $("#frm_provisional_numero_lote").enableValidation();
    $("#frm_provisional_numero_lote").show();    
  }
  else if ((medio == 3 || medio == 4) && pago == 'S')	//"3" TRANSFERENCIA, "4" DEPOSITO
  {
    $("#frm_banco_equivida").enableValidation();
    $("#frm_banco_equivida").show();
    $("#frm_deposito_comprobante").enableValidation();
    $("#frm_deposito_comprobante").show();
    $("#frm_provisional_numero_transaccion").enableValidation();
    $("#frm_provisional_numero_transaccion").show();  
    /*
    $("#frm_deposito_comprobante").enableValidation();
    $("#frm_deposito_comprobante").show();
    $("#frm_provisional_banco").enableValidation();
    $("#frm_provisional_banco").show();
    $("#frm_provisional_numero_autorizacion").enableValidation();
    $("#frm_provisional_numero_autorizacion").show();
    $("#frm_provisional_numero_lote").enableValidation();
    $("#frm_provisional_numero_lote").show();
        $("#frm_deposito_comprobante").enableValidation();
    $("#frm_deposito_comprobante").show();
    $("#frm_provisional_numero_tarjeta").enableValidation();
    $("#frm_provisional_numero_tarjeta").show();

    $("#frm_provisional_plan_cobro_cuota").enableValidation();
    $("#frm_provisional_plan_cobro_cuota").show();
    $("#frm_provisional_plan_pago").enableValidation();
    $("#frm_provisional_plan_pago").show();
    $("#frm_provisional_tipo_tarjeta").enableValidation();
    $("#frm_provisional_tipo_tarjeta").show();
*/

  }
  else if ((medio == 5 || medio == 6) && pago == 'S')	//"6" EFECTIVO 5 cheque
  {
    $("#frm_banco_equivida").enableValidation();
    $("#frm_banco_equivida").show();
    $("#frm_deposito_comprobante").enableValidation();
    $("#frm_deposito_comprobante").show();
  }

}

function depositoProvisional_encerar() {

  // $("#frm_recibio_deposito").setValue('');
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

  //$("#frm_provisional_saldo_inicial").setValue('');
  $("#frm_provisional_promocion").setValue('');
  //  $("#frm_provisional_pago").setValue('');
  $("#frm_provisional_descuento").setValue(0);
  //  $("#frm_monto_deposito_provisional").setValue('');
  var inicial = $("#frm_provisional_saldo_inicial").getControl().val();

  if (inicial > 0 ){
    $("#frm_provisional_saldo").setValue('S');

  }
  else{ $("#frm_provisional_saldo").setValue('N'); 
       $("#frm_provisional_saldo_inicial").setValue(0);
      }   

}

$("#frm_monto_deposito_provisional").focusout(function () {
  var monto = $("#frm_monto_deposito_provisional").getValue();
  if (monto <= 0) {
    alert('El monto no puede ser cero');
    $("#frm_monto_deposito_provisional").setValue('0.00');
  }
});

$("#frm_provisional_pago, #frm_provisional_descuento").focusout(function () {
  sumar_monto_cobro_anticipado();
});

function sumar_monto_cobro_anticipado() {

  var num_1 = $("#frm_provisional_saldo_inicial").getValue() * 1;
  var num_2 = $("#frm_provisional_pago").getValue() * 1;
  var num_3 = $("#frm_provisional_descuento").getValue() * 1;

  var suma = num_1 + num_2 - num_3;
  suma = suma.toFixed(2);
  $("#frm_monto_deposito_provisional").setValue(suma);
}

$("#frm_provisional_numero_tarjeta").focusout(function () {

  var tipo_tarjeta = $("#frm_provisional_tipo_tarjeta").getControl().val();
  if (tipo_tarjeta == '') {
    alert("Seleccione el tipo de tarjeta ");
    return false;
  }
  var numero_tarjeta= $("#frm_provisional_numero_tarjeta").getValue();
  // if ($("#frm_medio_pago option:selected").val() == 'TARJETA') {
  if (!validarTarjetas(tipo_tarjeta, numero_tarjeta)) {
    alert('Revise el # de Tarjeta');
    $("#frm_provisional_numero_tarjeta").setValue("");
  }
  // }
  // alert($("#frm_tipo_tarjeta").getValue());
});

/*
		function validarTarjetas(tipotarjeta, numero) {
		switch (tipotarjeta) {
        case "VISA":
		if (!numero.match(/^4[0-9]{12}(?:[0-9]{3})?$/)) {
		return false;
		}
		else {
		return true;
		}
		break;
        case "AMEX":
		if (!numero.match(/^3[47][0-9]{13}$/)) {
		return false;
		}
		else {
		return true;
		}
		break;
        case "DINERS":
        case "6":
		if (!numero.match(/^3(?:0[0-5]|[68][0-9])[0-9]{11}$/)) {
		return false;
		}
		else {
		return true;
		}
		break;

        case "MASTERCARD":
		if (!numero.match(/5[1-5][0-9]{14}$/)) {
		return false;
		}
		else {
		return true;
		}
		break;
        case "MASTERCARDTITANIUM":
		if (!numero.match(/2[0-9]{15}$/)) {
		return false;
		}
		else {
		return true;
		}
		break;
        case "DISCOVER":
		if (!numero.match(/^6(?:011|5[0-9]{2})[0-9]{12}$/)) {
		return false;
		}
		else {
		return true;
		}
		break;
		}
		}
	*/

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

  //  $("#frm_provisional_saldo_inicial").setValue("");
  saldo_change();

});

function saldo_change() {
  if ($("#frm_provisional_saldo").getControl().val() == 'S') {
    //$("#frm_provisional_saldo_inicial").getControl().attr('disabled', false);
    $("#frm_provisional_saldo_inicial").enableValidation();
  } else {
    //$("#frm_provisional_saldo_inicial").getControl().attr('disabled', true);
    $("#frm_provisional_saldo_inicial").disableValidation();
  }
}
