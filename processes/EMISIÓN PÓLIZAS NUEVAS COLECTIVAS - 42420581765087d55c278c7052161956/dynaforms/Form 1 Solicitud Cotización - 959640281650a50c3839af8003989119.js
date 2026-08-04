/*frm_datosCotizacion_primaNeta
frm_datosCotizacion_primaGanada
frm_datosCotizacion_resultadoTecnico
frm_datosCotizacion_utilidad
frm_datosCotizacion_valorRazon
frm_datosCotizacion_porcentajeRazon
frm_datosCotizacion_valorSiniestros
frm_datosCotizacion_porcentajeIncurridos
frm_datosCotizacion_valorComision
frm_datosCotizacion_porcentajeComision
*/
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
    if (newVal == 'Emision') {
      console.log("EMISION");
               $("#frm_datosCotizacion_primaNeta").enableValidation();
$("#frm_datosCotizacion_primaGanada").enableValidation();
$("#frm_datosCotizacion_resultadoTecnico").enableValidation();
$("#frm_datosCotizacion_utilidad").enableValidation();
$("#frm_datosCotizacion_valorRazon").enableValidation();
$("#frm_datosCotizacion_porcentajeRazon").enableValidation();
$("#frm_datosCotizacion_valorSiniestros").enableValidation();
$("#frm_datosCotizacion_porcentajeIncurridos").enableValidation();
$("#frm_datosCotizacion_valorComision").enableValidation();
$("#frm_datosCotizacion_porcentajeComision").enableValidation();
        $("#datos_cotizacion_subtitle").show();
      	$("#358965563650a5a9310b169033806490").show();
    } else {
       $("#datos_cotizacion_subtitle").hide();
      	$("#358965563650a5a9310b169033806490").hide();
    }
}
//execute when the Dynaform loads:
checkTipoRequerimiento($("#frm_datosSolicitud_tipo").getValue(), ''); 
$('#frm_datosSolicitud_tipo').setOnchange(checkTipoRequerimiento);

function checkAccion(newVal, oldVal) {
    if (newVal == 'CONTINUAR') {
        $("#frm_documentos_cotizaciones").show();
        //$("#frm_documentos_cotizaciones").setRequired(true);

    } else {
       $("#frm_documentos_cotizaciones").hide();
    }
    console.log("TIPO DE ACCION: " + newVal);
}
//execute when the Dynaform loads:
checkAccion($("#frm_accion").getValue(), ''); 
$('#frm_accion').setOnchange(checkAccion);

