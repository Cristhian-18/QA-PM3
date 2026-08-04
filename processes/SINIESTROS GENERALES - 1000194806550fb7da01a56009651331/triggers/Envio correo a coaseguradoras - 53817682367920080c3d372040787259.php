<?php
//Envio correo a coaseguradoras

if(@@tri_correo_enviado_coaseguros == 1){
	return;
}

$tipo_operacion = @@frm_ac_tipoOperacion;

/* if (tipo_operacion == 'COASEGURO CEDIDO') {
    $('#sub_companias_coaseguradas').show();
    $('#930411861658b16b7c6ffe2080159750').show();
  }
  if (tipo_operacion == 'COASEGURO ACEPTADO') {
    $('#subtitleInfoInsp').hide();
    $('#3991222066552d3306b3be8000113907').hide();
	console.log("COASEGURO ACEPTADO");
  }
*/

if ($tipo_operacion == 'COASEGURO CEDIDO' || $tipo_operacion == 'COASEGURO ACEPTADO'){
	//enviar correo con plantilla Mail_Coaseguro.html
	$app_number = @@APP_NUMBER;


}