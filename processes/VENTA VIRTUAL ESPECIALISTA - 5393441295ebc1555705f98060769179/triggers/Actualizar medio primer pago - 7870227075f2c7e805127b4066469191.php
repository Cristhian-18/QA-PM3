<?php
$cnx = "1479570925ec29f1d8d1d57019959618";
$app_uid =  @@APPLICATION;
$app_number = @@APP_NUMBER;
$usr = @@USER_LOGGED;

// primer pago_anticipado
$pago_anticipado=(@@frm_control_pago == 'PAGADO'? 'S' : 'N');
$frm_deposito_medio =  @@frm_deposito_medio;
$estado_pago = ($pago_anticipado == 'S' ? 'PAGADO' :'PENDIENTE');
$estado_pago = ($frm_deposito_medio == 'PAGOSMEDIOS' ? 'PENDIENTE' : $estado_pago);
$primer_pago_medio = ($frm_deposito_medio == 'PAGOSMEDIOS' ? 'TARJETA' : $frm_deposito_medio);

$frm_banco_equivida = @@frm_banco_equivida;
$frm_banco_ccontable = @@frm_banco_ccontable;
$frm_deposito_comprobante = @@frm_deposito_comprobante;
$frm_deposito_fecha = @@frm_deposito_fecha;

$frm_provisional_numero_autorizacion = @@frm_provisional_numero_autorizacion;
$frm_provisional_tipo_tarjeta = @@frm_provisional_tipo_tarjeta;
$frm_provisional_saldo_inicial = @@frm_provisional_saldo_inicial;

$primer_pago_modalidad = @@frm_provisional_tipo_tarjeta;
$primer_pago_plan = @@frm_provisional_plan_pago;
$primer_pago_subtotal = @@frm_provisional_pago;
$primer_pago_dscto = @@frm_provisional_descuento;
$primer_pago_total = @@frm_monto_deposito_provisional;

$primer_pago_subtotal = ($primer_pago_subtotal == ''? 0.0 : $primer_pago_subtotal);
$primer_pago_dscto = ($primer_pago_dscto == ''? 0.0 : $primer_pago_dscto);
$primer_pago_total = ($primer_pago_total == '' ? 0.0 : $primer_pago_total);

$link_pago = @@link_url;

$sql_d = "UPDATE VV_AUTORIZACIONES_DEBITO
	SET

	PAGO_ANTICIPADO = '$pago_anticipado',

	PRIMER_PAGO_MEDIO = '$primer_pago_medio',
	PRIMER_PAGO_MODALIDAD = '$primer_pago_modalidad',
	PRIMER_PAGO_PLAN =	'$primer_pago_plan',
	PRIMER_PAGO_SUBTOTAL = '$primer_pago_subtotal',
	PRIMER_PAGO_DSCTO = '$primer_pago_dscto',
	PRIMER_PAGO_TOTAL = '$primer_pago_total',

  `MONTO_CON_IMPUESTOS` = 0,
  `PRIMER_PAGO_AUTORIZACION` = '$frm_provisional_numero_autorizacion ',
  `PRIMER_PAGO_FECHA_PAGO` = '$frm_deposito_fecha',
  `PRIMER_PAGO_TIPO_TARJETA` = '$frm_provisional_tipo_tarjeta',
  `PRIMER_PAGO_DETALLE` = 'REPROCESO DE PRIMER PAGO',
  `USR_UID_CONFIRMACION` = '$usr',
  `MONTO_PROVISIONAL` = '$frm_provisional_saldo_inicial',

	ESTADO_PAGO = '$estado_pago',
	CASO_RECHAZADO = 'SI',
	MEDIO_PAGO_PRIMER = '$frm_deposito_medio',
	BANCO_EQUIVIDA = '$frm_banco_equivida',
	CUENTA_CONTABLE = '$frm_banco_ccontable',
	NUMERO_REFERENCIA = '$frm_deposito_comprobante',
	FECHA_CONFIRMACION = '$frm_deposito_fecha',
	PRIMER_PAGO_FECHA_PAGO = '$frm_deposito_fecha',
	LINK_PAGO = ".'"'.$link_pago.'"'."

	WHERE APP_UID = '$app_uid'
	AND APP_NUMBER = '$app_number'
	";

$rs_d = executeQuery($sql_d,$cnx);

@@tmp_sql_pago = $sql_d ;

