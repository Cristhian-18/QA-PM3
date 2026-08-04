$("#sub_valores").hide();
$("#51718349165655b4ed81039097317111").hide();
$("#subt_gestionTaller").hide();
$("#16138142065655b4ed73766092455273").hide();
$("#subt_documentosTaller").hide();
$("#13053029065655b4ed8da75032156816").hide();

$("#frm_documentos_cotizacion").disableValidation();
$("#frm_documentos_evidencia").disableValidation();

$("#subt_valoresSiniestros").hide();
$("#48813423665655b4ed48ac5080424075").hide();

let bandera_mundo = $("#tri_bandera_mundoMotriz").getValue();

function action(newVal, oldVal) {

  $("#sub_valores").hide();
  $("#51718349165655b4ed81039097317111").hide();
  $("#subt_gestionTaller").hide();
  $("#16138142065655b4ed73766092455273").hide();
  $("#subt_documentosTaller").hide();
  $("#13053029065655b4ed8da75032156816").hide();

  $("#frm_documentos_cotizacion").disableValidation();
  $("#frm_documentos_evidencia").disableValidation();

  $("#subt_valoresSiniestros").hide();
  $("#48813423665655b4ed48ac5080424075").hide();

  $("#frm_valoresSiniestro_valoresRepuestos1").disableValidation();
  $("#frm_valoresSiniestro_procentajeDescuentoProformado").disableValidation();
  $("#frm_valoresSiniestro_manoObraProformada").disableValidation();
  $("#frm_valoresSiniestro_diasEstimadosReparacion").disableValidation();
  
  $("#frm_valoresSiniestro_valoresRepuestos1").getControl().attr('disabled', false);
  $("#frm_valoresSiniestro_procentajeDescuentoProformado").getControl().attr('disabled', false);
  
  if (newVal == 'CONTINUAR') {
    $("#sub_valores").show();
    $("#51718349165655b4ed81039097317111").show();
    $("#subt_gestionTaller").show();
    $("#16138142065655b4ed73766092455273").show();
    $("#subt_documentosTaller").show();
    $("#13053029065655b4ed8da75032156816").show();
    $("#subt_valoresSiniestros").show();
    $("#frm_valoresSiniestro_valoresRepuestos1").getControl().attr('disabled', true);
    $("#frm_valoresSiniestro_procentajeDescuentoProformado").getControl().attr('disabled', true);
    $("#48813423665655b4ed48ac5080424075").show();
    $("#frm_documentos_cotizacion").enableValidation();
    $("#frm_documentos_evidencia").enableValidation();
    $("#frm_valoresSiniestro_manoObraProformada").enableValidation();
    $("#frm_valoresSiniestro_diasEstimadosReparacion").enableValidation();

   if($("#frm_valoresSiniestro_valoresRepuestos1").getValue() == '') {
        $("#frm_valoresSiniestro_valoresRepuestos1").setValue("");
    }
    
   if($("#frm_valoresSiniestro_procentajeDescuentoProformado").getValue() == '') {
        $("#frm_valoresSiniestro_procentajeDescuentoProformado").setValue("");
    }

  

  }

  if (newVal == 'COTIZADO') {
    $("#subt_gestionTaller").show();
    $("#16138142065655b4ed73766092455273").show();
    $("#subt_documentosTaller").show();
    $("#13053029065655b4ed8da75032156816").show();
    $("#subt_valoresSiniestros").show();
    $("#48813423665655b4ed48ac5080424075").show();

    $("#frm_documentos_cotizacion").enableValidation();
    $("#frm_documentos_evidencia").enableValidation();

    $("#frm_valoresSiniestro_valoresRepuestos1").enableValidation();
    $("#frm_valoresSiniestro_procentajeDescuentoProformado").enableValidation();
    $("#frm_valoresSiniestro_manoObraProformada").enableValidation();
    $("#frm_valoresSiniestro_diasEstimadosReparacion").enableValidation();
    
  }

  if (newVal == 'PERDIDA') {
    $("#subt_gestionTaller").show();
    $("#16138142065655b4ed73766092455273").show();
    $("#subt_documentosTaller").show();
    $("#13053029065655b4ed8da75032156816").show();
    $("#subt_valoresSiniestros").show();
    $("#48813423665655b4ed48ac5080424075").show();
    $("#frm_documentos_cotizacion").enableValidation();
    $("#frm_documentos_evidencia").enableValidation();

      $("#frm_valoresSiniestro_valoresRepuestos1").enableValidation();
      $("#frm_valoresSiniestro_procentajeDescuentoProformado").enableValidation();
      $("#frm_valoresSiniestro_manoObraProformada").enableValidation();
      $("#frm_valoresSiniestro_diasEstimadosReparacion").enableValidation();
    
    

  }
  console.log("TIPO DE REQUERIMIENTO: " + newVal);
}
//execute when the Dynaform loads:
action($("#frm_accion").getValue(), '');
$('#frm_accion').setOnchange(action);



$("#repuestos").hide();

$('.menu').on('click', function () {
  ocultar_todo()
  console.log(this.id)
  console.log('CAMBIO')
  switch (this.id) {
    case 'solicitud':
      mostrar_solicitud()
      break
    case 'documentos':
      $('#subt_docs').show()
      $('#75921207865655b4ed5b3c1053457518').show()
      break
    case 'historial':
      $('#sbt_historial').show()
      $('#79094655365655b4ed40d17058683087').show()
      break
    case 'repuestos':
      $('#sub_repuestos').show()
      $('#17206049365655b4ed499f4054369527').show()
      break
  }
  action($("#frm_accion").getValue(), '');

})

function ocultar_todo() {
  $('#subt_friss').hide()
  $('#95547977665655b4ed87ca6055466913').hide()
  $('#43198352265655b4ed78569007990565').hide()
  $('#subt_tallerAsignado').hide()
  $('#subt_ppolicial').hide()
  $('#57796621765655b4ed83ea3082357963').hide()
  $('#subt_accesoriosRegistrados').hide()
  $('#43015877965655b4ed7d2a1016407207').hide()
  $('#subt_accidente').hide()
  $('#31053789365655b4ed53799071011166').hide()
  $('#33327433165655b4ed6abd1080464820').hide()
  $('#sub_busqueda').hide()
  $('#60259283965655b4ed68cb6009778512').hide()
  $('#subt_vehiculo').hide()
  $('#17569986565655b4ed8c995023188336').hide()
  $('#subt_asegurado').hide()
  $('#76241453365655b4ed3ad27050479402').hide()
  $('#subt_detalle').hide()
  $('#41209453665655b4ed71780023900709').hide()
  $('#subt_registro').hide()
  $('#44056937965655b4ed42c04054669455').hide()
  $('#subt_ve_afectados').hide()
  $('#93254149565655b4ed46a66057215729').hide()
  $('#isubt_pe_afectados').hide()
  $('#43602034065655b4ed6ca46084965014').hide()
  $('#iisubt_pr_afectados').hide()
  $('#46533585865655b4ed84dd4018270742').hide()
  $('#sub_docs').hide()
  $('#98325375965655b4ed45b13092827388').hide()
  $('#sub_valores').hide()
  $('#51718349165655b4ed81039097317111').hide()
  $('#subt_docs').hide()
  $('#75921207865655b4ed5b3c1053457518').hide()
  $('#sbt_historial').hide()
  $('#79094655365655b4ed40d17058683087').hide()
  $('#subt_poliza').hide()
  $('#28358068365655b4ed35473079795674').hide()
  $('#sub_repuestos').hide()
  $('#57719423965655b4ed5e193039723079').hide()
  $('#subt_hsiniestros').hide()
  $('#47330327665655b4ed38dc0072757607').hide()

  $('#subt_direccionador').hide()
  $('#83210580965655b4ed546d3053710376').hide()
  $('#subt_documentosTaller').hide()
  $('#13053029065655b4ed8da75032156816').hide()
  $('#subt_gestionTaller').hide()
  $('#16138142065655b4ed73766092455273').hide()
  $('#subt_valoresSiniestros').hide()
  $('#48813423665655b4ed48ac5080424075').hide()
}
function mostrar_solicitud() {
  $('#subt_friss').show()
  $('#95547977665655b4ed87ca6055466913').show()
  $('#43198352265655b4ed78569007990565').show()
  $('#subt_tallerAsignado').show()
  $('#subt_ppolicial').show()
  $('#57796621765655b4ed83ea3082357963').show()
  $('#subt_accesoriosRegistrados').show()
  $('#43015877965655b4ed7d2a1016407207').show()
  $('#subt_accidente').show()
  $('#31053789365655b4ed53799071011166').show()

  $('#sub_busqueda').show()
  $('#60259283965655b4ed68cb6009778512').show()
  $('#subt_vehiculo').show()
  $('#17569986565655b4ed8c995023188336').show()
  $('#subt_asegurado').show()
  $('#76241453365655b4ed3ad27050479402').show()
  $('#subt_detalle').show()
  $('#41209453665655b4ed71780023900709').show()
  $('#subt_registro').show()
  $('#44056937965655b4ed42c04054669455').show()
  $('#subt_ve_afectados').show()
  $('#93254149565655b4ed46a66057215729').show()
  $('#isubt_pe_afectados').show()
  $('#43602034065655b4ed6ca46084965014').show()
  $('#iisubt_pr_afectados').show()
  $('#46533585865655b4ed84dd4018270742').show()
  $('#sub_docs').show()
  $('#98325375965655b4ed45b13092827388').show()

  $('#subt_poliza').show()
  $('#28358068365655b4ed35473079795674').show()
  $('#subt_historial_siniestro').show()
  $('#47330327665655b4ed38dc0072757607').show()
  $('#subt_direccionador').show()
  $('#83210580965655b4ed546d3053710376').show()

 
}

ocultar_todo()
mostrar_solicitud()

$("#sub_valores").hide();
$("#51718349165655b4ed81039097317111").hide();
$("#subt_gestionTaller").hide();
$("#16138142065655b4ed73766092455273").hide();
$("#subt_documentosTaller").hide();
$("#13053029065655b4ed8da75032156816").hide();

$("#frm_documentos_cotizacion").disableValidation();
$("#frm_documentos_evidencia").disableValidation();

$("#subt_valoresSiniestros").hide();
$("#48813423665655b4ed48ac5080424075").hide();
