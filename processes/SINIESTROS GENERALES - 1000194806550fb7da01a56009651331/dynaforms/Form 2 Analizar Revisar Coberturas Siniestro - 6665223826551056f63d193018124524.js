
ocultar_solicitud();
mostrar_solicitud();
ocultar_documentos();
ocultar_historial();

$('#frm_as_reclamoSuperaDeducible').disableValidation();


function mostrar_solicitud() {
  $('#46098314565510a5cd57553018796264').show(); // Datos asegurado 
  $('#14607804465510ee3e00a05082909351').show(); // Datos siniestro
  $('#18277194465787f6590bb75083746853').show(); // Datos poliza
  $('#7403890606552d71dbfcce0019230087').show(); // Historial de casos
  $('#56993520565511b0c807296060115467').show(); // Siniestros registrados
  //$('#37397912265511ee4965f19044370072').show(); // Alcance a siniestro
  $('#462863856655124050411a0083795803').show(); // Información siniestro
  $('#16423784965514772ad1aa4003438500').show(); // Direcciones bienes
  $('#3991222066552d3306b3be8000113907').show(); // Información inspección
  //$('#4479316636552d520db0b22003258870').show(); // Información pago
  $('#3524701026552e2db3b1ce7038906501').show(); // Análisis siniestro
  //$('#26930265365541e148c32f9051535276').show(); // Gestión informe ajustador externo
  //$('#124534031655423d6933cf3054917309').show(); // Gestión informe ajustador interno
  //$('#73833911165542a9e820942098465603').show(); // Recomendaciones
  //$('#30141999765542f7db73941014259095').show(); // Subrogaciones/salvamentos
  $('#258163566655432b663f282099762126').show(); // Atención al caso
  $('#502697178658351be3b93a1020343316').hide(); // Informe Final
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
  fastTrack($("#frm_as_tipoGestion").getValue(), '');

  let tipo_operacion = $("#frm_ac_tipoOperacion").getValue();

  if (tipo_operacion == 'COASEGURO CEDIDO') {
    $('#sub_companias_coaseguradas').show();
    $('#930411861658b16b7c6ffe2080159750').show();
  }
  if (tipo_operacion == 'COASEGURO ACEPTADO') {
    $('#subtitleInfoInsp').hide();
    $('#3991222066552d3306b3be8000113907').hide();
	console.log("COASEGURO ACEPTADO");
  }


}
function ocultar_solicitud() {
  $('#sub_companias_coaseguradas').hide();
  $('#930411861658b16b7c6ffe2080159750').hide();
  $('#46098314565510a5cd57553018796264').hide();
  $('#14607804465510ee3e00a05082909351').hide();
  $('#18277194465787f6590bb75083746853').hide();
  $('#7403890606552d71dbfcce0019230087').hide();
  $('#56993520565511b0c807296060115467').hide();
  $('#462863856655124050411a0083795803').hide();
  $('#16423784965514772ad1aa4003438500').hide();
  $('#3991222066552d3306b3be8000113907').hide();
  $('#3524701026552e2db3b1ce7038906501').hide();
  $('#258163566655432b663f282099762126').hide();
  //$('#502697178658351be3b93a1020343316').hide(); 
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
}
function mostrar_documentos() {
  $('#27509649065667f59aa7000055860950').show(); // *** Documentos de respaspaldo
}
function mostrar_historial() {
  $('#7403890606552d71dbfcce0019230087').show(); // ** Historial de casos 
}
function ocultar_documentos() {
  $('#27509649065667f59aa7000055860950').hide(); // *** Documentos de respaspaldo
}
function ocultar_historial() {
  $('#7403890606552d71dbfcce0019230087').hide(); // ** Historial de casos 
}

function fastTrack(newVal, oldVal) {

  $('#subtitleInfoInsp').hide();
  $('#3991222066552d3306b3be8000113907').hide();
  let tipo_operacion = $("#frm_ac_tipoOperacion").getValue();

  if (newVal != 'FASTTRACK' && tipo_operacion != 'COASEGURO ACEPTADO') {
    $('#subtitleInfoInsp').show();
    $('#3991222066552d3306b3be8000113907').show();
  }
}
fastTrack($("#frm_as_tipoGestion").getValue(), '');
$('#frm_as_tipoGestion').setOnchange(fastTrack);

$('.menu').on('click', function () {
  switch (this.id) {
    case 'menu1':
      mostrar_solicitud();
      ocultar_documentos();
      ocultar_historial();
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


$("#tri_usr_analista_2").hide();


function accion(newValue, oldValue) {
  $('#30510795265850a90c04265058882654').hide();
  $("#tri_usr_analista_2").hide();
  $('#chk_docs_basicos_grid').hide();
  $('#file_cartaDeducible').hide();

  $('#frm_as_tipoGestion').enableValidation();
  $('#frm_as_valorSiniestro').enableValidation();
  $('#frm_as_valorTotal').enableValidation();
  $('#frm_as_requiereAjustador').enableValidation();
  $('#frm_as_tipoAjustador').enableValidation();

  
  var tipo = $("#frm_as_tipoGestion").getValue();
  if (newValue == 'NEGAR') {
    $('#30510795265850a90c04265058882654').show();
  }
  if (newValue == 'REASIGNAR') {
    $('#tri_usr_analista_2').show();
    $('#frm_as_tipoGestion').disableValidation();
    $('#frm_as_valorSiniestro').disableValidation();
    $('#frm_as_valorTotal').disableValidation();
    $('#frm_as_requiereAjustador').disableValidation();
    $('#frm_as_tipoAjustador').disableValidation();
  }
  if (newValue == 'DOCUMENTAR') {
    $('#chk_docs_basicos_grid').show();
  }
  if (newValue == 'DEDUCIBLE') {
    $('#file_cartaDeducible').show();
  }
  if (newValue == 'APROBAR' && tipo == 'FASTTRACK') {
    $("#502697178658351be3b93a1020343316").show();
  } else {
    $("#502697178658351be3b93a1020343316").hide();
  }
}
if ($("#frm_ac_accion").getValue() != '') {
  var dato = $("#frm_ac_accion").getValue();
  accion(dato, '');
}

accion($("#frm_ac_accion").getValue(), '');
$("#frm_ac_accion").setOnchange(accion);

let suma = 0;

$("#6665223826551056f63d193018124524").setOnSubmit(function () {
  let tipo_operacion = $("#frm_ds_tipoOperacion").getValue();
  if (tipo_operacion != 'COASEGURO CEDIDO') {
    return true
  }
  var aRc = $("#frm_companias_coaseguradas").getNumberRows();
  suma = 0;
  let valor = 0;
  if ($("#frm_ac_accion").getValue() == "AJUSTADOR") {
    valor = $("#frm_companias_coaseguradas").getSummary(3);
    console.log("Valor " + valor);

    if (valor != 100) {
      console.log("Suma " + suma);

      //alert("La suma de los porcentajes de participación debe ser igual a 100%");
      //return false;
    }
  }
  console.log("Suma " + suma);
  return true;
});