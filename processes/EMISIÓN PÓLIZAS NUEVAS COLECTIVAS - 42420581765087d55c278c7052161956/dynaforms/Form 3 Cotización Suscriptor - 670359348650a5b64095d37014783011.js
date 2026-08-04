$("#frm_datosCotizacion_utilidad").setOnchange(function (newVal, oldVal) {
  console.log("porcentajeRazon");
  console.log(newVal);
  let max = 500;
  let min = -200;
  console.log('min ', min);
  let value = limitMaxMin(newVal, max, min);
  console.log(max, min);
  console.log(value);
  value = roundToFixed(value, 2);
  $("#frm_datosCotizacion_utilidad").setValue(value);
})

$("#frm_datosCotizacion_porcentajeRazon").setOnchange(function (newVal, oldVal) {
  console.log("porcentajeRazon");
  console.log(newVal);
  let max = 500;
  let min = -200;
  let value = limitMaxMin(newVal, max, min);
  if (value != '') {
    value = roundToFixed(value, 2);
  }
  $("#frm_datosCotizacion_porcentajeRazon").setValue(value);
})

$("#frm_datosCotizacion_porcentajeIncurridos").setOnchange(function (newVal, oldVal) {
  console.log(newVal);
  let max = 500;
  let min = -200;
  let value = limitMaxMin(newVal, max, min);
  if (value != '') {
    value = roundToFixed(value, 2);
  }
  $("#frm_datosCotizacion_porcentajeIncurridos").setValue(value);
})

$("#frm_datosCotizacion_porcentajeComision").setOnchange(function (newVal, oldVal) {
  console.log(newVal);
  let max = 500;
  let min = -200;
  let value = limitMaxMin(newVal, max, min);
  if (value != '') {
    value = roundToFixed(value, 2);
  }
  $("#frm_datosCotizacion_porcentajeComision").setValue(value);
})
//frm_datosCotizacion_primaGanada
//frm_datosCotizacion_resultadoTecnico
$("#frm_datosCotizacion_primaGanada").setOnchange(function (newVal, oldVal) {
  console.log(newVal);
  let max = 100000000;
  let min = -100000000;
  let value = limitMaxMin(newVal, max, min);
  if (value != '') {
    value = roundToFixed(value, 2);
  }
  $("#frm_datosCotizacion_primaGanada").setValue(value);
})

$("#frm_datosCotizacion_resultadoTecnico").setOnchange(function (newVal, oldVal) {
  console.log(newVal);
  let max = 100000000;
  let min = -100000000;
  let value = limitMaxMin(newVal, max, min);
  if (value != '') {
    value = roundToFixed(value, 2);
  }
  $("#frm_datosCotizacion_resultadoTecnico").setValue(value);
})

$("#frm_datosCotizacion_valorRazon").setOnchange(function (newVal, oldVal) {
  console.log(newVal);
  let max = 100000000;
  let min = -100000000;
  let value = limitMaxMin(newVal, max, min);
  if (value != '') {
    value = roundToFixed(value, 2);
  }
  $("#frm_datosCotizacion_valorRazon").setValue(value);
})

$("#frm_datosCotizacion_valorSiniestros").setOnchange(function (newVal, oldVal) {
  console.log(newVal);
  let max = 100000000;
  let min = -100000000;
  let value = limitMaxMin(newVal, max, min);
  if (value != '') {
    value = roundToFixed(value, 2);
  }
  $("#frm_datosCotizacion_valorSiniestros").setValue(value);
})

$("#frm_datosCotizacion_valorComision").setOnchange(function (newVal, oldVal) {
  console.log(newVal);
  let max = 100000000;
  let min = -100000000;
  let value = limitMaxMin(newVal, max, min);
  if (value != '') {
    value = roundToFixed(value, 2);
  }
  $("#frm_datosCotizacion_valorComision").setValue(value);
})

$("#frm_datosCotizacion_primaNeta").setOnchange(function (newVal, oldVal) {
  console.log(newVal);
  let max = 100000000;
  let min = -100000000;
  let value = limitMaxMin(newVal, max, min);
  if (value != '') {
    value = roundToFixed(value, 2);
  }
  $("#frm_datosCotizacion_primaNeta").setValue(value);
})



//
//disable frm_datosSolicitud_tipo
$("#frm_datosSolicitud_tipo").getControl().attr('disabled', true);
$("#frm_datosSolicitud_cliente").getControl().attr('disabled', true);
$("#frm_datosSolicitud_RUC").getControl().attr('disabled', true);
$("#frm_datosSolicitud_linea").getControl().attr('disabled', true);
$("#frm_datosSolicitud_ramo").getControl().attr('disabled', true);
$("#frm_datosSolicitud_sucursal").getControl().attr('disabled', true);


$("#frm_datosSolicitud_fechaDictamen1").hide();
$("#frm_datosSolicitud_suscriptorAsignado").hide();
$("#frm_datosSolicitud_fechaAsignacion").hide();
$("#frm_datosSolicitud_fechaAceptacion").hide();
$("#frm_datosSolicitud_fechaSolicitudEmision").hide();
$("#frm_datosSolicitud_emisorAsignado").hide();
$("#frm_datosSolicitud_fechaAsignacionEmisor").hide();
$("#frm_datosSolicitud_fechaEmision").hide();

$("#frm_documentos_cotizaciones").hide();

$("#datos_cotizacion_subtitle").hide();
$("#358965563650a5a9310b169033806490").hide();



function checkAccion(newVal, oldVal) {
  $("#frm_datosCotizacion_valorRazon").disableValidation();
  $("#frm_datosCotizacion_porcentajeRazon").disableValidation();
  $("#frm_datosCotizacion_primaNeta").disableValidation();
  $("#frm_datosCotizacion_valorSiniestros").disableValidation();
  $("#frm_datosCotizacion_porcentajeIncurridos").disableValidation();
  $("#frm_datosCotizacion_valorComision").disableValidation();
  $("#frm_datosCotizacion_porcentajeComision").disableValidation();
  $("#frm_datosCotizacion_primaGanada").disableValidation();
  $("#frm_datosCotizacion_utilidad").disableValidation();
  $("#frm_datosCotizacion_valorRazon").disableValidation();
  $("#frm_documentos_cotizaciones").disableValidation();
  $("#datos_cotizacion_subtitle").hide();
  $("#358965563650a5a9310b169033806490").hide();
  $("#frm_datosCotizacion_resultadoTecnico").disableValidation();

  
  if (newVal == 'CONTINUAR') {
    $("#frm_documentos_cotizaciones").show();
    //$("#frm_documentos_cotizaciones").setRequired(true);
    $("#frm_datosCotizacion_valorRazon").enableValidation();
    $("#frm_datosCotizacion_porcentajeRazon").enableValidation();
    $("#frm_datosCotizacion_primaNeta").enableValidation();
    $("#frm_datosCotizacion_valorSiniestros").enableValidation();
    $("#frm_datosCotizacion_porcentajeIncurridos").enableValidation();
    $("#frm_datosCotizacion_valorComision").enableValidation();
    $("#frm_datosCotizacion_porcentajeComision").enableValidation();
    $("#frm_datosCotizacion_primaGanada").enableValidation();
    $("#frm_datosCotizacion_utilidad").enableValidation();
    $("#frm_datosCotizacion_valorRazon").enableValidation();
    $("#frm_datosCotizacion_resultadoTecnico").enableValidation();

    $("#frm_documentos_cotizaciones").enableValidation();
    $("#datos_cotizacion_subtitle").show();
    $("#358965563650a5a9310b169033806490").show();

  } else {
    $("#frm_documentos_cotizaciones").hide();

  }
  //console.log("TIPO DE REQUERIMIENTO: " + newVal);
}
//execute when the Dynaform loads:
checkAccion($("#frm_accion").getValue(), '');
$('#frm_accion').setOnchange(checkAccion);

