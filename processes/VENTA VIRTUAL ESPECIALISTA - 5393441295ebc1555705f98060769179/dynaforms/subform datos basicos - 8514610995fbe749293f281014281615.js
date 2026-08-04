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
    else
    {
      console.log("validacion correcta");
      consultar_cliente(25);
      //consultar_equifax_cliente();
    }
  }
});

$("#frm_conyuge_numero_identificacion").focusout(function () {
  if (typeof validarIdentificacion === 'function') {
    var bool = validarIdentificacion($('#frm_conyuge_numero_identificacion').getValue(), $('#frm_conyuge_tipo_identificacion').getControl().val());
    if (bool == false) {
      $('#frm_conyuge_numero_identificacion').setValue("");
    }
        else
    {
      consultar_conyuge();
    }
  }
});

// Validar que no podria tener menos de 18 anios cumplidos o mas de 79 anios cumplidos
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
    alert("Debe tener entre 18 y 79 anios");

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
/*
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
*/

$("#frm_fecha_nacimiento, #frm_fecha_ingreso_pais, #frm_fecha_expedicion_pasaporte, #frm_fecha_caducidad_pasaporte").focusout(function () {

  var nacimiento = $("#frm_fecha_nacimiento").getValue();
  var ingreso =  $("#frm_fecha_ingreso_pais").getValue();
  var expedicion =  $("#frm_fecha_expedicion_pasaporte").getValue();
  var caducidad =  $("#frm_fecha_caducidad_pasaporte").getValue();

  // alert(nacimiento + " --- " + ingreso + " --- " + expedicion + " --- " + caducidad);

  id = $(this).getControl().attr("id");
  // alert(id);

  // if(id == "form[frm_fecha_nacimiento]" && expedicion < nacimiento){
  // $("#frm_fecha_nacimiento").setValue('');
  // }

  if(id == "form[frm_fecha_ingreso_pais]" && (expedicion > ingreso || nacimiento > ingreso)){
    $("#frm_fecha_ingreso_pais").setValue('');
  }

  // if(id == "form[frm_fecha_expedicion_pasaporte]" && (expedicion > ingreso || expedicion > caducidad)){ 
  // $("#frm_fecha_expedicion_pasaporte").setValue('');
  // }

  if(ingreso != ""){
    if(id == "form[frm_fecha_expedicion_pasaporte]" && expedicion > ingreso){ 
      $("#frm_fecha_expedicion_pasaporte").setValue('');
    }			
  }

  if(caducidad != ""){
    if(id == "form[frm_fecha_expedicion_pasaporte]" && expedicion >= caducidad){ 
      $("#frm_fecha_expedicion_pasaporte").setValue('');
    }			
  }




  if(id == "form[frm_fecha_caducidad_pasaporte]" && expedicion >= caducidad){
    $("#frm_fecha_caducidad_pasaporte").setValue('');
  }

});
