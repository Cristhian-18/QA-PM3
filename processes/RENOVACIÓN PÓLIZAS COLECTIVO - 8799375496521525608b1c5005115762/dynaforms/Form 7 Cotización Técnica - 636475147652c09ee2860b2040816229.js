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
  $("#fileComiteSuscripcion_t").hide();
    $("#fileComiteSuscripcion_t").disableValidation();
  $("#frm_documentos_cotizaciones").disableValidation();  
     if (newVal == 'CONTINUAR'){
        $("#frm_documentos_cotizaciones").enableValidation(); 
       if ($("#tri_bandera_mda").getValue() == 'true') {
           $("#fileComiteSuscripcion_t").show();
            $("#fileComiteSuscripcion_t").enableValidation();

        }
    } 
  
    console.log("TIPO DE REQUERIMIENTO: " + newVal);
}
//execute when the Dynaform loads:
action($("#frm_accion_t").getValue(), ''); 
$('#frm_accion_t').setOnchange(action);
