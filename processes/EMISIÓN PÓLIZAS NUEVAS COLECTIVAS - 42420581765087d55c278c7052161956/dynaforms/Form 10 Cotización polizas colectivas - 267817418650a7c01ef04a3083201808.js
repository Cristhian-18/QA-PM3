$("#407570177650a77c6486366046710718").hide();
$("#subtitble_borrador").hide();
$("#frm_datosEmision_numPoliza").disableValidation();
$("#frm_datosEmision_numEndoso").disableValidation();
$("#fle_poliza").disableValidation();
$("#file_borrador_negado").hide();
$("#file_borrador_negado").disableValidation();

function action(newVal, oldVal) {
  $("#407570177650a77c6486366046710718").hide();
  $("#subtitble_borrador").hide();
  $("#frm_emisor_asignado").disableValidation();
  $("#frm_datosEmision_numPoliza").disableValidation();
  $("#frm_datosEmision_numEndoso").disableValidation();
  $("#fle_poliza").disableValidation();
  $("#frm_datosEmision_fechaEmision").disableValidation();
  $("#file_borrador_negado").hide();
  $("#file_borrador_negado").disableValidation();

  if (newVal == 'CONTINUAR') {
    $("#subtitble_borrador").show();
    $("#407570177650a77c6486366046710718").show();
    $("#frm_emisor_asignado").enableValidation();
    $("#frm_datosEmision_numPoliza").enableValidation();
    $("#frm_datosEmision_numEndoso").enableValidation();
    $("#fle_poliza").enableValidation();
  } else if(newVal == 'REGRESAR') {
    $("#file_borrador_negado").show();
    $("#file_borrador_negado").enableValidation();
  }
  console.log("TIPO DE REQUERIMIENTO: " + newVal);
}
//execute when the Dynaform loads:
action($("#frm_accion").getValue(), '');
$('#frm_accion').setOnchange(action);
