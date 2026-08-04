<?php
$cnx = "1479570925ec29f1d8d1d57019959618";
$app_uid =  @@APPLICATION;
$app_number = @@APP_NUMBER;

// primer pago_anticipado
$pago_anticipado = @@frm_pago_si;
	
//$pago_anticipado=@@frm_recibio_deposito;
$monto_provisional = @@frm_monto_deposito_provisional;
$estado_pago = @@frm_control_pago;
if (@@frm_control_pago != 'PAGADO'){
$estado_pago = ($pago_anticipado == 'SI' ? 'PAGADO' :'PENDIENTE');
}
$frm_deposito_medio =  @@frm_deposito_medio;
$frm_banco_equivida = @@frm_banco_equivida;
$frm_deposito_comprobante = @@frm_deposito_comprobante;
$frm_banco_ccontable = @@frm_banco_ccontable;

$sql_d = "UPDATE VV_AUTORIZACIONES_DEBITO
	SET 

	CANAL = 'ESPECIALISTA',
	PAGO_ANTICIPADO = '$pago_anticipado',

	ESTADO_PAGO = '$estado_pago',
	MEDIO_PAGO_PRIMER = '$frm_deposito_medio',
	BANCO_EQUIVIDA = '$frm_banco_equivida',
	CUENTA_CONTABLE = '$frm_banco_ccontable',
	NUMERO_REFERENCIA = '$frm_deposito_comprobante',
	MONTO_PROVISIONAL = $monto_provisional
	WHERE APP_UID = '$app_uid'
	AND APP_NUMBER = '$app_number'
	";

$rs_d = executeQuery($sql_d,$cnx);	


@@tmp_sql_d = $sql_d ;

