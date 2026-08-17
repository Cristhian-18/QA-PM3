

$("#repuestos").hide();

$("#frm_conductor_identificacion").disableValidation();
$("#frm_asegurado_tipo").disableValidation();
$("#frm_conductor_telefono").disableValidation();
$("#frm_conductor_nombres").disableValidation();



$('.menu').on('click', function () {
  ocultar_todo()
  switch (this.id) {
    case 'solicitud':
      mostrar_solicitud()
      break
    case 'documentos':
      $('#subt_docs').show()
      $('#418835952652a78d09ec638009652152').show()
      break
    case 'historial':
      $('#sbt_historial').show()
      $('#200528691652a78b49077a9030935355').show()
      break
    case 'repuestos':
      $('#sub_repuestos').show()
      $('#267077245653c2f21671c39092873297').show()
      break
  }
})

function ocultar_todo() {
  $('#subt_friss').hide()
  $('#88678649164f7eaea023df2027918886').hide()
  $('#711981759653951b01d9fc7055662056').hide()
  $('#subt_tallerAsignado').hide()
  $('#subt_ppolicial').hide()
  $('#82315095164a5ea0d445d33098806451').hide()
  $('#subt_accesoriosRegistrados').hide()
  $('#757211058653970103ff5d0031705379').hide()
  $('#subt_accidente').hide()
  $('#342283484650ba7c9f2fd13056558401').hide()
  $('#585018357653c2950773cf3076340308').hide()
  $('#sub_busqueda').hide()
  $('#56711039964a8241d124701020566530').hide()
  $('#subt_vehiculo').hide()
  $('#95746246564a4a9c711dfb2023501124').hide()
  $('#subt_asegurado').hide()
  $('#15180521364a5eaf5f02815065887190').hide()
  $('#subt_detalle').hide()
  $('#61446768964a848b295ae19072670821').hide()
  $('#subt_registro').hide()
  $('#22536303964a5e5cc12a673090504456').hide()
  $('#sub_docs').hide()
  $('#24155013164a5edc37a3b68095174528').hide()
  $('#sub_valores').hide()
  $('#79905380564f7ece7bc8989091267394').hide()
  $('#subt_docs').hide()
  $('#418835952652a78d09ec638009652152').hide()
  $('#sbt_historial').hide()
  $('#200528691652a78b49077a9030935355').hide()
  $('#subt_poliza').hide()
  $('#12366487464a4a855bed4c8081629548').hide()
  $('#sub_repuestos').hide()
  $('#470410481653944a172eeb1027144131').hide()
  $('#subt_hsiniestros').hide()
  $('#14870785564a5e392d24239097281950').hide()

  $('#subt_direccionador').hide()
  $('#34599290264a5ec882dda43091413149').hide()
  $('#subt_documentosTaller').hide()
  $('#96756789765393848ee6b94042482704').hide()
  $('#subt_gestionTaller').hide()
  $('#63032550665392b8983d5f2053584474').hide()
  $('#subt_valoresSiniestros').hide()
  $('#256570049653931cb709279020139545').hide()
  $('#subt_ve_afectados').hide()
  $('#24440509064a84d82d7a6e4090951046').hide()
  $("#iisubt_pr_afectados").hide();
  $("#83626962464a84f217fbb30019736581").hide();
  $("#isubt_pe_afectados").hide();
  $("#59581944164a84e6bc66f02025995827").hide();
}
function mostrar_solicitud() {
  $('#subt_friss').show()
  $('#88678649164f7eaea023df2027918886').show()
  $('#711981759653951b01d9fc7055662056').show()
  $('#subt_tallerAsignado').show()
  $('#subt_ppolicial').show()
  $('#82315095164a5ea0d445d33098806451').show()
  $('#subt_accesoriosRegistrados').show()
  $('#757211058653970103ff5d0031705379').show()
  $('#subt_accidente').show()
  $('#342283484650ba7c9f2fd13056558401').show()
  $('#subt_hsiniestros').show()
  $('#sub_busqueda').show()
  $('#56711039964a8241d124701020566530').show()
  $('#subt_vehiculo').show()
  $('#95746246564a4a9c711dfb2023501124').show()
  $('#subt_asegurado').show()
  $('#15180521364a5eaf5f02815065887190').show()
  $('#subt_detalle').show()
  $('#61446768964a848b295ae19072670821').show()
  $('#subt_registro').show()
  $('#22536303964a5e5cc12a673090504456').show()
  $('#sub_docs').show()
  $('#24155013164a5edc37a3b68095174528').show()
  $('#subt_poliza').show()
  $('#12366487464a4a855bed4c8081629548').show()
  $('#subt_historial_siniestro').show()
  $('#14870785564a5e392d24239097281950').show()
  $('#subt_direccionador').show()
  $('#34599290264a5ec882dda43091413149').show()
}

function esVacioOCero(v) {
  if (v === null || v === undefined) return true;
  return String(v).trim() === '';
}

 // Variable local que guarda el resultado de la última validación
var validacionOk = false;

function validarDatos(){
  validacionOk = false; // reset cada vez que se ejecuta

  var origen = $("#frm_origen_core_insurance").getValue();

  // ESCENARIO 4: sin origen definido
  if ( origen != "SISE" && origen != "INSURANCE") {
    $("#label0000000001").setValue('Debe definir el Origen (SISE o INSURANCE) antes de validar los datos.');
    return;
  }

  var idpv = $("#frm_id_pv").getValue()  || 0;
var numeroReporte = $("#nro_inspeccion").getValue() || 0;
  var numeroReclamo = $("#tri_nro_stro").getValue()  || 0;
  var rucBroker = $("#frm_busqueda_datosBroker_Id").getValue()  || 0;

  // ESCENARIO 3: origen INSURANCE
  // ESCENARIO 3: origen INSURANCE
  if (origen == "INSURANCE") {
    if (esVacioOCero(numeroReporte) || esVacioOCero(numeroReclamo) || esVacioOCero(rucBroker)) {
      $("#label0000000001").setValue('Complete Número de Reporte, Número de Reclamo y RUC de Bróker.');
      return;
    }
    if (idpv != "0" && idpv != 0) {
      $("#label0000000001").setValue('Para origen INSURANCE, ID_PV debe ser 0.');
      return;
    }

    $("#label0000000001").setValue('Datos válidos para origen INSURANCE. No se consultará ni actualizará SISE.');
    validacionOk = true;
    return;
  }


  // origen == SISE
  console.log('DEBUG VALORES >>>', {
  idpv: idpv,
  numeroReporte: numeroReporte,
  numeroReclamo: numeroReclamo,
  rucBroker: rucBroker,
  tipo_numeroReporte: typeof numeroReporte,
  tipo_numeroReclamo: typeof numeroReclamo,
  tipo_rucBroker: typeof rucBroker
});

  // ESCENARIO 1: SISE + ID_PV = 0
  if (idpv == "0" || idpv == 0) {
    if (esVacioOCero(numeroReporte) || esVacioOCero(numeroReclamo) || esVacioOCero(rucBroker)) {
      $("#label0000000001").setValue('Complete Número de Reporte (prereporte), Número de Reclamo y RUC de Bróker.');
      return;
    }

    $("#label0000000001").setValue('Prereporte SISE registrado. No se actualizará la reserva en SISE (póliza aún no definitiva).');
    validacionOk = true;
    return;
  }

  // ESCENARIO 2: SISE + ID_PV != 0 -> validar contra servicios
  var placa = $("#frm_vehiculo_placa").getValue();
  var chasis = $("#text0000000001").getValue();
  var numeroReporte = $("#nro_inspeccion").getValue() ?? '0';
  var numeroInspeccion = $("#id_stro_insp").getValue();

  if (!idpv || !placa || !chasis || !numeroInspeccion || !numeroReporte || !numeroReclamo || !rucBroker) {
    $("#label0000000001").setValue('Complete todos los campos requeridos: ID_PV, Placa, Chasis, N° Inspección, N° Reporte, N° Reclamo, RUC Bróker.');
    return;
  }

  $("#label0000000001").setValue('Consultando...');

  var reqPoliza = $.ajax({
    url: '../beesmartec/services/siniestrosVeh/ajax_pantalla.php',
    data: { 'funcion': 'consultarDatosPoliza', 'idpv': idpv, 'placa': placa, 'chasis': chasis },
    type: 'POST',
    dataType: 'json'
  });

  var reqReserva = $.ajax({
    url: '../beesmartec/services/siniestrosVeh/ajax_pantalla.php',
    data: { 'funcion': 'consultarDatosReserva', 'idStroInsp': numeroInspeccion },
    type: 'POST',
    dataType: 'json'
  });

  $.when(reqPoliza, reqReserva).done(function (resPoliza, resReserva) {
    var dataPoliza  = resPoliza[0];
    var dataReserva = resReserva[0];

    var polizaOk  = dataPoliza  && dataPoliza.codigo  === 200 && dataPoliza.data;
    var reservaOk = dataReserva && dataReserva.codigo === 200 && dataReserva.data;

    var textoPoliza, textoReserva;
    var consistente = true;
    var motivoInconsistencia = '';

    if (polizaOk) {
        var p = dataPoliza.data.poliza;
        var v = dataPoliza.data.vehiculo;
        var siniestros = dataPoliza.data.siniestros || [];

        textoPoliza = 'Datos de la póliza: N° ' + p.nroPoliza +
                      ' - ' + p.nombreAsegurado +
                      ' - Vigencia: ' + p.fechaVigenciaDesde.substring(0,10) +
                      ' a ' + p.fechaVigenciaHasta.substring(0,10);

        // ID_PV corresponda a la póliza consultada
        if (String(p.idPv) !== String(idpv)) {
          consistente = false;
          motivoInconsistencia += ' El ID_PV ingresado no corresponde a la póliza consultada.';
        }
        if (v.placa && v.placa.toUpperCase() !== placa.toUpperCase()) {
          consistente = false;
          motivoInconsistencia += ' La placa no coincide con la registrada en SISE.';
        }
        if (v.chasis && v.chasis.toUpperCase() !== chasis.toUpperCase()) {
          consistente = false;
          motivoInconsistencia += ' El chasis no coincide con el registrado en SISE.';
        }

        // El reclamo exista y la póliza corresponda a ese reclamo
        var siniestrosCoincidentes = $.grep(siniestros, function(s){
          return String(s.nroStro) === String(numeroReclamo);
        });

        if (siniestrosCoincidentes.length === 0) {
          consistente = false;
          motivoInconsistencia += ' El número de reclamo ingresado no existe o no corresponde a la póliza consultada.';
        }

      } else {
        consistente = false;
        textoPoliza = 'Datos de la póliza: ' + (dataPoliza && dataPoliza.mensaje ? dataPoliza.mensaje : 'No encontrada.');
      }

    if (reservaOk) {
      var r = dataReserva.data;
      var coberturasTxt = (r.coberturas && r.coberturas.length)
        ? r.coberturas.map(function(c){ return c.cobertura; }).join(', ')
        : 'sin coberturas';
      textoReserva = 'Datos de la reserva: idStro ' + r.idStro + ' - Cobertura(s): ' + coberturasTxt;
    } else {
      consistente = false;
      textoReserva = 'Datos de la reserva: ' + (dataReserva && dataReserva.mensaje ? dataReserva.mensaje : 'No encontrada.');
    }

    var mensajeFinal = textoReserva + '\n' + textoPoliza;
    if (!consistente && motivoInconsistencia) {
      mensajeFinal += '\nInconsistencias:' + motivoInconsistencia;
    }
    $("#label0000000001").setValue(mensajeFinal);

    validacionOk = (polizaOk && reservaOk && consistente);

  }).fail(function (xhr, status, err) {
    $("#label0000000001").setValue('Error al consultar los servicios. Intente nuevamente.');
    validacionOk = false;
    console.error('Error AJAX:', status, err);
  });
}

// Botón "Validar datos"
$("#button0000000001").click(function(e){
  e.preventDefault();
  validarDatos();
});

$("#frm_id_pv, #nro_inspeccion, #tri_nro_stro, #frm_busqueda_datosBroker_Id, #frm_vehiculo_placa, #text0000000001, #id_stro_insp, #frm_origen_core_insurance").on('change', function(){
  if (validacionOk) {
    validacionOk = false;
    $("#label0000000001").setValue('Los datos cambiaron. Debe volver a presionar "Validar datos".');
  }
});


$("#51792877265bd34fb35a170066452209").setOnSubmit(function(){
  var origen = $("#frm_origen_core_insurance").getValue();

  // ESCENARIO 4: sin origen definido
  if ( origen != "SISE" && origen != "INSURANCE") {
    $("#label0000000001").setValue('Debe definir el Origen (SISE o INSURANCE) antes de validar los datos.');
    return false;
  }

  if (!validacionOk) {
    e.preventDefault();
    $("#label0000000001").setValue('Debe presionar "Validar datos" y confirmar que la información es correcta antes de continuar.');
    return false;
  }

  return true;
});


ocultar_todo()
mostrar_solicitud()


function checkAccion(newVal, oldVal) {
  //$("#frm_id_pv").hide();
  $("#frm_id_pv").disableValidation();
  $("#nro_inspeccion").hide();
  $("#nro_inspeccion").disableValidation();
  $("#id_stro_insp").hide();
  $("#id_stro_insp").disableValidation();
  $("#frm_valor_insurance").hide();

  if (newVal == 'CONTINUAR' || newVal == 'INSURANCE') {
    $("#nro_inspeccion").show();
    $("#nro_inspeccion").enableValidation();
    $("#id_stro_insp").show();
    $("#id_stro_insp").enableValidation();
    $("#frm_valor_insurance").show();
  }

  if(newVal == 'INSURANCE'){
    var origen_actual =  $("#frm_origen_core_insurance").getValue();


    if(origen_actual==""){
    $("#frm_origen_core_insurance").setValue('INSURANCE');
    }
  }

  if (newVal == 'MANUAL') {


  }
  if (newVal == 'RECHAZAR') {


  }
  if (newVal == 'VOLVER') {
    $("#frm_id_pv").show();
    $("#frm_id_pv").enableValidation();

  }

}
//execute when the Dynaform loads:
checkAccion($("#frm_accion_2").getValue(), '');
$('#frm_accion_2').setOnchange(checkAccion);


