//Validar cedula de identidad y pasaporte
$("#frm_datosSolicitud_RUC").focusout(function () {
  if (typeof validarIdentificacion === 'function') {
    let ruc = $("#frm_datosSolicitud_RUC").getValue();
    let tipoIdentificacion = "R";
    let aux = true;
    var bool = validarIdentificacion(ruc, tipoIdentificacion, aux);
    if (bool == false) {
      $('#frm_datosSolicitud_RUC').setValue("");
    }
  }
});