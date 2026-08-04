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
/*$("#fileComiteSuscripcion").hide();
$("#fileComiteSuscripcion").disableValidation();*/

/*if($("#tri_bandera_mda").getValue() == 'true'){
  	$("#fileComiteSuscripcion").show();
	$("#fileComiteSuscripcion").enableValidation();
}*/

function checkAccion(newVal, oldVal) {
  $("#fileComiteSuscripcion").hide();
$("#fileComiteSuscripcion").disableValidation();
    if (newVal == 'CONTINUAR') {
      if($("#tri_bandera_mda").getValue() == 'true'){
  	$("#fileComiteSuscripcion").show();
	$("#fileComiteSuscripcion").enableValidation();
}
    }


    console.log("TIPO DE ACCION: " + newVal);
}
//execute when the Dynaform loads:
checkAccion($("#frm_accion").getValue(), ''); 
$('#frm_accion').setOnchange(checkAccion);

