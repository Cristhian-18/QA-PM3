function checkAfectado(newVal, oldVal) {
  console.log(newVal);
  
  $('#frm_siniestro_nombreResponsable').hide();
  $('#frm_siniestro_placaResponsable').hide();
  $('#frm_siniestro_informacionResponsable').hide();
  $('#frm_siniestro_informacionResponsable').disableValidation();
  $('#frm_siniestro_nombreResponsable').disableValidation();
  $('#frm_siniestro_placaResponsable').disableValidation();

  if (newVal == 'AFECTADO') {
    $('#frm_siniestro_informacionResponsable').show();
    $('#frm_siniestro_informacionResponsable').enableValidation();
    console.log(newVal);

  } else {
    $('#frm_siniestro_informacionResponsable').setValue("");
    console.log(newVal);

  }
}

//execute when the Dynaform loads:
checkAfectado($("#frm_siniestro_seConsidera").getValue(), '');
$('#frm_siniestro_seConsidera').setOnchange(checkAfectado);


function informacionResponsable(newVal, oldVal) {

  $('#frm_siniestro_nombreResponsable').hide();
  $('#frm_siniestro_placaResponsable').hide();
  $('#frm_siniestro_nombreResponsable').disableValidation();
  $('#frm_siniestro_placaResponsable').disableValidation();
  console.log("Valor responsable: " + newVal);

  if (newVal == 'SI') {
    console.log("Valor responsable: " + newVal);

    $('#frm_siniestro_nombreResponsable').show();
    $('#frm_siniestro_placaResponsable').show();
    $('#frm_siniestro_nombreResponsable').enableValidation();
    $('#frm_siniestro_placaResponsable').enableValidation();
  }
}

//execute when the Dynaform loads:
informacionResponsable($("#frm_siniestro_informacionResponsable").getValue(), '');

$('#frm_siniestro_informacionResponsable').setOnchange(informacionResponsable);
