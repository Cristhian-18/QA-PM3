$("#frm_datosSolicitud_fechaSolicitudEmision").hide();
$("#frm_datosSolicitud_emisorAsignado").hide();
$("#frm_datosSolicitud_fechaAsignacionEmisor").hide();
$("#frm_datosSolicitud_fechaEmision").hide();
$("#frm_datosSolicitud_suscriptorAsignado").hide();
$("#frm_datosSolicitud_fechaAsignacion").hide();
$("#frm_datosSolicitud_fechaAceptacion").hide();
$("#frm_datosSolicitud_fechaDictamen1").hide();


$("#frm_resultadoNegociacion_fechaAceptacion").hide();
$("#frm_resultadoNegociacion_fechaUltimoEnvio").hide();
$("#fle_aprobacion_cliente").hide();
$("#frm_resultadoNegociacion_fechaAceptacion").disableValidation();
$("#frm_resultadoNegociacion_fechaUltimoEnvio").disableValidation();
$("#fle_aprobacion_cliente").disableValidation();
$("#frm_resultadoNegociacion_resultado").disableValidation();

$("#frm_documentos_cotizaciones").enableValidation();  

function action(newVal, oldVal) {
  console.log(newVal);
  $("#frm_documentos_cotizaciones").disableValidation();  
     if (newVal == 'CONTINUAR'){
        $("#frm_documentos_cotizaciones").enableValidation();  
    } 
    console.log("TIPO DE REQUERIMIENTO: " + newVal);
}
//execute when the Dynaform loads:
action($("#frm_accion_c").getValue(), ''); 
$('#frm_accion_c').setOnchange(action);
