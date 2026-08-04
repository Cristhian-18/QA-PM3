let numberRows = $("#grd_registro_siniestro").getNumberRows();
console.log(numberRows);

for (let i = 1; i <= numberRows; i++) {
    $("#grd_valores_siniestros").setValue("Aprobado", i, 9);
    //$("#grd_valores_siniestros").getControl(i, 9).attr('disabled', true);
    let aplicar =  +  $("#grd_valores_siniestros").getValue(i, 4);
  if(aplicar!="SI"){
    for(let j=1;j<=6;j++){
      //$("#grd_valores_siniestros").getControl(i, j).attr('hidden', true);
      //$("#grd_valores_siniestros").getControl(i, j).attr('hidden');
    }
  }
}

let provincia = $("#frm_accidente_provincia").getValue();

function checkTaller(newVal, oldVal) {
  if(provincia == "17" || provincia == "9" || provincia == "23"){
    let numTalleres = $("#grd_vehiculos_afectados").getNumberRows();
    for (let i = 1; i <= numTalleres; i++) {
      //$("#grd_vehiculos_afectados").setValue('656875464653fde7079d086090157229', i, 7);
    }

  }
}
checkTaller($("#grd_vehiculos_afectados").getValue(), '');
$('#grd_vehiculos_afectados').change(checkTaller);


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

  $("#frm_siniestro_OtrosVehiculos").enableValidation();
  $("#frm_siniestro_Propiedad").enableValidation();
  $("#frm_siniestro_Personas").enableValidation();
  $("#frm_requiere_PartePolicial").enableValidation();
  $("#frm_requiere_AsesoriaLegal").enableValidation();
  $("#frm_siniestro_afectado").enableValidation();
  $("#frm_asegurado_tipo").enableValidation();
  $("#frm_asegurado_identificacion").enableValidation();
  $("#frm_asegurado_nombres").enableValidation();
  $("#frm_asegurado_telefono").enableValidation();

  $("#frm_documentos_check").disableValidation();
  $('#fle_matricula').disableValidation();
  $('#fle_cedula').disableValidation();
  $('#fle_licencia').disableValidation();
  $('#fle_denuncia').disableValidation();
  $('#fle_partePolicial').disableValidation();
  
  if (newVal == 'CONTINUAR') {
    $("#frm_documentos_check").enableValidation();

    $("#sub_valores").show();
    $("#51718349165655b4ed81039097317111").show();
    $("#subt_gestionTaller").show();
    $("#16138142065655b4ed73766092455273").show();
    $("#subt_documentosTaller").show();
    $("#13053029065655b4ed8da75032156816").show();
    $("#subt_valoresSiniestros").show();
    $("#48813423665655b4ed48ac5080424075").show();

    $("#frm_documentos_cotizacion").enableValidation();
    $("#frm_documentos_evidencia").enableValidation();

  }


  if (newVal == 'COTIZADO') {
    $("#frm_documentos_check").enableValidation();

    $("#subt_gestionTaller").show();
    $("#16138142065655b4ed73766092455273").show();
    $("#subt_documentosTaller").show();
    $("#13053029065655b4ed8da75032156816").show();
    $("#subt_valoresSiniestros").show();
    $("#48813423665655b4ed48ac5080424075").show();

    $("#frm_documentos_cotizacion").enableValidation();
    $("#frm_documentos_evidencia").enableValidation();
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

  }
  if (newVal == 'SOLICITAR') {

    $("#frm_siniestro_OtrosVehiculos").disableValidation();
    $("#frm_siniestro_Propiedad").disableValidation();
    $("#frm_siniestro_Personas").disableValidation();
    $("#frm_requiere_PartePolicial").disableValidation();
    $("#frm_requiere_AsesoriaLegal").disableValidation();
    $("#frm_siniestro_afectado").disableValidation();
    $("#frm_asegurado_tipo").disableValidation();
    $("#frm_asegurado_identificacion").disableValidation();
    $("#frm_asegurado_nombres").disableValidation();
    $("#frm_asegurado_telefono").disableValidation();

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
  $('#74441860565655b4ed82f60093609478').hide()

  
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
  $('#subt_hsiniestros').show()

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
  $('#sub_docs').show()
  $('#98325375965655b4ed45b13092827388').show()
  
  $('#subt_poliza').show()
  $('#28358068365655b4ed35473079795674').show()
  $('#subt_historial_siniestro').show()
  $('#47330327665655b4ed38dc0072757607').show()
  $('#subt_direccionador').show()
  $('#83210580965655b4ed546d3053710376').show()
  $('#74441860565655b4ed82f60093609478').show()

  
}

function action(newVal, oldVal) {
  $('#frm_correo_cliente').hide();
  $('#frm_correo_cliente2').hide();
  


  if (newVal == "SOLICITAR") {
      $('#frm_correo_cliente').show();
      $('#frm_correo_cliente2').show();
  } else if (newVal == "CONTINUAR") {
     
  }

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

//frm_asegurado_tipo
//frm_conductor_identificacion
//frm_conductor_nombres
//frm_conductor_telefono
//frm_accidente_pais
//frm_accidente_provincia
//frm_accidente_ciudad
//frm_siniestro_direccion
//frm_siniestro_detalle

$("#frm_asegurado_tipo").disableValidation();
$("#frm_conductor_identificacion").disableValidation();
$("#frm_conductor_nombres").disableValidation();
$("#frm_conductor_telefono").disableValidation();
$("#frm_accidente_pais").disableValidation();
$("#frm_accidente_provincia").disableValidation();
$("#frm_accidente_ciudad").disableValidation();
$("#frm_siniestro_direccion").disableValidation();
$("#frm_siniestro_detalle").disableValidation();

