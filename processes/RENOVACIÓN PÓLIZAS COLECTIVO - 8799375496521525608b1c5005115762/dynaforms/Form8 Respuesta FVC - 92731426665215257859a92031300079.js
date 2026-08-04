//

$("#frm_comentario").setValue('FORMULARIO VALIDADO');
$("#btn_consultar").hide();
$("#frm_datosSolicitud_emisorAsignado").hide();
$("#frm_datosSolicitud_fechaAsignacionEmisor").hide();
$("#frm_datosSolicitud_fechaEmision").hide();

function action(newVal, oldVal) {
  $("#fileComiteSuscripcion_c").hide();
   $("#fileComiteSuscripcion_c").disableValidation();
  
  if (newVal == 'CONTINUAR') {
        $("#fileComiteSuscripcion_c").show();
   		$("#fileComiteSuscripcion_c").enableValidation();
    } 
    console.log("TIPO DE REQUERIMIENTO: " + newVal);
}
//execute when the Dynaform loads:
action($("#frm_accion").getValue(), ''); 
$('#frm_accion').setOnchange(action);

