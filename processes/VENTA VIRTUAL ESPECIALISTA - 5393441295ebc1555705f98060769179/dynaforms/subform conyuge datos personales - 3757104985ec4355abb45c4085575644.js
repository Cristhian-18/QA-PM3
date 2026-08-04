$("#frm_conyuge_tipo_identificacion").change( function () {
 	$('#frm_conyuge_numero_identificacion ').setValue('');
});
if(typeof validarExpresionRegular === 'function') {
	validarExpresionRegular("frm_conyuge_apellido_paterno", 1);
	validarExpresionRegular("frm_conyuge_apellido_materno", 1);
	validarExpresionRegular("frm_conyuge_primer_nombre", 1);
	validarExpresionRegular("frm_conyuge_segundo_nombre", 1);
}

$("#frm_conyuge_numero_identificacion").focusout(function () {
  var identificacion = $("#frm_numero_identificacion").getValue();
   if ($("#frm_numero_identificacion").getValue == identificacion) {
    	alert("La identificacion ingresada no puede ser la misma del asegurado");
        ("#frm_conyuge_numero_identificacion").setValue("");
    }
});


// Validar que no podria tener menos de 18 anios cumplidos o mas de 69 anios cumplidos
$("#frm_conyuge_fecha_nacimiento").setOnchange(function () {
    var fechaNacimiento = $("#frm_conyuge_fecha_nacimiento").getValue();

    if (fechaNacimiento == '') {
        return false;
    }

    var edad = calcular_edad(fechaNacimiento);

    if (edad >= 18 && edad < 69) {
        $("#frm_conyuge_fecha_nacimiento").getControl().css({ "border": "" });
        $("#frm_conyuge_fecha_nacimiento").find("span.textlabel").css("color", "");
        return true;
    } else {
        $("#frm_conyuge_fecha_nacimiento").getControl().css({ "border": "#E45061 solid 1px" });
        $("#frm_conyuge_fecha_nacimiento").find("span.textlabel").css("color", "#a94442");
        $('#frm_conyuge_fecha_nacimiento').setValue('');
        return false;
    }
});

function calcular_edad(fechaNacimiento) {
    //Split de las fecha recibida para separarla
    var x = fechaNacimiento.split("-");
    var dia = x[2];
    var mes = x[1];
    var ano = x[0];

    fecha_hoy = new Date();
    ahora_ano = fecha_hoy.getYear();
    ahora_mes = fecha_hoy.getMonth();
    ahora_dia = fecha_hoy.getDate();
    edad = (ahora_ano + 1900) - ano;

    if (ahora_mes < (mes - 1)) {
        edad--;
    }
    if (((mes - 1) == ahora_mes) && (ahora_dia < dia)) {
        edad--;
    }
    if (edad > 1900) {
        edad -= 1900;
    }

    return edad;
}

