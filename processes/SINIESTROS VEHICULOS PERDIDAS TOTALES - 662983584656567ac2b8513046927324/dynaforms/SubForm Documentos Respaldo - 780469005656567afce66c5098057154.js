//$('#frm_documentos_check').setOnchange(checkCanton); //execute when field's value changes

$("#frm_documentos_check").setOnchange(function (newVal, oldVal) {
  $('#fle_matricula').disableValidation();
  $('#fle_cedula').disableValidation();
  $('#fle_licencia').disableValidation();
  $('#fle_denuncia').disableValidation();
  $('#fle_partePolicial').disableValidation();


  if (newVal == "SI") {
    $('#fle_matricula').enableValidation();
    $('#fle_cedula').enableValidation();
    $('#fle_licencia').enableValidation();
    $('#fle_denuncia').enableValidation();
    $('#fle_partePolicial').enableValidation();

  }

});
