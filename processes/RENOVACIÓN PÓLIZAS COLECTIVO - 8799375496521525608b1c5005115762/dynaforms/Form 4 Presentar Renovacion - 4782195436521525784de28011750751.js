//
$("#frm_accion").setValue('');
$("#btn_consultar").hide();
$("#frm_datosSolicitud_fechaSolicitudEmision").hide();
$("#frm_datosSolicitud_emisorAsignado").hide();
$("#frm_datosSolicitud_fechaAsignacionEmisor").hide();
$("#frm_datosSolicitud_fechaEmision").hide();


$("#frm_negocioPerdido_cobertura").disableValidation();
$("#frm_negocioPerdido_tasa").disableValidation();
$("#frm_negocioPerdido_beneficios").disableValidation();
$("#frm_negocioPerdido_prima").disableValidation();
$("#frm_negocioPerdido_comision").disableValidation();
$("#frm_negocioPerdido_medica").disableValidation();
$("#frm_negocioPerdido_honorarios").disableValidation();

function action(newVal, oldVal) {
  console.log(newVal);
    $("#id_motivo_perdida").hide();
	$("#85209770465215257843f31087684138").hide();
    $("#93586775565215257852650013099141").hide();
    $("#frm_resultadoNegociacion_resultado").hide();
    $("#frm_resultadoNegociacion_fechaAceptacion").hide();
    $("#frm_resultadoNegociacion_fechaUltimoEnvio").hide();
    $("#fle_aprobacion_cliente").hide();  
    $("#fle_mas_docs").hide();
    $("#frm_resultadoNegociacion_resultado").disableValidation();
    $("#frm_resultadoNegociacion_fechaAceptacion").disableValidation();
    $("#frm_resultadoNegociacion_fechaUltimoEnvio").disableValidation();
    $("#fle_aprobacion_cliente").disableValidation();  
    
  
  $("#frm_negocioPerdido_cobertura").disableValidation();
            $("#frm_negocioPerdido_tasa").disableValidation();
            $("#frm_negocioPerdido_beneficios").disableValidation();
            $("#frm_negocioPerdido_prima").disableValidation();
            $("#frm_negocioPerdido_comision").disableValidation();
            $("#frm_negocioPerdido_medica").disableValidation();
            $("#frm_negocioPerdido_honorarios").disableValidation();
    if (newVal == 'FINALIZAR') {
        $("#id_motivo_perdida").show();
      	$("#85209770465215257843f31087684138").show();
      $("#frm_negocioPerdido_cobertura").enableValidation();
        $("#frm_negocioPerdido_tasa").enableValidation();
        $("#frm_negocioPerdido_beneficios").enableValidation();
        $("#frm_negocioPerdido_prima").enableValidation();
        $("#frm_negocioPerdido_comision").enableValidation();
        $("#frm_negocioPerdido_medica").enableValidation();
        $("#frm_negocioPerdido_honorarios").enableValidation();
    } else  if (newVal == 'CONTINUAR'){
        $("#93586775565215257852650013099141").show();
        $("#frm_resultadoNegociacion_resultado").hide();
        $("#frm_resultadoNegociacion_fechaAceptacion").show();
        $("#frm_resultadoNegociacion_fechaUltimoEnvio").show();
        $("#fle_aprobacion_cliente").show();  
        $("#frm_resultadoNegociacion_fechaAceptacion").enableValidation();
        $("#frm_resultadoNegociacion_fechaUltimoEnvio").enableValidation();
        $("#fle_aprobacion_cliente").enableValidation();  
    } else  if (newVal == 'REVISAR'){
        $("#fle_mas_docs").show();
    }
    console.log("TIPO DE REQUERIMIENTO: " + newVal);
}
//execute when the Dynaform loads:
action($("#frm_accion").getValue(), ''); 
$('#frm_accion').setOnchange(action);
