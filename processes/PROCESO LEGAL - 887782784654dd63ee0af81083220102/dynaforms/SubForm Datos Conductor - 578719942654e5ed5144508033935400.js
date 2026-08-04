//henry
let tipoSolicitud = $("#frm_asegurado_tipo").getValue();
if (tipoSolicitud == 'A') {
let cedula = $("#frm_busqueda_identificacion").getValue();
let nombres = $("#frm_busqueda_nombres").getValue();
let telefono = $("#frm_busqueda_celular_1").getValue();

  $("#frm_asegurado_identificacion").setValue(cedula);
  $("#frm_asegurado_nombres").setValue(nombres);
  $("#frm_asegurado_telefono").setValue(telefono);  
  
  $("#frm_asegurado_relacion").hide();
  $("#frm_asegurado_relacion_otro").hide();
  $("#frm_asegurado_relacion").hide();
  $("#frm_asegurado_relacion_otro").hide();
} 


function checkDatosConductor(newVal, oldVal) {
  if (newVal == 'A') {
    let cedula = $("#frm_busqueda_identificacion").getValue();
    let nombres = $("#frm_busqueda_nombres").getValue();
    let telefono = $("#frm_busqueda_celular_1").getValue();

      /*$("#frm_asegurado_identificacion").setValue(cedula);
      $("#frm_asegurado_nombres").setValue(nombres);
      $("#frm_asegurado_telefono").setValue(telefono);  */
      
      $("#frm_asegurado_relacion").hide();
      $("#frm_asegurado_relacion_otro").hide();
  } else {
    /*$("#frm_asegurado_identificacion").setValue('');
      $("#frm_asegurado_nombres").setValue('');
      $("#frm_asegurado_telefono").setValue('');  
      */
    $("#frm_asegurado_relacion").show();
    $("#frm_asegurado_relacion_otro").show();
    

  }
  console.log("TIPO DE REQUERIMIENTO: " + newVal);
}
//execute when the Dynaform loads:
checkDatosConductor($("#frm_asegurado_tipo").getValue(), ''); 
$('#frm_asegurado_tipo').setOnchange(checkDatosConductor);