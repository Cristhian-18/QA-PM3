//

$("#frm_comentario").setValue('FORMULARIO VALIDADO');


$("#frm_datosSolicitud_emisorAsignado").hide();
$("#frm_datosSolicitud_fechaAsignacionEmisor").hide();
$("#frm_datosSolicitud_fechaEmision").hide();

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

function checkAccion(newVal, oldVal) {
   
  $("#fileComiteSuscripcion").hide();
        $("#fileComiteSuscripcion").disableValidation();
  if (newVal == 'CONTINUAR') {
        $("#fileComiteSuscripcion").show();
        $("#fileComiteSuscripcion").enableValidation();
    } 
    console.log("TIPO DE REQUERIMIENTO: " + newVal);
}
//execute when the Dynaform loads:
checkAccion($("#frm_accion").getValue(), '');
$('#frm_accion').setOnchange(checkAccion);


