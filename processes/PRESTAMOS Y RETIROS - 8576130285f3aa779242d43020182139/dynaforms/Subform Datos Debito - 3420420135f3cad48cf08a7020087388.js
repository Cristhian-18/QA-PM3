$("#frm_cedula_pagador").focusout(function () {
  var bool = validarIdentificacion($('#frm_cedula_pagador ').getValue(), $('#frm_tipo_identificacion_pagador').getControl().val());
  if (bool == false) {
    $('#frm_cedula_pagador ').setValue("");
    alert("Numero de identificacion incorrecta");
  }

});


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

//$("#frm_tipo_identificacion_pagador").hide();
//$("#frm_cedula_pagador").hide();
if ($("#tri_ban_portal").getValue() == 'SI') {
  $("#grd_ctas_debito").hide();
  $("#chk_nuevo_banco").hide();
}
