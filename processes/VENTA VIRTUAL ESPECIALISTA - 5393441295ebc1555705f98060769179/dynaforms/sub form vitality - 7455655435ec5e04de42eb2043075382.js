$("#frm_vitality_tipo_identificacion").change( function () {
 	$('#frm_vitality_identificacion ').setValue('');
});

//Validar cedula de identidad y pasaporte
$("#frm_vitality_identificacion").focusout(function () {
  //  if (typeof validarIdentificacion === 'function') {
        var bool = validarIdentificacionv($('#frm_vitality_identificacion').getValue(), $('#frm_vitality_tipo_identificacion').getControl().val());
        if (bool == false) {
            $('#frm_vitality_identificacion').setValue("");
          	alert("Identificacion incorrecta");
        }
   // }
});

function validarIdentificacionv(identificacion, tipoIdentificacion, aux) {

    numero = identificacion;
    var tercerDigito = numero.substring(2, 3);
    var bandera = true;
    if (tipoIdentificacion == 'C') {
        if (numero.length != 10) {
            if (aux) {
                alert("La identificacion no tiene diez digitos");
            }
            identificacion.value = '';
            bandera = false;
            return false;
        }
    } else if (tipoIdentificacion == 'R') {
      
      	if (isNaN(numero)) {
         //  alert("La identificacion es incorrecta");
           identificacion.value = '';
            bandera = false;
            return false;
        }
        if (numero.length != 13) {
            if (aux) {
                alert("La identificacion no tiene trece digitos");
            }
            identificacion.value = '';
            bandera = false;
            return false;
        }
        if (tercerDigito == 9) {
            digitos = numero.split("");
            totdigitos = 10;
            total = 0;
            digito = (digitos[9] * 1);
            p1 = digitos[0] * 4;
            p2 = digitos[1] * 3;
            p3 = digitos[2] * 2;
            p4 = digitos[3] * 7;
            p5 = digitos[4] * 6;
            p6 = digitos[5] * 5;
            p7 = digitos[6] * 4;
            p8 = digitos[7] * 3;
            p9 = digitos[8] * 2;
            total = p1 + p2 + p3 + p4 + p5 + p6 + p7 + p8 + p9;
            residuo = total % 11
            final = residuo == 0 ? 0 : 11 - residuo
            //comprobando codigo verificador
            if (final == digito) {
                //alert("RUC EMPRESA valido");
                bandera = false;
                return true;
            } else {
                if (aux) {
                    alert("RUC EMPRESA no valido");
                }
                identificacion.value = '';
                bandera = false;
            }
        }
    }
    if (bandera) {
        digitos = numero.split("");
        totdigitos = 10;
        total = 0;
        digito = (digitos[9] * 1);
        var i = 0;
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
            if (tipoIdentificacion == 'P') {
                return true;
            } else {
                if (aux) {
                    alert("Identificacion no valida");
                }
                identificacion.value = '';
                return false;
            }
        }
    }
}
