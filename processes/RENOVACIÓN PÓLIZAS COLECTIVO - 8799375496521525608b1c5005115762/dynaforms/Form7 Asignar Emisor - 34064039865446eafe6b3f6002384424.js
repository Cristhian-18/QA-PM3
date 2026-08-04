//disable frm_datosSolicitud_tipo
$("#frm_emisor_asignado").setValue('');
$("#frm_datosSolicitud_fechaDictamen1").hide();
$("#frm_datosSolicitud_suscriptorAsignado").hide();
$("#frm_datosSolicitud_fechaAsignacion").hide();
$("#frm_datosSolicitud_fechaAceptacion").hide();
$("#frm_datosSolicitud_fechaSolicitudEmision").hide();
$("#frm_datosSolicitud_emisorAsignado").hide();
$("#frm_datosSolicitud_fechaAsignacionEmisor").hide();
$("#frm_datosSolicitud_fechaEmision").hide();
$("#btn_consultar").hide();
$("#subtitle_negociacion").hide();
	$("#510095491651a66113161d7002412751").hide();
function action(newVal, oldVal) {
    $("#fle_borrador_poliza").hide();
    $("#fle_borrador_poliza").disableValidation();

    if (newVal == 'CONTINUAR') {
        $("#fle_borrador_poliza").show();
        $("#fle_borrador_poliza").enableValidation();

    }
}
//execute when the Dynaform loads:
action($("#frm_accion").getValue(), '');
$('#frm_accion').setOnchange(action);