
function rastreoSatelital(newVal, oldVal) {

  $("#file_reporte_sat").hide();
  $("#file_reporte_sat").disableValidation();
  
  if (newVal == 'SI') {
    $("#file_reporte_sat").show();
    $("#file_reporte_sat").enableValidation();
  }
  console.log("TIPO DE REQUERIMIENTO: " + newVal);
}
//execute when the Dynaform loads:
rastreoSatelital($("#frm_rastreoSatelital").getValue(), '');
$('#frm_rastreoSatelital').setOnchange(rastreoSatelital);

