//
$("#frm_datosSolicitud_fechaSolicitudEmision").hide();
$("#frm_datosSolicitud_emisorAsignado").hide();
$("#frm_datosSolicitud_fechaEmision").hide();
 $("#frm_emisor_asignado_apro").hide();
 $("#frm_emisor_asignado_apro").disableValidation();

function action(newVal, oldVal) {
   $("#frm_emisor_asignado_apro").disableValidation();

    if (newVal == 'CONTINUAR') {
        $("#frm_emisor_asignado_apro").show();
       $("#frm_emisor_asignado_apro").enableValidation();

    } else {
       $("#frm_emisor_asignado_apro").hide();
    }
    console.log("TIPO DE REQUERIMIENTO: " + newVal);
}
//execute when the Dynaform loads:
action($("#frm_accion").getValue(), ''); 
$('#frm_accion').setOnchange(action);
