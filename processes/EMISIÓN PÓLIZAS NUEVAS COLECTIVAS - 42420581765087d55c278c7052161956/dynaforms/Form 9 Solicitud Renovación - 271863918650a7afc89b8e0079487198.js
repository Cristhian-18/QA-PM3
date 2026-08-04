//henry
//datos
function checkAccion_h(newVal, oldVal) {
          $("#fle_borrador_poliza").disableValidation();
    if (newVal == 'CONTINUAR') {
        $("#fle_borrador_poliza").show();
        $("#fle_borrador_poliza").enableValidation();
    } else {
      	$("#fle_borrador_poliza").hide();
    }
}
//execute when the Dynaform loads
checkAccion_h($("#frm_accion").getValue(), ''); 
$('#frm_accion').setOnchange(checkAccion_h);
