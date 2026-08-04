function checkEnajenacion(newVal, oldVal) {
    $("#frm_legalInvec_enajenacionFecha").hide();
    $("#frm_legalInvec_enajenacionFecha").disableValidation();
    if (newVal == 'SI') {
        $("#frm_legalInvec_enajenacionFecha").show();
        $("#frm_legalInvec_enajenacionFecha").enableValidation();
    }  
    console.log(newVal);
}
checkEnajenacion($("#frm_legalInvec_enajenacion").getValue(), '');
$('#frm_legalInvec_enajenacion').setOnchange(checkEnajenacion);

function checkPrendado(newVal, oldVal) {
  $("#frm_legalInvec_prendaFecha").hide();
  $("#frm_legalInvec_prendaFecha").disableValidation();
  if (newVal == 'SI') {
      $("#frm_legalInvec_prendaFecha").show();
      $("#frm_legalInvec_prendaFecha").enableValidation();
  }  
  console.log(newVal);
}
checkPrendado($("#frm_legalInvec_prendado").getValue(), '');
$('#frm_legalInvec_prendado').setOnchange(checkPrendado);

function checkBloqueo(newVal, oldVal) {
  $("#frm_legalInvec_bloqueoFecha").hide();
  $("#frm_legalInvec_bloqueoFecha").disableValidation();
  if (newVal == 'SI') {
      $("#frm_legalInvec_bloqueoFecha").show();
      $("#frm_legalInvec_bloqueoFecha").enableValidation();
  }  
  console.log(newVal);
}
checkBloqueo($("#frm_legalInvec_bloqueo").getValue(), '');
$('#frm_legalInvec_bloqueo').setOnchange(checkBloqueo);

