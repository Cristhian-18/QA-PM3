//
$("#frm_datosSolicitud_fechaDictamen1").hide();
$("#frm_datosSolicitud_suscriptorAsignado").hide();
$("#frm_datosSolicitud_fechaAsignacion").hide();
$("#frm_datosSolicitud_fechaAceptacion").hide();
$("#frm_datosSolicitud_fechaSolicitudEmision").hide();
$("#frm_datosSolicitud_emisorAsignado").hide();
$("#frm_datosSolicitud_fechaAsignacionEmisor").hide();
$("#frm_datosSolicitud_fechaEmision").hide();
$("#358965563650a5a9310b169033806490").hide();
$("#datos_cotizacion_subtitle").hide();

$("#frm_datosCotizacion_primaNeta").disableValidation();
$("#frm_datosCotizacion_primaGanada").disableValidation();
$("#frm_datosCotizacion_resultadoTecnico").disableValidation();
$("#frm_datosCotizacion_utilidad").disableValidation();
$("#frm_datosCotizacion_valorRazon").disableValidation();
$("#frm_datosCotizacion_porcentajeRazon").disableValidation();
$("#frm_datosCotizacion_valorSiniestros").disableValidation();
$("#frm_datosCotizacion_porcentajeIncurridos").disableValidation();
$("#frm_datosCotizacion_valorComision").disableValidation();
$("#frm_datosCotizacion_porcentajeComision").disableValidation();


function checkTipoRequerimiento(newVal, oldVal) {
    if (newVal == 'Emision') {
        $("#datos_cotizacion_subtitle").show();
      	$("#358965563650a5a9310b169033806490").show();
    } else {
       $("#datos_cotizacion_subtitle").hide();
      	$("#358965563650a5a9310b169033806490").hide();
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
