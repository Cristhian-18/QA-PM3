if (typeof validarExpresionRegular === 'function') {
    validarExpresionRegular("frm_representante_apellido_paterno", 1);
    validarExpresionRegular("frm_representante_apellido_materno", 1);
    validarExpresionRegular("frm_representante_primer_nombre", 1);
    validarExpresionRegular("frm_representante_segundo_nombre", 1);
}


$('#frm_representante_nacionalidad').setValue(56);


if ($('#frm_representante_numero_identificacion').getValue().length == 10) {//para cuando ya trae la cedula de la T1
    $('#frm_representante_tipo_identificacion').setValue('C');
} else if ($('#frm_representante_numero_identificacion').getValue().length != "") {//para cuando ya trae pasaporte de la T1
    $('#frm_representante_tipo_identificacion').setValue('P');
} else {
    $('#frm_representante_tipo_identificacion').setValue('');
}

$("#frm_representante_tipo_identificacion").change(function () {
    if ($("#frm_representante_tipo_identificacion option:selected").val() == 'P') {
       // $("#frm_fecha_expedicion_pasaporte, #frm_tipo_visa").parent().parent().show("slow");
    }
    else {
       // $("#frm_fecha_expedicion_pasaporte, #frm_tipo_visa").parent().parent().hide("slow");
    }

    $('#frm_representante_numero_identificacion').setValue("");
});

//Validar cedula de identidad y pasaporte
$("#frm_representante_numero_identificacion").focusout(function () {
    if (typeof validarIdentificacion === 'function') {
        var bool = validarIdentificacion($('#frm_representante_numero_identificacion').getValue(), $('#frm_representante_tipo_identificacion').getControl().val());
        if (bool == false) {
            $('#frm_numero_identificacion').setValue("");
        }
    }
});

$("#frm_representante_conyuge_numero_identificacion").focusout(function () {
    if (typeof validarIdentificacion === 'function') {
        var bool = validarIdentificacion($('#frm_representante_conyuge_numero_identificacion').getValue(), $('#frm_representante_conyuge_tipo_identificacion').getControl().val());
        if (bool == false) {
            $('#frm_representante_conyuge_numero_identificacion').setValue("");
        }
    }
});

// Validar que no podria tener menos de 18 anios cumplidos o mas de 69 anios cumplidos
$("#frm_fecha_nacimiento").setOnchange(function () {
    var fechaNacimiento = $("#frm_representante_fecha_nacimiento").getValue();

    if (fechaNacimiento == '') {
        return false;
    }

    var edad = calcular_edad(fechaNacimiento);

    if (edad >= 18 && edad < 69) {
        $("#frm_representante_fecha_nacimiento").getControl().css({ "border": "" });
        $("#frm_representante_fecha_nacimiento").find("span.textlabel").css("color", "");
        return true;
    } else {
        $("#frm_representante_fecha_nacimiento").getControl().css({ "border": "#E45061 solid 1px" });
        $("#frm_representante_fecha_nacimiento").find("span.textlabel").css("color", "#a94442");
        $('#frm_representante_fecha_nacimiento').setValue('');
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



//Sumar un dia a fecha actual
var d = new Date();
var otraFecha = d.setDate(d.getDate() + 1);
d = new Date(otraFecha);
var month = d.getMonth() + 1;
var day = d.getDate();

var fechaMasUnDia = (month < 10 ? '0' : '') + month + '/' +
    (day < 10 ? '0' : '') + day + '/' +
    d.getFullYear()





