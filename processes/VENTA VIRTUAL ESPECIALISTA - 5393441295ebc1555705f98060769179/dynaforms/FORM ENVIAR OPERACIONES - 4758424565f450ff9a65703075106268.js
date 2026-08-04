$('#correoEnviadoDesicionMagnum').getValue() === 'SI' ? $('#32832123863dc1b7ca05b77080881437').show() : $('#32832123863dc1b7ca05b77080881437').hide();
$( function(){
  $("#2200289695ec4351a1bd6d3027166827").toggle();
  $("#3659092825f484ded40e690037283996").toggle();
  $('#tri_es_broker').hide();
  $("#frm_control_adjuntos").show();
  var broker = $('#tri_es_broker').getValue();
  if (broker == 'NO')
  {
    //$('#frm_control_adjuntos').hide();
  }
  var pago =   $('#frm_control_pago').getControl().val();
  if (pago == 'PAGADO')
  {
    $('#frm_modificar_solicitud').setLabel('Solicitud');
  }
  
});

$("#frm_modificar_solicitud").change(function () {

  if( $('#frm_modificar_solicitud').getValue() == 0 ) {
    var asegurado = $('#frm_numero_identificacion').getControl().val();
    var pagador = $('#frm_cedula_pagador').getControl().val();    
    /*if(asegurado != pagador){
      alert ('Recuerde enviar la autorizacion de debito al pagador');
      //$('#frm_modificar_debito').getControl().prop("disabled", true);
    }
    else  {
      if($("frm_debito_si").getValue() == 'SI'){
      	alert ('Si modifica la solicitud, debe enviar la autorizacion de debito');
      	$('#frm_modificar_debito').setValue('1');
      	//$('#frm_modificar_debito').getControl().prop("disabled", true);
    	} 
    }*/
  }
  else
  {
    $('#frm_modificar_debito').setValue('0');    
    $('#frm_modificar_debito').getControl().prop("disabled", false);
  }
});



$("#frm_modificar_covid").change(function () {

  if( $('#frm_modificar_covid').getValue() == 0 ) {
    var asegurado = $('#frm_numero_identificacion').getControl().val();
    var pagador = $('#frm_cedula_pagador').getControl().val();    
    if(asegurado != pagador){
      $('#frm_modificar_debito').getControl().prop("disabled", true);
    }
    else  {
      $('#frm_modificar_debito').getControl().prop("disabled", false);
    }
  }
  else
  {
    $('#frm_modificar_debito').getControl().prop("disabled", false);
  }
});


$("#frm_modificar_debito").change(function () {
  if( $('#frm_modificar_debito').getValue() == 0 ) {
    var asegurado = $('#frm_numero_identificacion').getControl().val();
    var pagador = $('#frm_cedula_pagador').getControl().val();    
    if(asegurado != pagador){
      //$('#frm_modificar_solicitud').getControl().prop("disabled", true);
      //$('#frm_modificar_covid').getControl().prop("disabled", true);
    }
    else  {

      $('#frm_modificar_solicitud').getControl().prop("disabled", false);
      //$('#frm_modificar_covid').getControl().prop("disabled", false);
    }
  }
  else
  {
    $('#frm_modificar_solicitud').setValue('0');    
    $('#frm_modificar_solicitud').getControl().prop("disabled", false);
    $('#frm_modificar_covid').getControl().prop("disabled", false);    
  }

});

$("#4758424565f450ff9a65703075106268").setOnSubmit(function(){
  
  var aux = $('#frm_accion').getValue();
  if (aux == 'MODIFICAR'){
    var solicitud = $('#frm_modificar_solicitud').getValue();
    var debito = $('#frm_modificar_debito').getValue();
    var covid = $('#frm_modificar_covid').getValue();
    if (solicitud == 0 && debito == 0 && covid == 0 ){
      alert("Seleccione al menos un formulario a modificar");
      return false;       
    }
  }
});


//On change del select "Regulado"
$("#grid_regularizacion select").on('change', function () {	
  var respuesta = $(this).val();
  alert(respuesta);
  if(respuesta == 'N'){
     $("#btn_continuar").hide();
    alert('no hay');
   }
});
