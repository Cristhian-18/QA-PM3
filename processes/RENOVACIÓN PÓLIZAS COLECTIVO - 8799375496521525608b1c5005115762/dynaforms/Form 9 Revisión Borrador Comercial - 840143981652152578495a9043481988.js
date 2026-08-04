
$("#btn_consultar").hide();
$("#frm_comentario").setValue("BORRADOR REVISADO");

$("#file_borrador_corregir").hide();

function action(newVal, oldVal) {
  $("#file_borrador_corregir").hide();
  $("#fileComiteSuscripcion_c").hide();
   $("#fileComiteSuscripcion_c").disableValidation();
  $("#frm_emisor_asignado_apro").hide();
   $("#frm_emisor_asignado_apro").disableValidation();
  
    if (newVal == 'REGRESAR') {
        $("#file_borrador_corregir").show();
    } 
  if (newVal == 'CONTINUAR') {
        $("#fileComiteSuscripcion_c").show();
   		$("#fileComiteSuscripcion_c").enableValidation();
      $("#frm_emisor_asignado_apro").show();
   $("#frm_emisor_asignado_apro").enableValidation();
    } 
    console.log("TIPO DE REQUERIMIENTO: " + newVal);
}
//execute when the Dynaform loads:
action($("#frm_accion").getValue(), ''); 
$('#frm_accion').setOnchange(action);



