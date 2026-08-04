//
$("#frm_datosSolicitud_fechaDictamen1").hide();
$("#frm_datosSolicitud_suscriptorAsignado").hide();
$("#frm_datosSolicitud_fechaAsignacion").hide();
$("#frm_datosSolicitud_fechaAceptacion").hide();
$("#frm_datosSolicitud_fechaSolicitudEmision").hide();
$("#frm_datosSolicitud_emisorAsignado").hide();
$("#frm_datosSolicitud_fechaAsignacionEmisor").hide();
$("#frm_datosSolicitud_fechaEmision").hide();
$("#2639520526521525784c9b0091535232").hide();
$("#datos_cotizacion_subtitle").hide();

function checkTipoRequerimiento(newVal, oldVal) {
    if (newVal == 'Emision') {
        $("#datos_cotizacion_subtitle").show();
      	$("#2639520526521525784c9b0091535232").show();
    } else {
       $("#datos_cotizacion_subtitle").hide();
      	$("#2639520526521525784c9b0091535232").hide();
    }
    console.log("TIPO DE REQUERIMIENTO: " + newVal);
}
//execute when the Dynaform loads:
checkTipoRequerimiento($("#frm_datosSolicitud_tipo").getValue(), ''); 
$('#frm_datosSolicitud_tipo').setOnchange(checkTipoRequerimiento);


function action(newVal, oldVal) {
    if (newVal == 'CONTINUAR') {
        $("#frm_suscriptor_asignado").show();
      $("#frm_suscriptor_asignado").getControl().attr('required', true);

    } else {
      	$("#frm_suscriptor_asignado").hide();
    }
    console.log("TIPO DE REQUERIMIENTO: " + newVal);
}
//execute when the Dynaform loads:
action($("#frm_accion").getValue(), ''); 
$('#frm_accion').setOnchange(action);
