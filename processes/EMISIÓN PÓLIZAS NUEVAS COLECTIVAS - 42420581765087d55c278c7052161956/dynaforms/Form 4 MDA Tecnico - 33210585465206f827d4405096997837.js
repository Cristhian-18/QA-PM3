//
//disable frm_datosSolicitud_tipo
$("#frm_datosSolicitud_tipo").getControl().attr('disabled', true);
$("#frm_datosSolicitud_cliente").getControl().attr('disabled', true);
$("#frm_datosSolicitud_RUC").getControl().attr('disabled', true);
$("#frm_datosSolicitud_linea").getControl().attr('disabled', true);
$("#frm_datosSolicitud_ramo").getControl().attr('disabled', true);
$("#frm_datosSolicitud_sucursal").getControl().attr('disabled', true);

$("#frm_datosCotizacion_primaGanada").getControl().attr('disabled', true);
$("#frm_datosCotizacion_resultadoTecnico").getControl().attr('disabled', true);
$("#frm_datosCotizacion_valorRazon").getControl().attr('disabled', true);
$("#frm_datosCotizacion_porcentajeRazon").getControl().attr('disabled', true);
$("#frm_datosCotizacion_primaNeta").getControl().attr('disabled', true);
$("#frm_datosCotizacion_valorSiniestros").getControl().attr('disabled', true);
$("#frm_datosCotizacion_porcentajeIncurridos").getControl().attr('disabled', true);
$("#frm_datosCotizacion_valorComision").getControl().attr('disabled', true);
$("#frm_datosCotizacion_porcentajeComision").getControl().attr('disabled', true);


$("#frm_datosSolicitud_fechaDictamen1").hide();
$("#frm_datosSolicitud_suscriptorAsignado").hide();
$("#frm_datosSolicitud_fechaAsignacion").hide();
$("#frm_datosSolicitud_fechaAceptacion").hide();
$("#frm_datosSolicitud_fechaSolicitudEmision").hide();
$("#frm_datosSolicitud_emisorAsignado").hide();
$("#frm_datosSolicitud_fechaAsignacionEmisor").hide();
$("#frm_datosSolicitud_fechaEmision").hide();


//para el comite


function checkAccion(newVal, oldVal) {
    $("#fileComiteSuscripcion_t").hide();
    $("#fileComiteSuscripcion_t").disableValidation();
    if (newVal == 'CONTINUAR') {
        if ($("#tri_bandera_mda").getValue() == 'true') {
            $("#fileComiteSuscripcion_t").show();
            $("#fileComiteSuscripcion_t").enableValidation();

        }
    }
    console.log("TIPO DE ACCION: " + newVal);
}
//execute when the Dynaform loads:
checkAccion($("#frm_accion_t").getValue(), '');
$('#frm_accion_t').setOnchange(checkAccion);
