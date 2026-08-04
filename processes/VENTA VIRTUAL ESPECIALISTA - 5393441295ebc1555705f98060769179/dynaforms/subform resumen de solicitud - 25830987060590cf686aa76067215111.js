var prod =$("#frm_producto").getValue(); 
//alert (prod);

$('#frm_aps_codigo_tipoAgente').hide();



calcular_edad();
function calcular_edad() {

  var fecha = $('#frm_fecha_nacimiento').getValue();
  //alert (fecha);
  var hoy = new Date();

  var fechaNacimiento = new Date(fecha);
  fechaNacimiento.setDate(fechaNacimiento.getDate() + 1);
  //  alert (hoy);  
  //  alert (fechaNacimiento);
  var edad = hoy.getFullYear() - fechaNacimiento.getFullYear();
  var diferenciaMeses = hoy.getMonth() - fechaNacimiento.getMonth();
  var diferenciaDias = hoy.getDay() - fechaNacimiento.getDay();

  if (
    diferenciaMeses < 0 || (diferenciaMeses === 0 && hoy.getDate() < fechaNacimiento.getDate())
  ) {
    edad--
  }
  //alert (edad);
  $("#frm_cliente_edad").setValue(edad);
}