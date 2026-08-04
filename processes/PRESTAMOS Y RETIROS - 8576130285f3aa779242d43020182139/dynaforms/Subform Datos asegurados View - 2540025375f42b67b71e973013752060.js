validacionCedula();

//Cuando seleccione opcion pasaporte, debera desplegar
//Fecha de expedicion del pasaporte		Fecha de caducidad del pasaporte
//Tipo de Visa		Fecha de ingreso al pais
//$("#frm_fecha_expedicion_pasaporte, #frm_tipo_visa").parent().parent().hide();

//if ($('#frm_numero_identificacion').getValue().length == 10) {//para cuando ya trae la cedula de la T1
    //$('#frm_tipo_identificacion').setValue('C');
//} else if ($('#frm_numero_identificacion').getValue().length != "") {//para cuando ya trae pasaporte de la T1
    //$('#frm_tipo_identificacion').setValue('P');
//} else {
  //  $('#frm_tipo_identificacion').setValue('');
//}
function validacionCedula(){
  var ced = $("#frm_tipo_identificacion").getControl().val();
  
	 if (ced  == 'P') {
        $("#frm_fecha_expedicion_pasaporte, #frm_tipo_visa").parent().parent().show("slow");
      	$("#frm_fecha_expedicion_pasaporte").enableValidation();
        $("#frm_tipo_visa").enableValidation();
        $("#frm_fecha_ingreso_pais").enableValidation();
        $("#frm_fecha_caducidad_pasaporte").enableValidation();
    }
    else {
        $("#frm_fecha_expedicion_pasaporte, #frm_tipo_visa").parent().parent().hide("slow");
       $("#frm_fecha_expedicion_pasaporte, #frm_tipo_visa").setValue('');
      	$("#frm_fecha_expedicion_pasaporte").disableValidation();
        $("#frm_tipo_visa").disableValidation();
      $("#frm_tipo_visa").setValue('');
        $("#frm_fecha_ingreso_pais").disableValidation();
        $("#frm_fecha_caducidad_pasaporte").disableValidation();
      $("#frm_fecha_ingreso_pais").setValue('');
        $("#frm_fecha_caducidad_pasaporte").setValue('');
    }
}

$("#frm_tipo_identificacion").change(function () {
   
	validacionCedula();
    $('#frm_numero_identificacion').setValue("");
});

//Validar cedula de identidad y pasaporte
$("#frm_numero_identificacion").focusout(function () {
    if (typeof validarIdentificacion === 'function') {
        var bool = validarIdentificacion($('#frm_numero_identificacion').getValue(), $('#frm_tipo_identificacion').getControl().val());
        if (bool == false) {
            $('#frm_numero_identificacion').setValue("");
        }
    }
});

$("#frm_conyuge_numero_identificacion").focusout(function () {
    if (typeof validarIdentificacion === 'function') {
        var bool = validarIdentificacion($('#frm_conyuge_numero_identificacion').getValue(), $('#frm_conyuge_tipo_identificacion').getControl().val());
        if (bool == false) {
            $('#frm_conyuge_numero_identificacion').setValue("");
        }
    }
});

// Validar que no podria tener menos de 18 anios cumplidos o mas de 69 anios cumplidos
$("#frm_fecha_nacimiento").setOnchange(function () {
    var fechaNacimiento = $("#frm_fecha_nacimiento").getValue();

    if (fechaNacimiento == '') {
        return false;
    }

    var edad = calcular_edad(fechaNacimiento);

    if (edad >= 18 && edad <=79) {
        $("#frm_fecha_nacimiento").getControl().css({ "border": "" });
        $("#frm_fecha_nacimiento").find("span.textlabel").css("color", "");
        return true;
    } else {
        $("#frm_fecha_nacimiento").getControl().css({ "border": "#E45061 solid 1px" });
        $("#frm_fecha_nacimiento").find("span.textlabel").css("color", "#a94442");
        $('#frm_fecha_nacimiento').setValue('');
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

// Validar Numero de hijos
$("#frm_numero_hijos").focusout(function () {
    var numeroHijos = $("#frm_numero_hijos").getValue();

    if (numeroHijos >= 0 && numeroHijos <= 10) {
        $(this).getControl().css({ "border": "" })
        $(this).find("span.textlabel").css("color", "");
        return true;
    } else {
        $(this).getControl().css({ "border": "#E45061 solid 1px" })
        $(this).find("span.textlabel").css("color", "#a94442");
        $(this).setValue('');
        return false;
    }
});

//Sumar un dia a fecha actual
var d = new Date();
var otraFecha = d.setDate(d.getDate() + 1);
d = new Date(otraFecha);
var month = d.getMonth() + 1;
var day = d.getDate();

var fechaMasUnDia = (month < 10 ? '0' : '') + month + '/' +
    (day < 10 ? '0' : '') + day + '/' +
    d.getFullYear()

// Validar Fecha de ingreso al pais
$("#frm_fecha_ingreso_pais").focusout(function () {
    validarFechaExpedicionPasaporte('#frm_fecha_ingreso_pais', fechaMasUnDia, 1);
});

// Validar Fecha de expedicion del pasaporte
$("#frm_fecha_expedicion_pasaporte, #frm_fecha_nacimiento").focusout(function () {
    validarFechaExpedicionPasaporte('#frm_fecha_expedicion_pasaporte', $('#frm_fecha_nacimiento').getValue(), 0);
});

// Validar Fecha de caducidad del pasaporte
$("#frm_fecha_caducidad_pasaporte, #frm_fecha_expedicion_pasaporte").focusout(function () {
    validarFechaExpedicionPasaporte('#frm_fecha_caducidad_pasaporte', $('#frm_fecha_expedicion_pasaporte').getValue(), 0);
});

function validarFechaExpedicionPasaporte(idFecha1, fechaDos, bandera) {

    var fechaUno = $(idFecha1).getValue();
    //var fechaDos = $(idFecha2).getValue();

    //Validar si uno de los dos campos esta vacio
    if (fechaUno.length != 10 || fechaDos.length != 10)
        return false;

    //Split de las fechas recibidas para separarlas
    var x = fechaUno.split("-");
    var y = fechaDos.split("-");

    //Cambiamos el orden al formato americano, de esto dd/mm/yyyy a esto mm/dd/yyyy
    var fechaUno = x[1] + "-" + x[2] + "-" + x[0];
    var fechaDos = y[1] + "-" + y[2] + "-" + y[0];

    //Comparamos las fechas
    if (bandera == 1) {//Esta parte es para reutilizar el codigo al "Validar Fecha de ingreso al pais"
        var aux1 = fechaUno;
        var aux2 = fechaDos;

        fechaUno = aux2;
        fechaDos = aux1;
    }

    if (Date.parse(fechaUno) > Date.parse(fechaDos)) {
        $(idFecha1).getControl().css({ "border": "" })
        $(idFecha1).find("span.textlabel").css("color", "");
        return true;
    } else {
        $(idFecha1).getControl().css({ "border": "#E45061 solid 1px" })
        $(idFecha1).find("span.textlabel").css("color", "#a94442");
        $(idFecha1).setValue('');
        return false;
    }
}



