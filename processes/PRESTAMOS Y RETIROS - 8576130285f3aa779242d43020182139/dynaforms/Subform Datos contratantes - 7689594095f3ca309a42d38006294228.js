//ocultar campo endoso va opo default 0
$("#frm_numero_endozo_vigente").hide();
//Validar cedula de identidad y pasaporte
$("#frm_numero_identificacion_juridico").focusout(function () {
  if (typeof validarIdentificacion === 'function') {
    var bool = validarIdentificacion($('#frm_numero_identificacion_juridico').getValue(), $('#frm_tipo_identificacion_juridico').getControl().val());
    if (bool == false) {
      $('#frm_numero_identificacion_juridico').setValue("");
    }
  }
});


//Validar cedula de identidad y pasaporte
$("#frm_plazo_prestamo").focusout(function () {
  var monto = $('#frm_monto_prestamo').getValue();
  if ($('#frm_frecuencia_pago').getValue() == '1')
    var frec = 12;
  if ($('#frm_frecuencia_pago').getValue() == '6')
    var frec = 1;
  if ($('#frm_frecuencia_pago').getValue() == '2')
    var frec = 6;
  if ($('#frm_frecuencia_pago').getValue() == '4')
    var frec = 3;

  var plazo = ($('#frm_plazo_prestamo').getValue() * 1) * frec;
  //console.log(plazo);
  var frecuencia = $('#frm_frecuencia_pago').getValue();

  //monto 5000
  if (monto <= 5000) {
    if (plazo > 12) {
      alert("Plazo no valido \n por ese monto solo se admite hasta 12 meses");
      $("#frm_plazo_prestamo").setValue('');
      return false;
    }
  }
  //monto 10000
  if (monto > 5000 && monto <= 10000) {
    if (plazo > 24) {
      alert("Plazo no valido \n por ese monto solo se admite hasta 24 meses");
      $("#frm_plazo_prestamo").setValue('');
      return false;
    }
  }
  //monto 10000
  if (monto > 10000 && monto <= 100000) {
    if (plazo > 36) {
      alert("Plazo no valido \n por ese monto solo se admite hasta 36 meses");
      $("#frm_plazo_prestamo").setValue('');
      return false;
    }
  }
});

function FrecuenciaPago(newValue, oldValue) {
  //cambio el foco al plazo
  $("#frm_plazo_prestamo").getControl().focus();
}

$("#frm_frecuencia_pago").setOnchange(FrecuenciaPago);

function EnableTextbox(newVal, oldVal) {

  if (newVal == '1' || newVal == 'on' || newVal === true || newVal == '"1"') {
    $("#frm_plazo_prestamo").setValue("1");
    $('#frm_plazo_prestamo').getControl().attr('disabled', true);

    var monto = $('#frm_monto_prestamo').getValue();
    var frecuencia = $('#frm_frecuencia_pago').getValue();
    if (monto > 3000 || frecuencia == 1) {
      alert("Monto o Plazo no valido \n monto maximo es 3000 y frecuencia 6 meses");
      $("#frm_monto_prestamo").setValue('');
      $("#frm_plazo_prestamo").setValue('');
      $("#frm_frecuencia_pago").setValue('');
      return false;
    }
  }
  else {

    $('#frm_plazo_prestamo').getControl().attr('disabled', false);
  }
}
$("#chk_vencimiento").setOnchange(EnableTextbox);


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


//Pasar a letras
$("#frm_monto_prestamo").focusout(function () {

  $("#frm_plazo_prestamo").setValue('');
  $("#frm_total_capital").setValue('');
  $("#frm_total_interes").setValue('');
  $("#frm_total_pagar").setValue('');
  $("#tabla_amor").html('');

  var numeroaletras = NumeroALetras($("#frm_monto_prestamo").getValue());
  if (numeroaletras.trim() === "undefined DOLARES") {
    numeroaletras = "";
  }

  if ($("#frm_monto_prestamo").getValue() * 1 < $("#tri_monto_minimo_p").getValue() * 1 || $("#frm_monto_prestamo").getValue() * 1 > $("#frm_monto_disponible").getValue() * 1) {
    //alert($("#frm_monto_prestamo").getValue() + ' ' + $("#tri_monto_minimo_p").getValue());
    if ($("#frm_monto_prestamo").getValue() * 1 < $("#tri_monto_minimo_p").getValue() * 1)
      alert("Monto mínimo de prestamo es " + $("#tri_monto_minimo_p").getValue());
    if ($("#frm_monto_prestamo").getValue() * 1 > $("#frm_monto_disponible").getValue() * 1)
      alert("Monto máximo de prestamo es " + $("#frm_monto_disponible").getValue());

    $("#frm_monto_prestamo").setValue('');
  }


  $("#frm_monto_prestamo_letras").setValue(numeroaletras)
});

//Pasar a letras
$("#frm_monto").focusout(function () {
  $("#frm_costo_retiro").setValue('');
  $("#frm_derecho_retiro").setValue('');
  $("#frm_val_descontado").setValue('');
  //console.log('sipp');
  if ($("#frm_monto").getValue() * 1 < $("#tri_monto_minimo_r").getValue() * 1 || $("#frm_monto").getValue() * 1 > $("#frm_monto_disponible").getValue() * 1) {
    if ($("#frm_monto").getValue() * 1 < $("#tri_monto_minimo_r").getValue() * 1)
      alert("Monto mínimo de retiro es " + $("#tri_monto_minimo_r").getValue());
    if ($("#frm_monto").getValue() * 1 > $("#frm_monto_disponible").getValue() * 1)
      alert("Monto máximo de retiro es " + $("#frm_monto_disponible").getValue());

    $("#frm_monto").setValue('');
  }
});
