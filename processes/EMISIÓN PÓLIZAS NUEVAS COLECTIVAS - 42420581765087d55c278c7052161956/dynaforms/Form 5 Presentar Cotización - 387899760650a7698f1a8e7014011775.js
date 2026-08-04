
$("#frm_datosCotizacion_primaGanada").getControl().attr('disabled', true);
$("#frm_datosCotizacion_resultadoTecnico").getControl().attr('disabled', true);
$("#frm_datosSolicitud_tipo").getControl().attr('disabled', true);
$("#frm_datosSolicitud_cliente").getControl().attr('disabled', true);
$("#frm_datosSolicitud_RUC").getControl().attr('disabled', true);
$("#frm_datosSolicitud_linea").getControl().attr('disabled', true);
$("#frm_datosSolicitud_ramo").getControl().attr('disabled', true);
$("#frm_datosSolicitud_sucursal").getControl().attr('disabled', true);
$("#frm_datosSolicitud_fechaDictamen1").getControl().attr('disabled', true);
$("#frm_datosSolicitud_suscriptorAsignado").getControl().attr('disabled', true);
$("#frm_datosSolicitud_fechaAsignacion").getControl().attr('disabled', true);
$("#frm_datosSolicitud_fechaAceptacion").getControl().attr('disabled', true);

$("#frm_datosCotizacion_valorRazon").getControl().attr('disabled', true);
$("#frm_datosCotizacion_porcentajeRazon").getControl().attr('disabled', true);
$("#frm_datosCotizacion_primaNeta").getControl().attr('disabled', true);
$("#frm_datosCotizacion_valorSiniestros").getControl().attr('disabled', true);
$("#frm_datosCotizacion_porcentajeIncurridos").getControl().attr('disabled', true);
$("#frm_datosCotizacion_valorComision").getControl().attr('disabled', true);
$("#frm_datosCotizacion_porcentajeComision").getControl().attr('disabled', true);


$("#frm_datosSolicitud_fechaSolicitudEmision").hide();
$("#frm_datosSolicitud_emisorAsignado").hide();
$("#frm_datosSolicitud_fechaAsignacionEmisor").hide();
$("#frm_datosSolicitud_fechaEmision").hide();
$("#frm_resultadoNegociacion_resultado").hide();
$("#subtitle_negociacion").hide();
$("#510095491651a66113161d7002412751").hide();
$("#frm_cotizacion_a_revisar").hide();
$("#frm_cotizacion_a_revisar").disableValidation();

$("#frm_negocioPerdido_cobertura").disableValidation();
$("#frm_negocioPerdido_tasa").disableValidation();
$("#frm_negocioPerdido_beneficios").disableValidation();
$("#frm_negocioPerdido_prima").disableValidation();
$("#frm_negocioPerdido_comision").disableValidation();
$("#frm_negocioPerdido_medica").disableValidation();
$("#frm_negocioPerdido_honorarios").disableValidation();


function action(newVal, oldVal) {
    $("#subtitle_negociacion").hide();
    $("#510095491651a66113161d7002412751").hide();
    $("#id_motivo_perdida").hide();
    $("#140054546651a5134491bd0069393363").hide();
    $("#fle_cotizacion_aceptada").disableValidation();
    $("#fle_aprobacion_cliente").disableValidation();
    $("#frm_resultadoNegociacion_fechaAceptacion").disableValidation();
    $("#frm_resultadoNegociacion_fechaUltimoEnvio").disableValidation();

  	$("#frm_cotizacion_a_revisar").hide();
    $("#frm_cotizacion_a_revisar").disableValidation();
  
    $("#frm_negocioPerdido_cobertura").disableValidation();
            $("#frm_negocioPerdido_tasa").disableValidation();
            $("#frm_negocioPerdido_beneficios").disableValidation();
            $("#frm_negocioPerdido_prima").disableValidation();
            $("#frm_negocioPerdido_comision").disableValidation();
            $("#frm_negocioPerdido_medica").disableValidation();
            $("#frm_negocioPerdido_honorarios").disableValidation();

    if (newVal == 'FINALIZAR') {
        $("#id_motivo_perdida").show();
        $("#140054546651a5134491bd0069393363").show();
        $("#frm_negocioPerdido_cobertura").enableValidation();
        $("#frm_negocioPerdido_tasa").enableValidation();
        $("#frm_negocioPerdido_beneficios").enableValidation();
        $("#frm_negocioPerdido_prima").enableValidation();
        $("#frm_negocioPerdido_comision").enableValidation();
        $("#frm_negocioPerdido_medica").enableValidation();
        $("#frm_negocioPerdido_honorarios").enableValidation();

    } else if (newVal == 'CONTINUAR') {
        $("#subtitle_negociacion").show();
        $("#510095491651a66113161d7002412751").show();
        $("#fle_cotizacion_aceptada").enableValidation();
        $("#fle_aprobacion_cliente").enableValidation();
        $("#frm_resultadoNegociacion_fechaAceptacion").enableValidation();
        $("#frm_resultadoNegociacion_fechaUltimoEnvio").enableValidation();

    } else if (newVal == 'REVISAR') {
        $("#frm_cotizacion_a_revisar").show();
        $("#frm_cotizacion_a_revisar").enableValidation();
    }
    console.log("TIPO DE REQUERIMIENTO: " + newVal);
}
//execute when the Dynaform loads:
action($("#frm_accion").getValue(), '');
$('#frm_accion').setOnchange(action);


