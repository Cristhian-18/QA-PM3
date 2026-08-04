$("#frm_vitality_tipo_cuenta").hide();
$("#frm_vitality_banco").hide();
$("#frm_devolucion_tipo_cuenta").hide();
$("#frm_devolucion_banco").hide();

$("#frm_fecha_caducidad_tarjeta").focusout(function () {
  var fecha_cad = $("#frm_fecha_caducidad_tarjeta").getValue();
  var fechaActual = new Date(fecha_cad);
  var fechaActual = new Date();
  if (moment(fechaActual).isBefore(fecha_cad)) {

  }
  else {
  }

  // $("#frm_fecha_caducidad_tarjeta").setValue('');
});

if ($("#frm_devolucion_tipo_identificacion").getValue().length <= 0) {
  $("#frm_pagador_tipo").parent().parent().hide();

}
else {
  //$("#frm_pago_terceros").parent().parent().hide();
  //$("#frm_pago_terceros").disableValidation()
}
medioPago();
pagoTerceros();
vitality();



//Cuando es pago a terceros
$("#frm_pago_terceros").change(function () {
  pagoTerceros();

});
$("#frm_tipo_identificacion_pagador").change(function () {
  $('#frm_cedula_pagador ').setValue('');
});


function pagoTerceros() {
  console.log('cdcdcdcd');
  $("#frm_copia_ci").hide();
  $("#frm_doc_cta").hide();
  //alert($("#frm_pago_terceros").getValue());$("#frm_medio_pago option:selected").val() == 'TARJETA'
  if ($("#frm_pago_terceros option:selected").val() == 'S') {
    $("#frm_cedula_pagador").getControl().attr('readonly', false);
    $("#frm_tipo_identificacion_pagador").getControl().attr('readonly', false);
    $("#frm_apellidos_pagador_m").getControl().attr('readonly', false);
    $("#frm_nombre_pagador").getControl().attr('readonly', false);
    $("#frm_apellidos_pagador").getControl().attr('readonly', false);
    var nombre_completop = $("#frm_nombres_poliza").getValue() + ' ' + $("#frm_apellidos_poliza").getValue();
    $("#frm_polizaanombrede").setValue(nombre_completop);
    $("#frm_polizaanombrede").parent().parent().show("slow");
    $("#lbl_terceros").parent().parent().show("slow");
    // var nomcompleto = $("#frm_nombres_completos").getValue();
    // $("#frm_polizaanombrede").setValue( nomcompleto );
    $("#frm_polizaanombrede").enableValidation();
    $("#frm_parentesco").enableValidation();
    $("#frm_copia_ci").show();
    $("#frm_doc_cta").show();
    $("#frm_copia_ci").enableValidation();
    $("#frm_doc_cta").enableValidation();

  }
  else {
    $("#frm_cedula_pagador").getControl().attr('readonly', true);
    $("#frm_tipo_identificacion_pagador").getControl().attr('readonly', true);
    $("#frm_apellidos_pagador_m").getControl().attr('readonly', true);
    $("#frm_nombre_pagador").getControl().attr('readonly', true);
    $("#frm_apellidos_pagador").getControl().attr('readonly', true);
    $("#frm_polizaanombrede").parent().parent().hide("slow");
    $("#lbl_terceros").parent().parent().hide("slow");
    $("#frm_polizaanombrede").disableValidation();
    $("#frm_polizaanombrede").setValue('');
    $("#frm_parentesco").disableValidation();
    $("#frm_polizaanombrede").setValue('');
    $("#frm_parentesco").setValue('');
    $("#frm_copia_ci").disableValidation();
    $("#frm_doc_cta").disableValidation();
  }

}

//Pasar a letras
$("#frm_monto").focusout(function () {
  var numeroaletras = NumeroALetras($("#frm_monto").getValue());
  if (numeroaletras.trim() === "undefined DOLARES") {
    numeroaletras = "";
  }


  $("#frm_monto_letras").setValue(numeroaletras)
});

//Pasar a letras
function monto_letras() {
  var numeroaletras = NumeroALetras($("#frm_monto").getValue());
  if (numeroaletras.trim() === "undefined DOLARES") {
    numeroaletras = "";
  }

  $("#frm_monto_letras").setValue(numeroaletras)
}

//Validar tarjeta
$("#frm_numero_tarjeta").focusout(function () {
  // var tipo_tarjeta= $("#frm_tipo_tarjeta").getValue();
  //var numero_tarjeta= $("#frm_numero_tarjeta").getValue();
  //alert($("#frm_numero_tarjeta").getValue());
  if ($("#frm_medio_pago option:selected").val() == 'TARJETA') {
    if (!validarTarjetas($("#frm_tipo_tarjeta").getValue(), $("#frm_numero_tarjeta").getValue())) {
      alert('Revise el # de Tarjeta');

      /*	 window.dynaform.flashMessage({
                emphasisMessage: "#Tarjeta Incorrecto",
                message: "Favor revise el # de tarjeta",
                duration: 3000,
                type: 'info',

                absoluteTop: true
            });*/

      $("#frm_numero_tarjeta").setValue('');
    }
  }
  // alert($("#frm_tipo_tarjeta").getValue());
});


//Al seleccionar medio d epago
$("#frm_medio_pago").change(function () {
  medioPago();

});
function medioPago() {
  $('#frm_tipo_tarjeta').getControl().empty();
  $('#frm_tipo_tarjeta').getControl().append(new Option("Seleccione", ""));
  $('#frm_entidad_financiera').getControl().empty();
  $('#frm_entidad_financiera').getControl().append(new Option("Seleccione", ""));

  if ($("#frm_medio_pago option:selected").val() == 'TARJETA') {
    $("#frm_tipo_tarjeta").show("slow");
    $("#frm_numero_tarjeta").show("slow");
    $("#frm_cuenta").hide("slow");
    $("#frm_entidad_financiera").hide("slow");
    $("#frm_numero_tarjeta").setLabel("#Tarjeta");
    $("#frm_fecha_caducidad_tarjeta").show();
    //  $("#frm_entidad_financiera").hide("slow");
    $("#frm_fecha_caducidad_tarjeta").enableValidation();
    $("#frm_tipo_tarjeta").enableValidation();
    $("#frm_entidad_financiera").disableValidation();
    $("#frm_entidad_financiera").setValue('');
    //ajax
    var sn_banco = '0';
    var sntiporamo = $("#sntiporamo").getValue();
    console.log($("#type_pp").getValue());
    var type_pp = $("#type_pp").getValue();

    $.ajax({
      url: '../beesmartec/services/cambio_conducto/ajax_pantalla.php',
      data: {
        'funcion': 'consultar_bancos',
        'sn_banco': sn_banco,
        'sntiporamo': sntiporamo,
        'type_pp': type_pp
      },
      type: 'POST',
      beforeSend: function () {
        $("#935630558691df8a0a70124091430390").showFormModal();
      },

      success: function (respuesta) {
        //console.log(respuesta);
        var respuestadata = JSON.parse(respuesta);

        if (respuestadata.mensaje == 'false') {
          alert("Error al recuperar los datos");
        }
        else {
          var i = 1;
          $.each(respuestadata.bancos, function (i, item) {
            $('#frm_tipo_tarjeta').getControl().append(new Option(item.nombreEntidad, item.codigo));
            //$("#frm_contratante").disableValidation();
            i++;
          });
        }
      },
      error: function (xhr, status) {
        alert(status);
      },
      complete: function (xhr, status) {
        $("#935630558691df8a0a70124091430390").hideFormModal();
      }
    });

  }
  else {
    if ($("#frm_medio_pago option:selected").val() == 'CTAAHO' || $("#frm_medio_pago option:selected").val() == 'CTACTE') {
      //$("#frm_tipo_tarjeta").parent().parent().hide("slow");
      $("#frm_tipo_tarjeta").hide()
      $("#frm_numero_tarjeta").show("slow");
      $("#frm_entidad_financiera").show("slow");

      $("#frm_numero_tarjeta").setLabel("#Cuenta");
      $("#frm_fecha_caducidad_tarjeta").hide("slow");
      $("#frm_fecha_caducidad_tarjeta").disableValidation();
      $("#frm_tipo_tarjeta").disableValidation();
      $("#frm_entidad_financiera").enableValidation();

      $("#frm_tipo_tarjeta").setValue('');
      $("#frm_fecha_caducidad_tarjeta").setValue('');

      //ajax
      var sn_banco = '-1';
      var sntiporamo = $("#sntiporamo").getValue();
      console.log('----' + $("#type_pp").getValue());
      var type_pp = $("#type_pp").getValue();

      $.ajax({
        url: '../beesmartec/services/cambio_conducto/ajax_pantalla.php',
        data: {
          'funcion': 'consultar_bancos',
          'sn_banco': sn_banco,
          'sntiporamo': sntiporamo,
          'type_pp': type_pp
        },
        type: 'POST',
        beforeSend: function () {
          $("#935630558691df8a0a70124091430390").showFormModal();
        },

        success: function (respuesta) {
          //console.log(respuesta);
          var respuestadata = JSON.parse(respuesta);

          if (respuestadata.mensaje == 'false') {
            alert("Error al recuperar los datos");
          }
          else {
            var i = 1;
            $.each(respuestadata.bancos, function (i, item) {
              $('#frm_entidad_financiera').getControl().append(new Option(item.nombreEntidad, item.codigo));
              //$("#frm_contratante").disableValidation();
              i++;
            });
          }
        },
        error: function (xhr, status) {
          alert(status);
        },
        complete: function (xhr, status) {
          $("#935630558691df8a0a70124091430390").hideFormModal();
        }
      });
    }
    else {

      $("#frm_tipo_tarjeta").hide("slow");
      $("#frm_numero_tarjeta").hide("slow");
      $("#frm_fecha_caducidad_tarjeta").hide("slow");
      $("#frm_entidad_financiera").hide("slow");
      $("#frm_fecha_caducidad_tarjeta").disableValidation();
      $("#frm_tipo_tarjeta").disableValidation();
      $("#frm_fecha_caducidad_tarjeta").disableValidation();
      $("#frm_entidad_financiera").enableValidation();

    }


  }
}

function medioPago_campos() {
  if ($("#frm_medio_pago option:selected").val() == 'TARJETA') {
    $("#frm_tipo_tarjeta").show("slow");
    $("#frm_numero_tarjeta").show("slow");
    $("#frm_cuenta").hide("slow");
    $("#frm_entidad_financiera").hide("slow");
    $("#frm_numero_tarjeta").setLabel("#Tarjeta");
    $("#frm_fecha_caducidad_tarjeta").show();
    //  $("#frm_entidad_financiera").hide("slow");
    $("#frm_fecha_caducidad_tarjeta").enableValidation();
    $("#frm_tipo_tarjeta").enableValidation();
    $("#frm_entidad_financiera").disableValidation();
    $("#frm_entidad_financiera").setValue('');
  }
  else {
    if ($("#frm_medio_pago option:selected").val() == 'CTAAHO' || $("#frm_medio_pago option:selected").val() == 'CTACTE') {
      //$("#frm_tipo_tarjeta").parent().parent().hide("slow");
      $("#frm_tipo_tarjeta").hide()
      $("#frm_numero_tarjeta").show("slow");
      $("#frm_entidad_financiera").show("slow");

      $("#frm_numero_tarjeta").setLabel("#Cuenta");
      $("#frm_fecha_caducidad_tarjeta").hide("slow");
      $("#frm_fecha_caducidad_tarjeta").disableValidation();
      $("#frm_tipo_tarjeta").disableValidation();
      $("#frm_entidad_financiera").enableValidation();

      $("#frm_tipo_tarjeta").setValue('');
      $("#frm_fecha_caducidad_tarjeta").setValue('');
    }
    else {

      $("#frm_tipo_tarjeta").hide("slow");
      $("#frm_numero_tarjeta").hide("slow");
      $("#frm_fecha_caducidad_tarjeta").hide("slow");
      $("#frm_entidad_financiera").hide("slow");
      $("#frm_fecha_caducidad_tarjeta").disableValidation();
      $("#frm_tipo_tarjeta").disableValidation();
      $("#frm_fecha_caducidad_tarjeta").disableValidation();
      $("#frm_entidad_financiera").enableValidation();

    }


  }
}

$("#frm_cedula_pagador").focusout(function () {
  var bool = validarIdentificacion($('#frm_cedula_pagador ').getValue(), $('#frm_tipo_identificacion_pagador').getControl().val());
  if (bool == false) {
    $('#frm_cedula_pagador ').setValue("");
    alert("Numero de identificacion incorrecta")

    /*window.dynaform.flashMessage({
                emphasisMessage: "Identificacion Incorrecta",
                message: "Favor revise el # de identificacion",
                duration: 3000,
                type: 'info',

                absoluteTop: true
            });*/

  }

});

if ($('frm_numero_tarjeta').val() != '') {
  // $('frm_numero_tarjeta').validateCreditCard(function(result){
  // alert(result);
  // });
}


function validarIdentificacion(identificacion, tipoIdentificacion) {
  numero = identificacion;
  if (tipoIdentificacion == '') {
    alert("Ingrese el tipo de identificacion");
    /* window.dynaform.flashMessage({
                emphasisMessage: "Tipo de Identificacion",
                message: "Favor ingrese el tipo de identificacion",
                duration: 3000,
                type: 'info',

                absoluteTop: true
            });*/
    return false;
  }
  if (tipoIdentificacion == 'R') {
    if (numero.length != 13) {
      //  alert("La identificacion no tiene diez digitos");
      identificacion.value = '';
      bandera = false;
      return false;
    }
  }


  var bandera = true;

  if (tipoIdentificacion == 'C') {
    if (numero.length != 10) {
      //  alert("La identificacion no tiene diez digitos");
      identificacion.value = '';
      bandera = false;
      return false;
    }
  }

  if (bandera) {
    digitos = numero.split("");
    totdigitos = 10;
    total = 0;
    digito = (digitos[9] * 1);

    for (i = 0; i < (totdigitos - 1); i++) {
      mult = 0;
      if ((i % 2) != 0) {
        total = total + (digitos[i] * 1);
      } else {
        mult = digitos[i] * 2;
        if (mult > 9)
          total = total + (mult - 9);
        else
          total = total + mult;
      }
    }

    //comprobando codigo verificador
    decena = total / 10;
    decena = Math.floor(decena);
    decena = (decena + 1) * 10;
    final = (decena - total);

    if ((final == 10 && digito == 0) || (final == digito)) {
      //alert("Cedula valida");
      return true;
    } else {
      //Validar pasaporte
      if (tipoIdentificacion == 'P' && numero.length <= 30) {
        return true;
      }
      if (tipoIdentificacion == 'P' && numero.length > 30) {
        alert("En un pasaporte se permite maximo 30 caracteres ");
        return false;
      } else {
        // alert("Identificacion no valida");
        identificacion.value = '';
        return false;
      }
    }
  }
}

function Unidades(num) {

  switch (num) {
    case 1: return "UN";
    case 2: return "DOS";
    case 3: return "TRES";
    case 4: return "CUATRO";
    case 5: return "CINCO";
    case 6: return "SEIS";
    case 7: return "SIETE";
    case 8: return "OCHO";
    case 9: return "NUEVE";
  }

  return "";
}//Unidades()

function Decenas(num) {

  decena = Math.floor(num / 10);
  unidad = num - (decena * 10);
  switch (decena) {
    case 1:
      switch (unidad) {
        case 0: return "DIEZ";
        case 1: return "ONCE";
        case 2: return "DOCE";
        case 3: return "TRECE";
        case 4: return "CATORCE";
        case 5: return "QUINCE";
        default: return "DIECI" + Unidades(unidad);
      }
    case 2:
      switch (unidad) {
        case 0: return "VEINTE";
        default: return "VEINTI" + Unidades(unidad);
      }
    case 3: return DecenasY("TREINTA", unidad);
    case 4: return DecenasY("CUARENTA", unidad);
    case 5: return DecenasY("CINCUENTA", unidad);
    case 6: return DecenasY("SESENTA", unidad);
    case 7: return DecenasY("SETENTA", unidad);
    case 8: return DecenasY("OCHENTA", unidad);
    case 9: return DecenasY("NOVENTA", unidad);
    case 0: return Unidades(unidad);
  }
}//Unidades()

function DecenasY(strSin, numUnidades) {
  if (numUnidades > 0)
    return strSin + " Y " + Unidades(numUnidades)

  return strSin;
}//DecenasY()

function Centenas(num) {
  centenas = Math.floor(num / 100);
  decenas = num - (centenas * 100);
  switch (centenas) {
    case 1:
      if (decenas > 0)
        return "CIENTO " + Decenas(decenas);
      return "CIEN";
    case 2: return "DOSCIENTOS " + Decenas(decenas);
    case 3: return "TRESCIENTOS " + Decenas(decenas);
    case 4: return "CUATROCIENTOS " + Decenas(decenas);
    case 5: return "QUINIENTOS " + Decenas(decenas);
    case 6: return "SEISCIENTOS " + Decenas(decenas);
    case 7: return "SETECIENTOS " + Decenas(decenas);
    case 8: return "OCHOCIENTOS " + Decenas(decenas);
    case 9: return "NOVECIENTOS " + Decenas(decenas);
  }

  return Decenas(decenas);
}//Centenas()

function Seccion(num, divisor, strSingular, strPlural) {
  cientos = Math.floor(num / divisor)
  resto = num - (cientos * divisor);


  letras = "";

  if (cientos > 0)
    if (cientos > 1)
      letras = Centenas(cientos) + " " + strPlural;
    else
      letras = strSingular;

  if (resto > 0)
    letras += "";

  return letras;
}//Seccion()

function Miles(num) {
  divisor = 1000;
  cientos = Math.floor(num / divisor)
  resto = num - (cientos * divisor)


  strMiles = Seccion(num, divisor, "UN MIL", "MIL");
  strCentenas = Centenas(resto);

  if (strMiles == "")
    return strCentenas;

  return strMiles + " " + strCentenas;
}//Miles()

function Millones(num) {
  divisor = 1000000;
  cientos = Math.floor(num / divisor)
  resto = num - (cientos * divisor)


  strMillones = Seccion(num, divisor, "UN MILLON DE", "MILLONES DE");
  strMiles = Miles(resto);

  if (strMillones == "")
    return strMiles;

  return strMillones + " " + strMiles;
}//Millones()

function NumeroALetras(num) {
  var data = {
    numero: num,
    enteros: Math.floor(num),
    centavos: (((Math.round(num * 100)) - (Math.floor(num) * 100))),
    letrasCentavos: "",
    letrasMonedaPlural: 'DOLARES',//"PESOS", 'Dólares', 'Bolívares', 'etcs'
    letrasMonedaSingular: 'DOLAR', //"PESO", 'Dólar', 'Bolivar', 'etc'

    letrasMonedaCentavoPlural: "CENTAVOS",
    letrasMonedaCentavoSingular: "CENTAVO"
  };

  if (data.centavos > 0) {
    data.letrasCentavos = "CON " + (function () {
      if (data.centavos == 1)
        return Millones(data.centavos) + " " + data.letrasMonedaCentavoSingular;
      else
        return Millones(data.centavos) + " " + data.letrasMonedaCentavoPlural;
    })();
  };

  if (data.enteros == 0)
    return "CERO " + data.letrasMonedaPlural + " " + data.letrasCentavos;
  if (data.enteros == 1)
    return Millones(data.enteros) + " " + data.letrasMonedaSingular + " " + data.letrasCentavos;
  else
    return Millones(data.enteros) + " " + data.letrasMonedaPlural + " " + data.letrasCentavos;
}

function validarTarjetas(tipotarjeta, numero) {
  switch (tipotarjeta) {
    //case "VISA":
    case "3":
      if (!numero.match(/^4[0-9]{12}(?:[0-9]{3})?$/)) {
        return false;
      }
      else {
        return true;
      }
      break;
    //case "AMEX":
    case "5":
      if (!numero.match(/^3[47][0-9]{13}$/)) {
        return false;
      }
      else {
        return true;
      }
      break;
    //case "DINERS":
    case "1":
      if (!numero.match(/^3(?:0[0-5]|[68][0-9])[0-9]{11}$/)) {
        return false;
      }
      else {
        return true;
      }
      break;

    //case "MASTERCARD":
    case "4":
      // !numero.match(/2[0-9]{15}$/) ||
      //if (!numero.match(/5[1-5][0-9]{14}$/)){
      if (!numero.match(/^(5[1-5][0-9]{14}|2[2-7][0-9]{14})$/)) {
        return false;
      }
      else {
        return true;
      }
      break;
    //case "DISCOVER":
    case "2":
      if (!numero.match(/^6(?:011|5[0-9]{2})[0-9]{12}$/)) {
        return false;
      }
      else {
        return true;
      }
      break;
  }
}

/*
function usarCuentasAnteriores() {
  switch($("#frm_pagador_tipo option:selected").val()){
    case "CTAVITALITY":
      var tipo_cuenta=$("#frm_vitality_tipo_cuenta").getValue();

      $("#frm_nombre_pagador").setValue( $("#frm_vitality_titular").getValue() );
      $("#frm_apellidos_pagador").setValue( $("#frm_vitality_titular_apellidos").getValue() );
      $("#frm_medio_pago").setValue( tipo_cuenta );
      $("#frm_entidad_financiera").setValue( $("#frm_vitality_banco").getValue() );
      $("#frm_numero_tarjeta").setValue( $("#frm_vitality_numero_cuenta").getValue() );
      $("#frm_tipo_identificacion_pagador").setValue( $("#frm_vitality_tipo_identificacion").getValue() );
      $("#frm_cedula_pagador").setValue( $("#frm_vitality_identificacion").getValue() );

      $("#frm_nombre_pagador").getControl().attr('disabled', true);
      $("#frm_apellidos_pagador").getControl().attr('disabled', true);
      $("#frm_medio_pago").getControl().attr('disabled', true);
      $("#frm_entidad_financiera").getControl().attr('disabled', true);
      $("#frm_numero_tarjeta").getControl().attr('disabled', true);
      $("#frm_tipo_identificacion_pagador").getControl().attr('disabled', true);
      $("#frm_cedula_pagador").getControl().attr('disabled', true);


      break;
    case "CTADEVOLUCION":


      $("#frm_nombre_pagador").setValue( $("#frm_devolucion_titular").getValue() );
      $("#frm_apellidos_pagador").setValue( $("#frm_devolucion_titular_apellidos").getValue() );
      $("#frm_medio_pago").setValue( $("#frm_devolucion_tipo_cuenta").getValue() );
      $("#frm_entidad_financiera").setValue( $("#frm_devolucion_banco").getValue() );
      $("#frm_numero_tarjeta").setValue( $("#frm_devolucion_numero_cuenta").getValue() );
      $("#frm_tipo_identificacion_pagador").setValue( $("#frm_devolucion_tipo_identificacion").getValue() );
      $("#frm_cedula_pagador").setValue( $("#frm_devolucion_identificacion").getValue() );

      $("#frm_nombre_pagador").getControl().attr('disabled', true);
      $("#frm_apellidos_pagador").getControl().attr('disabled', true);
      $("#frm_medio_pago").getControl().attr('disabled', true);
      $("#frm_entidad_financiera").getControl().attr('disabled', true);
      $("#frm_numero_tarjeta").getControl().attr('disabled', true);
      $("#frm_tipo_identificacion_pagador").getControl().attr('disabled', true);
      $("#frm_cedula_pagador").getControl().attr('disabled', true);
      break;
    default:
      $("#frm_nombre_pagador").setValue('');
      $("#frm_apellidos_pagador").setValue('');
      $("#frm_medio_pago").setValue( '');
      $("#frm_entidad_financiera").setValue('');
      $("#frm_numero_tarjeta").setValue('');
      $("#frm_tipo_identificacion_pagador").setValue('');
      $("#frm_cedula_pagador").setValue('');


      $("#frm_nombre_pagador").getControl().attr('disabled', false);
      $("#frm_apellidos_pagador").getControl().attr('disabled', false);
      $("#frm_medio_pago").getControl().attr('disabled', false);
      $("#frm_entidad_financiera").getControl().attr('disabled', false);
      $("#frm_numero_tarjeta").getControl().attr('disabled', false);
      $("#frm_tipo_identificacion_pagador").getControl().attr('disabled', false);
      $("#frm_cedula_pagador").getControl().attr('disabled', false);
      break;
                                                     }


}

$("#frm_pagador_tipo").change(function () {
  usarCuentasAnteriores();
  medioPago();
});*/


$("#frm_tipo_tarjeta").change(function () {
  $("#frm_numero_tarjeta").setValue('');
});



function vitality() {
  if ($("#frm_aplica_vitality").getValue() == 'S') {
    $("#frm_pagador_tipo").find("option[value=CTAVITALITY]").removeAttr("disabled");
  }
  else {
    $("#frm_pagador_tipo").find("option[value=CTAVITALITY]").attr("disabled", "disabled");

  }
}

//************************************************************************************************************************
//****************************************************       AJAX            *********************************************
//************************************************************************************************************************

function consultar_datos() {

  var frm_ti_poliza = $("#frm_tipo_identificacion_poliza").getValue();
  var frm_iden_poliza = $("#frm_identificacion_poliza").getValue();

  console.log(frm_ti_poliza);
  console.log(frm_iden_poliza);



  $('#frm_contratante').getControl().empty();
  $('#frm_contratante').getControl().append(new Option("Seleccione", ""));
  $("#frm_nombres_poliza").setValue('');
  $("#frm_apellidos_poliza").setValue('');
  $("#frm_celular_poliza").setValue('');
  $("#frm_correo_electronico_poliza").setValue('');
  $("#frm_sucursal").setValue('');
  $("#sntiporamo").setValue('');
  //pagador
  $("#frm_tipo_identificacion_pagador").setValue('');
  $("#frm_cedula_pagador").setValue('');
  $("#frm_nombre_pagador").setValue('');
  $("#frm_apellidos_pagador").setValue('');
  $("#frm_celular_debito").setValue('');
  $("#frm_correo_electronico_debito").setValue('');
  $("#frm_medio_pago").setValue('');
  $("#frm_tipo_tarjeta").setValue('');
  $("#frm_numero_tarjeta").setValue('');
  $("#frm_fecha_caducidad_tarjeta").setValue('');
  $("#frm_entidad_financiera").setValue('');
  $("#frm_monto").setValue('');
  $("#frm_monto_letras").setValue('');
  $("#frm_frecuencia_pago").setValue('');
  $("#frm_concepto_debito").setValue('');
  $("#frm_concepto_pago").setValue('');
  $("#frm_pago_terceros").setValue('');
  $("#frm_polizaanombrede").setValue('');
  $("#frm_parentesco").setValue('');

  $.ajax({
    url: '../beesmartec/services/cambio_conducto/ajax_pantalla.php',
    data: {
      'funcion': 'consultar_datos',
      'frm_ti_poliza': frm_ti_poliza,
      'frm_iden_poliza': frm_iden_poliza
    },
    type: 'POST',
    beforeSend: function () {
      $("#1338086785f95840fbc81b7082554585").showFormModal();
    },

    success: function (respuesta) {
      //console.log(respuesta);
      var respuestadata = JSON.parse(respuesta);
      console.log(respuestadata);

      if (respuestadata.mensaje == 'false') {
        alert(respuestadata.mensaje1);
      }
      else {
        //combo de contratante
        $('#frm_ajax_contratante').setValue(respuestadata);
        var i = 1;
        $.each(respuestadata.frm_contratante, function (i, item) {
          $('#frm_apellidos_poliza').setValue(item.txt_Apellido1_cont + ' ' + item.txt_apellido2_cont);
          $('#frm_nombres_poliza').setValue(item.txt_nombre_cont);
          if ($('#frm_tipo_identificacion_poliza').getValue() == 'R') {
            $("#frm_nombres_poliza").setValue(item.txt_Apellido1_cont);
          }
          $('#frm_sucursal').setValue(item.branchOfficeCode);
          //$('#frm_ramo_aux').setValue(item.ramoCode);
          $('#id_pv_cero').setValue(item.id_pv_cero);
          $('#id_pv').setValue(item.id_pv);
          $("#sntiporamo").setValue(item.sntiporamo);
          $('#frm_contratante').getControl().append(new Option(item.type_label + ' - ' + item.id_pv, item.id_pv_cero + '|' + item.id_pv + '|' + item.type + '|' + item.ramoCode));
          //$("#frm_contratante").disableValidation();
          i++;
        });
        //combo de contratante
        $('#frm_ajax_contratante').setValue(respuestadata);
      }
    },
    error: function (xhr, status) {
      alert(status);
    },
    complete: function (xhr, status) {
      $("#1338086785f95840fbc81b7082554585").hideFormModal();
    }
  });
}

$("#btn_consultar").find("button").on("click", function () {
  if ($("#frm_tipo_identificacion_poliza").getValue() != '' && $("#frm_identificacion_poliza").getValue()) {
    consultar_datos();
  } else {
    alert('Existe campos requeridos');
    $("#frm_identificacion_poliza").getControl().focus();
  }
});

function poliza(newValue, oldValue) {

  /*$("#frm_tipo_identificacion_pagador").setValue('');
  $("#frm_cedula_pagador").setValue('');
  $("#frm_nombre_pagador").setValue('');
  $("#frm_apellidos_pagador").setValue('');
  $("#frm_medio_pago").setValue('');
  $("#frm_tipo_tarjeta").setValue('');
  $("#frm_numero_tarjeta").setValue('');
  $("#frm_fecha_caducidad_tarjeta").setValue('');
  $("#frm_entidad_financiera").setValue('');
  $("#frm_monto").setValue('');
  $("#frm_monto_letras").setValue('');
  $("#frm_frecuencia_pago").setValue('');
  $("#frm_concepto_debito").setValue('');
  $("#frm_concepto_pago").setValue('');
  $("#frm_pago_terceros").setValue('');
  $("#frm_polizaanombrede").setValue('');
  $("#frm_parentesco").setValue('');
  */

  if ($("#frm_celular_poliza").getValue() != '' && $("#frm_correo_electronico_poliza").getValue() != '') {
    //poliza
    var datos = $("#frm_contratante").getValue();
    var tiporamo = $("#sntiporamo").getValue();
    $.ajax({
      url: '../beesmartec/services/cambio_conducto/ajax_pantalla.php',
      data: {
        'funcion': 'consultar_datos_poliza',
        'datos': datos,
        'tiporamo': tiporamo
      },
      type: 'POST',
      beforeSend: function () {
        $("#935630558691df8a0a70124091430390").showFormModal();
      },

      success: function (respuesta) {
        //console.log(respuesta);
        var respuestadata = JSON.parse(respuesta);

        if (respuestadata.mensaje == 'false') {
          alert("Error al recuperar los datos\n Por favor ingrese el cambio de conducto");
          $("#frm_tipo_identificacion_pagador").setValue($("#frm_tipo_identificacion_poliza").getValue());
          var ramo = $("#frm_contratante").getValue().split("|");
          $('#frm_ramo').setValue(ramo[3]);
          $("#frm_cedula_pagador").setValue($("#frm_identificacion_poliza").getValue());
          $("#frm_nombre_pagador").setValue($("#frm_nombres_poliza").getValue());
          var apellidos = $("#frm_apellidos_poliza").getValue().split("|");
          $("#frm_apellidos_pagador").setValue(apellidos[0]);
          $("#frm_apellidos_pagador_m").setValue(apellidos[1]);
        }
        else {
          $("#frm_tipo_identificacion_pagador").setValue(respuestadata.frm_contratante.payingDocumentTypeCode);
          $('#frm_ramo').setValue(respuestadata.frm_contratante.ramoCode);
          $("#frm_cedula_pagador").setValue(respuestadata.frm_contratante.payingDocument);
          $("#frm_nombre_pagador").setValue(respuestadata.frm_contratante.name);
          $("#frm_apellidos_pagador").setValue(respuestadata.frm_contratante.lastname);
          $("#frm_apellidos_pagador_m").setValue(respuestadata.frm_contratante.secondLastname);
          if (respuestadata.frm_contratante.payingDocumentTypeCode == 'R') {
            $("#frm_nombre_pagador").setValue(respuestadata.frm_contratante.lastname);
            $("#frm_apellidos_pagador_m").setValue(respuestadata.frm_contratante.lastname);
          }
          $("#frm_medio_pago").setValue(respuestadata.frm_contratante.debitType);
          $("#frm_medio_pago_aux").setValue(respuestadata.frm_contratante.debitType);
          $("#type_pp").setValue(respuestadata.frm_contratante.type_pp);
          medioPago_campos();
          $("#frm_tipo_tarjeta").setValue(respuestadata.frm_contratante.accountType);
          $("#frm_numero_tarjeta").setValue(respuestadata.frm_contratante.accountNumberCard);
          $("#frm_numero_tarjeta_aux").setValue(respuestadata.frm_contratante.accountNumberCard);
          $("#frm_fecha_caducidad_tarjeta").setValue(respuestadata.frm_contratante.yearMonthExpirationCard);
          $("#frm_entidad_financiera").setValue(respuestadata.frm_contratante.conductoCode);
          $("#frm_monto").setValue(respuestadata.frm_contratante.value);
          monto_letras();
          //$("#frm_monto_letras").setValue(respuestadata.frm_contratante.value);
          $("#frm_frecuencia_pago").setValue(respuestadata.frm_contratante.paymentFrequency);
          $("#frm_concepto_debito").setValue(respuestadata.frm_contratante.type);
          $("#frm_concepto_pago").setValue(respuestadata.frm_contratante.loanPolicyNumber);
          $("#frm_pago_terceros").setValue(respuestadata.frm_contratante.paymentThirdParties);
          pagoTerceros();
          //$("#frm_polizaanombrede").setValue(respuestadata.frm_contratante.paymentThirdParties);
          $("#frm_parentesco").setValue(respuestadata.frm_contratante.relationship);
          $("#ind_conducto").setValue(respuestadata.frm_contratante.indConducto);
          $("#insuredCode").setValue(respuestadata.frm_contratante.insuredCode);
          $("#insuredPaymentCode").setValue(respuestadata.frm_contratante.insuredPaymentCode);
          //combo bancos / tarjetas
          $('#frm_entidad_financiera').getControl().empty();
          $('#frm_entidad_financiera').getControl().append(new Option("Seleccione", ""));
          $('#frm_tipo_tarjeta').getControl().empty();
          $('#frm_tipo_tarjeta').getControl().append(new Option("Seleccione", ""));
          var i = 1;
          if (respuestadata.frm_contratante.debitType == 'TARJETA') {
            $.each(respuestadata.frm_contratante.bancos, function (i, item) {
              $('#frm_tipo_tarjeta').getControl().append(new Option(item.nombreEntidad, item.codigo));
              //$("#frm_contratante").disableValidation();
              i++;
            });
            //asignacion de codigo
            $('#frm_tipo_tarjeta').setValue(respuestadata.frm_contratante.conductoCode);
            $('#frm_tipo_tarjeta_aux').setValue(respuestadata.frm_contratante.conductoCode);
          } else {
            $.each(respuestadata.frm_contratante.bancos, function (i, item) {
              $('#frm_entidad_financiera').getControl().append(new Option(item.nombreEntidad, item.codigo));
              //$("#frm_contratante").disableValidation();
              i++;
            });
            //asignacion de codigo
            $('#frm_entidad_financiera').setValue(respuestadata.frm_contratante.conductoCode)
            $('#frm_entidad_financiera_axu').setValue(respuestadata.frm_contratante.conductoCode)
          }
        }
      },
      error: function (xhr, status) {
        alert(status);
      },
      complete: function (xhr, status) {
        $("#935630558691df8a0a70124091430390").hideFormModal();
      }
    });
  } else {
    $("#frm_contratante").setValue('');
    alert('Datos requeridos');
    $("#frm_celular_poliza").getControl().focus();
    //$("#frm_correo_electronico_poliza").getControl().focus();
  }
}

$("#frm_contratante").setOnchange(poliza);

//para copiar el num de poliza
function ConceptoDebito() {
  //alert($("#frm_pago_terceros").getValue());$("#frm_medio_pago option:selected").val() == 'TARJETA'
  if ($("#frm_concepto_debito option:selected").val() == 'POLIZA') {
    $("#frm_concepto_pago").setValue($("#frm_bus_poliza").getValue());
  }
  else {
    $("#frm_concepto_pago").setValue('');
  }

}
$("#frm_concepto_debito").change(function () {
  ConceptoDebito();
});
ConceptoDebito();
