$("#frm_datosSolicitud_fechaSolicitudEmision").hide();
$("#frm_datosSolicitud_emisorAsignado").hide();
$("#frm_datosSolicitud_fechaAsignacionEmisor").hide();
$("#frm_datosSolicitud_fechaEmision").hide();
$("#frm_datosSolicitud_suscriptorAsignado").hide();
$("#frm_datosSolicitud_fechaAsignacion").hide();
$("#frm_datosSolicitud_fechaAceptacion").hide();
$("#frm_datosSolicitud_fechaDictamen1").hide();

/*$("#frm_datosCotizacion_valorRazon").getControl().attr('disabled', true);
$("#frm_datosCotizacion_porcentajeRazon").getControl().attr('disabled', true);
$("#frm_datosCotizacion_primaNeta").getControl().attr('disabled', true);
$("#frm_datosCotizacion_valorSiniestros").getControl().attr('disabled', true);
$("#frm_datosCotizacion_porcentajeIncurridos").getControl().attr('disabled', true);
$("#frm_datosCotizacion_valorComision").getControl().attr('disabled', true);
$("#frm_datosCotizacion_porcentajeComision").getControl().attr('disabled', true);
*/


function action(newVal, oldVal) {
    $("#5565803366521525785fc60084171987").hide();
    $("#frm_documentos_cotizaciones").disableValidation();
    $("#sub_condiciones").hide();

    if (newVal == 'CONTINUAR') {
        $("#5565803366521525785fc60084171987").show();
        $("#frm_documentos_cotizaciones").enableValidation();
        $("#sub_condiciones").show();

    }
    console.log("TIPO DE REQUERIMIENTO: " + newVal);
}
//execute when the Dynaform loads:
action($("#frm_accion").getValue(), '');
$('#frm_accion').setOnchange(action);
