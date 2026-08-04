
function asesoriaLegal(newVal, oldVal) {


  $('#frm_siniestro_nombreResponsable').hide();
  $('#frm_siniestro_placaResponsable').hide();
  $('#frm_siniestro_informacionResponsable').hide();
  $('#frm_siniestro_informacionResponsable').disableValidation();
  $('#frm_siniestro_nombreResponsable').disableValidation();
  $('#frm_siniestro_placaResponsable').disableValidation();

  if (newVal == 'SI') {
    $('#frm_siniestro_informacionResponsable').show();
    $('#frm_siniestro_informacionResponsable').enableValidation();
  } else {
    $('#frm_siniestro_informacionResponsable').setValue("");
  }
}

//execute when the Dynaform loads:
asesoriaLegal($("#frm_requiere_AsesoriaLegal").getValue(), '');
$('#frm_requiere_AsesoriaLegal').setOnchange(asesoriaLegal);


function informacionResponsable(newVal, oldVal) {

  $('#frm_siniestro_nombreResponsable').hide();
  $('#frm_siniestro_placaResponsable').hide();
  $('#frm_siniestro_nombreResponsable').disableValidation();
  $('#frm_siniestro_placaResponsable').disableValidation();

  if (newVal == 'SI') {
    $('#frm_siniestro_nombreResponsable').show();
    $('#frm_siniestro_placaResponsable').show();
    $('#frm_siniestro_nombreResponsable').enableValidation();
    $('#frm_siniestro_placaResponsable').enableValidation();
  }
}

//execute when the Dynaform loads:
informacionResponsable($("#frm_siniestro_informacionResponsable").getValue(), '');
$('#frm_siniestro_informacionResponsable').setOnchange(informacionResponsable);
