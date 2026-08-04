
function checkAccion(newVal, oldVal) {
    $("#file_borrador_negado_1").hide();
    $("#file_borrador_negado_1").disableValidation();
  $("#fileComiteSuscripcion").hide();
        $("#fileComiteSuscripcion").disableValidation();
          $("#frm_emisor_asignado").disableValidation();

$('#frm_emisor_asignado').hide();

    if (newVal == 'REGRESAR') {
        $("#file_borrador_negado_1").show();
        $("#file_borrador_negado_1").enableValidation();
    } 
  
  if (newVal == 'CONTINUAR') {
        $("#fileComiteSuscripcion").show();
        $("#fileComiteSuscripcion").enableValidation();
           $("#frm_emisor_asignado").enableValidation();

    $('#frm_emisor_asignado').show();

    } 
    console.log("TIPO DE REQUERIMIENTO: " + newVal);
}
//execute when the Dynaform loads:
checkAccion($("#frm_accion").getValue(), '');
$('#frm_accion').setOnchange(checkAccion);


