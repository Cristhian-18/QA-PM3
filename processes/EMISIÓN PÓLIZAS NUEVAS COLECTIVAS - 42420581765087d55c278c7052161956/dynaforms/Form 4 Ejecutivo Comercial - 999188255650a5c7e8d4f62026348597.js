//
//disable frm_datosSolicitud_tipo



$("#frm_datosSolicitud_fechaDictamen1").hide();
$("#frm_datosSolicitud_suscriptorAsignado").hide();
$("#frm_datosSolicitud_fechaAsignacion").hide();
$("#frm_datosSolicitud_fechaAceptacion").hide();
$("#frm_datosSolicitud_fechaSolicitudEmision").hide();
$("#frm_datosSolicitud_emisorAsignado").hide();
$("#frm_datosSolicitud_fechaAsignacionEmisor").hide();
$("#frm_datosSolicitud_fechaEmision").hide();

//comité
$("#fileComiteSuscripcion").disableValidation();

//para el comite


function checkAccion(newVal, oldVal) {
    $("#fileComiteSuscripcion").hide();
    $("#fileComiteSuscripcion").disableValidation();
  	console.log('CAMBIO');
    if (newVal == 'CONTINUAR') {
        if ($("#tri_bandera_mda").getValue() == 'true') {
            $("#fileComiteSuscripcion").show();
            $("#fileComiteSuscripcion").enableValidation();
        }
    }
    console.log("TIPO DE ACCION: " + newVal);
}
//execute when the Dynaform loads:
checkAccion($("#frm_accion_c").getValue(), '');
$('#frm_accion_c').setOnchange(checkAccion);