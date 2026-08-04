$("#frm_datosCotizacion_valorRazon").hide();
$("#frm_datosCotizacion_utilidad").setOnchange(function(newVal, oldVal) {
  let max = 500;
  let min = -200;
  console.log('min ', min);
  let value = limitMaxMin(newVal, max, min);
  value = roundToFixed(value, 2);
  $("#frm_datosCotizacion_utilidad").setValue(value);
})
$("#frm_datosCotizacion_porcentajeRazon").setOnchange(function(newVal, oldVal) {
  let max = 500;
  let min = -200;
  let value = limitMaxMin(newVal, max, min);
  if(value!=''){
    value = roundToFixed(value, 2);
  }
  $("#frm_datosCotizacion_porcentajeRazon").setValue(value);
})
$("#frm_datosCotizacion_porcentajeIncurridos").setOnchange(function(newVal, oldVal) {
  let max = 500;
  let min = -200;
  let value = limitMaxMin(newVal, max, min);
  if(value!=''){
    value = roundToFixed(value, 2);
  }
  $("#frm_datosCotizacion_porcentajeIncurridos").setValue(value);
})
$("#frm_datosCotizacion_porcentajeComision").setOnchange(function(newVal, oldVal) {
  let max = 500;
  let min = -200;
  let value = limitMaxMin(newVal, max, min);
  if(value!=''){
    value = roundToFixed(value, 2);
  }
  $("#frm_datosCotizacion_porcentajeComision").setValue(value);
})
//frm_datosCotizacion_primaGanada
//frm_datosCotizacion_resultadoTecnico
$("#frm_datosCotizacion_primaGanada").setOnchange(function(newVal, oldVal) {
  let max = 100000000;
  let min = -100000000;
  let value = limitMaxMin(newVal, max, min);
  if(value!=''){
    value = roundToFixed(value, 2);
  }
  $("#frm_datosCotizacion_primaGanada").setValue(value);
})
$("#frm_datosCotizacion_resultadoTecnico").setOnchange(function(newVal, oldVal) {
  let max = 100000000;
  let min = -100000000;
  let value = limitMaxMin(newVal, max, min);
  if(value!=''){
    value = roundToFixed(value, 2);
  }
  $("#frm_datosCotizacion_resultadoTecnico").setValue(value);
})
$("#frm_datosCotizacion_valorRazon").setOnchange(function(newVal, oldVal) {
  let max = 100000000;
  let min = -100000000;
  let value = limitMaxMin(newVal, max, min);
  if(value!=''){
    value = roundToFixed(value, 2);
  }
  $("#frm_datosCotizacion_valorRazon").setValue(value);
})
$("#frm_datosCotizacion_valorSiniestros").setOnchange(function(newVal, oldVal) {
  let max = 100000000;
  let min = -100000000;
  let value = limitMaxMin(newVal, max, min);
  if(value!=''){
    value = roundToFixed(value, 2);
  }
  $("#frm_datosCotizacion_valorSiniestros").setValue(value);
})
$("#frm_datosCotizacion_valorComision").setOnchange(function(newVal, oldVal) {
  let max = 100000000;
  let min = -100000000;
  let value = limitMaxMin(newVal, max, min);
  if(value!=''){
    value = roundToFixed(value, 2);
  }
  $("#frm_datosCotizacion_valorComision").setValue(value);
})
$("#frm_datosCotizacion_primaNeta").setOnchange(function(newVal, oldVal) {
  let max = 100000000;
  let min = -100000000;
  let value = limitMaxMin(newVal, max, min);
  if(value!=''){
    value = roundToFixed(value, 2);
  }
  $("#frm_datosCotizacion_primaNeta").setValue(value);
})
