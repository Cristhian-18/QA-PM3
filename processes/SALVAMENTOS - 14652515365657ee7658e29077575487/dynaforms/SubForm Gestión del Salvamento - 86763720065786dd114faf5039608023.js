function observacionCTE(newVal, oldVal) {
  $("#frm_gestionSalvamento_observacionCTEString").hide();
  if (newVal == 'SI') {
    $("#frm_gestionSalvamento_observacionCTEString").show();

  }

}
//execute when the Dynaform loads:
observacionCTE($("#frm_gestionSalvamento_observacionCTE").getValue(), '');
$('#frm_gestionSalvamento_observacionCTE').setOnchange(observacionCTE);