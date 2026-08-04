
if ($("#frm_vitality_tipo_identificacion").getValue().length <= 0) {
  $("#frm_pagador_tipo").parent().parent().hide();
}
medioPago();
$("#frm_tipo_tarjeta").parent().parent().hide();
$("#frm_cuenta").parent().parent().hide();
$("#frm_polizaanombrede").parent().parent().hide();
$("#frm_numero_tarjeta").parent().parent().hide();
$("#frm_entidad_financiera").parent().parent().hide();
$("#frm_polizaanombrede").disableValidation();
$("#frm_parentesco").disableValidation();

//Cuando es pago a terceros
$("#frm_pago_terceros").change(function () {
  //  alert($("#frm_pago_terceros").getValue());
  if ($("#frm_pago_terceros").getValue() == 1) {
    $("#frm_polizaanombrede").parent().parent().hide("slow");
    $("#frm_polizaanombrede").disableValidation();
    $("#frm_parentesco").disableValidation();

  }
  else {
    $("#frm_polizaanombrede").parent().parent().show("slow");
    $("#frm_polizaanombrede").enableValidation();
    $("#frm_parentesco").enableValidation();

  }
});
//Pasar a letras
$("#frm_monto").focusout(function () {
  var numeroaletras = NumeroALetras($("#frm_monto").getValue());
  if (numeroaletras.trim() === "undefined DOLARES") {
    numeroaletras = "";
  }


  $("#frm_monto_letras").setValue(numeroaletras)
});
//Validar tarjeta
$("#frm_numero_tarjeta").focusout(function () {
  // var tipo_tarjeta= $("#frm_tipo_tarjeta").getValue();
  //var numero_tarjeta= $("#frm_numero_tarjeta").getValue();
  if ($("#frm_medio_pago option:selected").val() == 'TARJETA') {
    if (!validarTarjetas($("#frm_tipo_tarjeta").getValue(), $("#frm_numero_tarjeta").getValue())) {
      alert('Revise el # de Tarjeta');
    }
  }
  // alert($("#frm_tipo_tarjeta").getValue());
});


//Al seleccionar medio d epago
$("#frm_medio_pago").change(function () {
  medioPago();

});
function medioPago() {
  if ($("#frm_medio_pago option:selected").val() == 'TARJETA') {
    $("#frm_tipo_tarjeta").parent().parent().show("slow");
    $("#frm_numero_tarjeta").parent().parent().show("slow");
    $("#frm_cuenta").parent().parent().hide("slow");
    $("#frm_entidad_financiera").parent().parent().hide("slow");
    $("#frm_numero_tarjeta").setLabel("#Tarjeta");
    $("#frm_fecha_caducidad_tarjeta").enableValidation();
    $("#frm_tipo_tarjeta").enableValidation();
    $("#frm_entidad_financiera").disableValidation();
  }
  else {
    $("#frm_tipo_tarjeta").parent().parent().hide("slow");
    $("#frm_numero_tarjeta").parent().parent().show("slow");
    $("#frm_entidad_financiera").parent().parent().show("slow");

    $("#frm_numero_tarjeta").setLabel("#Cuenta");
    $("#frm_fecha_caducidad_tarjeta").disableValidation();
    $("#frm_tipo_tarjeta").disableValidation();
    $("#frm_entidad_financiera").enableValidation();


  }
}
$("#frm_cedula_pagador").focusout(function () {
  var bool = validarIdentificacion($('#frm_cedula_pagador ').getValue(), $('#frm_tipo_identificacion_pagador').getControl().val());
  if (bool == false) {
    $('#frm_cedula_pagador ').setValue("");
    alert("Numero de identificacion incorrecta")

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
    letrasMonedaPlural: 'DOLARES',//"PESOS", 'Dolares', 'Bolivares', 'etcs'
    letrasMonedaSingular: 'DOLAR', //"PESO", 'Dolar', 'Bolivar', 'etc'

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

function usarCuentasAnteriores() {
  switch ($("#frm_misma_cuenta_vitality option:selected").val()) {
    case "CTAVITALITY":
      $("#frm_nombre_pagador").setValue($("#frm_vitality_titular").getValue());
      $("#frm_apellidos_pagador").setValue($("#frm_vitality_titular_apellidos").getValue());
      $("#frm_medio_pago").setValue($("#frm_vitality_tipo_cuenta").getValue());
      $("#frm_entidad_financiera").setValue($("#frm_vitality_banco").getValue());
      $("#frm_numero_tarjeta").setValue($("#frm_vitality_numero_cuenta").getValue());
      $("#frm_tipo_identificacion_pagador").setValue($("#frm_vitality_tipo_identificacion").getValue());
      $("#frm_cedula_pagador").setValue($("#frm_vitality_identificacion").getValue());
      break;
    case "CTADEVOLUCION":


      $("#frm_nombre_pagador").setValue($("#frm_devolucion_titular").getValue());
      $("#frm_apellidos_pagador").setValue($("#frm_devolucion_titular_apellidos").getValue());
      $("#frm_medio_pago").setValue($("#frm_devolucion_tipo_cuenta").getValue());
      $("#frm_entidad_financiera").setValue($("#frm_devolucion_banco").getValue());
      $("#frm_numero_tarjeta").setValue($("#frm_devolucion_numero_cuenta").getValue());
      $("#frm_tipo_identificacion_pagador").setValue($("#frm_devolucion_tipo_identificacion").getValue());
      $("#frm_cedula_pagador").setValue($("#frm_devolucion_identificacion").getValue());
      break;
    default:
      $("#frm_nombre_pagador").setValue('');
      $("#frm_apellidos_pagador").setValue('');
      $("#frm_medio_pago").setValue('');
      $("#frm_entidad_financiera").setValue('');
      $("#frm_numero_tarjeta").setValue('');
      $("#frm_tipo_identificacion_pagador").setValue('');
      $("#frm_cedula_pagador").setValue('');
      break;
  }

}

$("#frm_pagador_tipo").change(function () {
  usarCuentasAnteriores();
});
