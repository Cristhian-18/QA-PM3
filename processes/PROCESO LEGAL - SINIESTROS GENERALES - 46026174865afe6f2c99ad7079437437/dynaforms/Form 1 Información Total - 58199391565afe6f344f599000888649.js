//$("#frm_as_tipoGestion").getControl().attr('disabled', true);

function action(newVal, oldVal) {
  $("#61795416265afe6f3461630064260059").hide();  
  let tipo = $("#frm_informacion_tipo").getValue();
  if(newVal == 'CERRAR'){
    $("#61795416265afe6f3461630064260059").show();  
    $("#frm_cierre_comprobantePago").hide();
    $("#frm_cierre_actaFiscalia").hide();
    $("#frm_cierre_cierreFiscalia").hide();
    if(tipo == 'SUBROGACIÓN'){
      $("#frm_cierre_comprobantePago").show();
    } else {
      $("#frm_cierre_actaFiscalia").show();
      $("#frm_cierre_cierreFiscalia").show();
    }
  }
}

action($("#frm_accion").getValue(), '');
$('#frm_accion').setOnchange(action);


ocultar_solicitud();
mostrar_solicitud();
ocultar_documentos();
ocultar_historial();
function mostrar_solicitud() {
  $('#55699582765affdbeabb180057428247').show(); // Datos asegurado 
  $('#42657135465afffbfb4b814050491325').show(); // Datos siniestro
  //$('#19482908265511238869e34082628309').show(); // Datos gestión
  $('#59298200565b00036d3ec37002332477').show(); // Historial de casos
  $('#19253610665b000533512c2081188415').show(); // Siniestros registrados
  //$('#37397912265511ee4965f19044370072').show(); // Alcance a siniestro
  $('#44734702065b000700a8c38067549055').show(); // Información siniestro
  $('#33933068365b000879b4233031527643').show(); // Direcciones bienes
  $('#90797181465b0009a8346e8069257723').show(); // Información inspección
  $('#65009754265b000d5441e25035029187').show(); // Información pago
  $('#54311973265b000e917c771007149676').show(); // Análisis siniestro
  $('#96913760865b013956d3458069571575').show(); // Gestión informe ajustador externo
  //$('#124534031655423d6933cf3054917309').show(); // Gestión informe ajustador interno
  $('#76872118865b013ba554ca7039264531').show(); // Recomendaciones
  $('#58427909965b013d4b72133095755119').show(); // Subrogaciones/salvamentos
  $('#14756539565b013e91c8616020859435').show(); // Atención al caso
  $('#64914738165b013fb6c5de1060185623').show(); // Poliza
  $('#subtitleDatase').show();
  $('#subtitleDatoSini').show();
  $('#subtitleDatGes').show();
  $('#subtitleSiniReg').show();
  $('#subtitleAlcaSin').show();
  $('#subtitleInformacionSiniestro').show();
  $('#subtitleDireBien').show();
  $('#subtitleInfoInsp').show();
  $('#subtitleInfPago').show();
  $('#subtitleAnaSini').show();
  $('#subtitleGestAjusExter').show();
  $('#subtitleGestAjusInter').show();
  $('#subtitleRecomenda').show();
  $('#subtitleSubrSalv').show();
  $('#subtitleAtenCaso').show();
  $('#sub_titlePoliza').show();
  $('#fle_respaldosInspeccion').show();
  $('#sub_companias_coaseguradas').show();
  $('#930411861658b16b7c6ffe2080159750').show();
  $('#72023205665542581b5be35026876051').show();
  salvamento($('#frm_ss_existeSalvamento').getValue(), '');


  let tipo_operacion = $("#frm_ds_tipoOperacion").getValue();
  console.log(tipo_operacion);
  if (tipo_operacion === 'COASEGURO CEDIDO') {
    console.log(tipo_operacion);

    $('#sub_companias_coaseguradas').show();
    $('#930411861658b16b7c6ffe2080159750').show();
  } else {
    $('#sub_companias_coaseguradas').hide();
    $('#930411861658b16b7c6ffe2080159750').hide();
  }
}
function ocultar_solicitud() {
    $('#55699582765affdbeabb180057428247').hide(); // Datos asegurado 
    $('#42657135465afffbfb4b814050491325').hide(); // Datos siniestro
    //$('#19482908265511238869e34082628309').hide(); // Datos gestión
    $('#59298200565b00036d3ec37002332477').hide(); // Historial de casos
    $('#19253610665b000533512c2081188415').hide(); // Siniestros registrados
    //$('#37397912265511ee4965f19044370072').hide(); // Alcance a siniestro
    $('#44734702065b000700a8c38067549055').hide(); // Información siniestro
    $('#33933068365b000879b4233031527643').hide(); // Direcciones bienes
    $('#90797181465b0009a8346e8069257723').hide(); // Información inspección
    $('#65009754265b000d5441e25035029187').hide(); // Información pago
    $('#54311973265b000e917c771007149676').hide(); // Análisis siniestro
    $('#96913760865b013956d3458069571575').hide(); // Gestión informe ajustador externo
    //$('#124534031655423d6933cf3054917309').hide(); // Gestión informe ajustador interno
    $('#76872118865b013ba554ca7039264531').hide(); // Recomendaciones
    $('#58427909965b013d4b72133095755119').hide(); // Subrogaciones/salvamentos
    $('#14756539565b013e91c8616020859435').hide(); // Atención al caso
    $('#64914738165b013fb6c5de1060185623').hide(); // Poliza
  $('#subtitleDatase').hide();
  $('#subtitleDatoSini').hide();
  $('#subtitleDatGes').hide();
  $('#subtitleSiniReg').hide();
  $('#subtitleAlcaSin').hide();
  $('#subtitleInformacionSiniestro').hide();
  $('#subtitleDireBien').hide();
  $('#subtitleInfoInsp').hide();
  $('#subtitleInfPago').hide();
  $('#subtitleAnaSini').hide();
  $('#subtitleGestAjusExter').hide();
  $('#subtitleGestAjusInter').hide();
  $('#subtitleRecomenda').hide();
  $('#subtitleSubrSalv').hide();
  $('#subtitleAtenCaso').hide();
  $('#sub_titlePoliza').hide();
  $('#fle_respaldosInspeccion').hide();
  $('#sub_companias_coaseguradas').hide();
  $('#930411861658b16b7c6ffe2080159750').hide();
  $('#72023205665542581b5be35026876051').hide();


}
function mostrar_documentos() {
  $('#89682335465afe6f344a372005028595').show(); // *** Documentos de respaspaldo
}
function mostrar_historial() {
  $('#24402141165afe6f3464602000676261').show(); // ** Historial de casos 
}
function ocultar_documentos() {
  $('#89682335465afe6f344a372005028595').hide(); // *** Documentos de respaspaldo
}
function ocultar_historial() {
  $('#24402141165afe6f3464602000676261').hide(); // ** Historial de casos 
}

$('.menu').on('click', function () {
  switch (this.id) {
    case 'menu1':
      mostrar_solicitud();
      ocultar_documentos();
      ocultar_historial();
      ocultarInspeccion();
      break;
    case 'menu2':
      ocultar_solicitud();
      ocultar_documentos();
      mostrar_historial();
      break;
    case 'menu3':
      ocultar_solicitud();
      mostrar_documentos();
      ocultar_historial();
      break;
  }
})


let tri_bandera_inspeccion = $('#tri_bandera_inspeccion').getValue();


function ocultarInspeccion() {
  if (tri_bandera_inspeccion == null || tri_bandera_inspeccion == '' || tri_bandera_inspeccion == ' ' || tri_bandera_inspeccion == undefined || tri_bandera_inspeccion == 'undefined') {
    $('#subtitleInfPago').hide();
    $('#4479316636552d520db0b22003258870').hide();
    $('#7403890606552d71dbfcce0019230087').hide();
    $('#subtitleAnaSini').hide();
    $('#3524701026552e2db3b1ce7038906501').hide();
    $('#subtitleGestAjusExter').hide();
    $('#26930265365541e148c32f9051535276').hide();
    $('#subtitleRecomenda').hide();
    $('#73833911165542a9e820942098465603').hide();
    $('#subtitleSubrSalv').hide();
    $('#30141999765542f7db73941014259095').hide();
    $('#72023205665542581b5be35026876051').hide();
    $('#frm_as_valorSiniestro').disableValidation();
    $('#frm_as_valorSiniestro').hide();
    $('#frm_as_tipoGestion').disableValidation();
    $('#frm_as_tipoGestion').hide();
    $('#frm_as_reclamoSuperaDeducible').disableValidation();
    $('#frm_as_reclamoSuperaDeducible').hide();
    $('#frm_as_valorTotal').disableValidation();
    $('#frm_as_valorTotal').hide();

  }
}
if (tri_bandera_inspeccion == null || tri_bandera_inspeccion == '' || tri_bandera_inspeccion == ' ' || tri_bandera_inspeccion == undefined || tri_bandera_inspeccion == 'undefined') {
  $('#subtitleInfPago').hide();
  $('#4479316636552d520db0b22003258870').hide();
  $('#7403890606552d71dbfcce0019230087').hide();
  $('#subtitleAnaSini').hide();
  $('#3524701026552e2db3b1ce7038906501').hide();
  $('#subtitleGestAjusExter').hide();
  $('#26930265365541e148c32f9051535276').hide();
  $('#subtitleRecomenda').hide();
  $('#73833911165542a9e820942098465603').hide();
  $('#subtitleSubrSalv').hide();
  $('#30141999765542f7db73941014259095').hide();
  $('#72023205665542581b5be35026876051').hide();
  $('#frm_as_valorSiniestro').disableValidation();
  $('#frm_as_valorSiniestro').hide();
  $('#frm_as_tipoGestion').disableValidation();
  $('#frm_as_tipoGestion').hide();
  $('#frm_as_reclamoSuperaDeducible').disableValidation();
  $('#frm_as_reclamoSuperaDeducible').hide();
  $('#frm_as_valorTotal').disableValidation();
  $('#frm_as_valorTotal').hide();


}

function salvamento(newVal, oldVal) {
  $('#64914738165b013fb6c5de1060185623').hide();

  if (newVal == 'SI') {
    $('#64914738165b013fb6c5de1060185623').show();
  } else {
    $('#64914738165b013fb6c5de1060185623').hide();
  }
}

salvamento($('#frm_ss_existeSalvamento').getValue(), '');
$('#frm_ss_existeSalvamento').setOnchange(salvamento);


$("#frm_as_requiereAjustador").getControl().attr('disabled', true);
$("#frm_as_tipoAjustador").getControl().attr('disabled', true);
$("#frm_as_causaRequerimientoAjustador").getControl().attr('disabled', true);
$("#frm_as_nombreAjustadorAsignado").getControl().attr('disabled', true);



function checkAccion(newVal, oldVal) {
  $("#chk_docs_basicos_grid").hide();
  
  if (newVal == 'DOCUMENTAR') {
    $("#chk_docs_basicos_grid").show();


  } 
}
//execute when the Dynaform loads:
checkAccion($("#frm_ac_accion").getValue(), '');
$('#frm_ac_accion').setOnchange(checkAccion);
