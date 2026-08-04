//disable frm_datosSolicitud_tipo
$("#frm_datosSolicitud_fechaDictamen1").hide();
$("#frm_datosSolicitud_suscriptorAsignado").hide();
$("#frm_datosSolicitud_fechaAsignacion").hide();
$("#frm_datosSolicitud_fechaAceptacion").hide();
$("#frm_datosSolicitud_fechaSolicitudEmision").hide();
$("#frm_datosSolicitud_emisorAsignado").hide();
$("#frm_datosSolicitud_fechaAsignacionEmisor").hide();
$("#frm_datosSolicitud_fechaEmision").hide();

  $("#fileComiteSuscripcion").hide();
$("#fileComiteSuscripcion").disableValidation();

function checkAccion(newVal, oldVal) {
  $("#fileComiteSuscripcion").hide();
  $("#fileComiteSuscripcion").disableValidation();
    if (newVal == 'CONTINUAR') {
      if ($("#tri_bandera_mda").getValue() == 'true') {
            $("#fileComiteSuscripcion").show();
            $("#fileComiteSuscripcion").enableValidation();

        }
    } 
}
//execute when the Dynaform loads:
checkAccion($("#frm_accion_t").getValue(), ''); 
$('#frm_accion_t').setOnchange(checkAccion);