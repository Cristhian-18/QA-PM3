//
$("#frm_datosSolicitud_fechaSolicitudEmision").hide();
$("#frm_datosSolicitud_emisorAsignado").hide();
$("#frm_datosSolicitud_fechaEmision").hide();

function action(newVal, oldVal) {
  $("#frm_emisor_asignado").disableValidation();
    if (newVal == 'CONTINUAR') {
        $("#frm_emisor_asignado").show();
        $("#frm_emisor_asignado").enableValidation();

    } else {
       $("#frm_emisor_asignado").hide();
    }
    console.log("TIPO DE REQUERIMIENTO: " + newVal);
}
//execute when the Dynaform loads:
action($("#frm_accion").getValue(), ''); 
$('#frm_accion').setOnchange(action);
