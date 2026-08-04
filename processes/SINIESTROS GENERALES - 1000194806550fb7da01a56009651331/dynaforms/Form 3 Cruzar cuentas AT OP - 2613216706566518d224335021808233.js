
mostrar_solicitud();
ocultar_documentos();
ocultar_historial();
function mostrar_solicitud(){
$('#46098314565510a5cd57553018796264').show(); // Datos asegurado 
$('#14607804465510ee3e00a05082909351').show(); // Datos siniestro
$('#19482908265511238869e34082628309').show(); // Datos gestión
$('#7403890606552d71dbfcce0019230087').show(); // Historial de casos
$('#56993520565511b0c807296060115467').show(); // Siniestros registrados
$('#37397912265511ee4965f19044370072').show(); // Alcance a siniestro
$('#462863856655124050411a0083795803').show(); // Información siniestro
$('#16423784965514772ad1aa4003438500').show(); // Direcciones bienes
$('#3991222066552d3306b3be8000113907').show(); // Información inspección
$('#4479316636552d520db0b22003258870').show(); // Información pago
$('#3524701026552e2db3b1ce7038906501').show(); // Análisis siniestro
$('#26930265365541e148c32f9051535276').show(); // Gestión informe ajustador externo
$('#124534031655423d6933cf3054917309').show(); // Gestión informe ajustador interno
$('#73833911165542a9e820942098465603').show(); // Recomendaciones
$('#30141999765542f7db73941014259095').show(); // Subrogaciones/salvamentos
$('#258163566655432b663f282099762126').show(); // Atención al caso
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
}
function ocultar_solicitud(){
    $('#46098314565510a5cd57553018796264').hide(); 
    $('#14607804465510ee3e00a05082909351').hide(); 
    $('#19482908265511238869e34082628309').hide(); 
    $('#7403890606552d71dbfcce0019230087').hide(); 
    $('#56993520565511b0c807296060115467').hide(); 
    $('#37397912265511ee4965f19044370072').hide(); 
    $('#462863856655124050411a0083795803').hide(); 
    $('#16423784965514772ad1aa4003438500').hide(); 
    $('#3991222066552d3306b3be8000113907').hide(); 
    $('#4479316636552d520db0b22003258870').hide(); 
    $('#3524701026552e2db3b1ce7038906501').hide(); 
    $('#26930265365541e148c32f9051535276').hide(); 
    $('#124534031655423d6933cf3054917309').hide(); 
    $('#73833911165542a9e820942098465603').hide(); 
    $('#30141999765542f7db73941014259095').hide(); 
    $('#258163566655432b663f282099762126').hide(); 
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
function mostrar_documentos(){
  $('#27509649065667f59aa7000055860950').show(); // *** Documentos de respaspaldo
  }
function mostrar_historial(){
  $('#7403890606552d71dbfcce0019230087').show(); // ** Historial de casos 
  }
function ocultar_documentos(){
  $('#27509649065667f59aa7000055860950').hide(); // *** Documentos de respaspaldo
  }
function ocultar_historial(){
  $('#7403890606552d71dbfcce0019230087').hide(); // ** Historial de casos 
  }

$('.menu').on('click', function(){
     switch(this.id){       
      case 'menu1' :
      mostrar_solicitud();
      ocultar_documentos();
      ocultar_historial();
      break;
      case 'menu2' :
      ocultar_solicitud();
      ocultar_documentos();
      mostrar_historial();
      break;
      case 'menu3' :
      ocultar_solicitud();
      mostrar_documentos();
      ocultar_historial();
      break;
      }
})


